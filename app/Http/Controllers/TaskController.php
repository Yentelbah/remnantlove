<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Task;
use App\Models\TaskCategory;
use App\Models\TaskComment;
use App\Models\TaskNotification;
use App\Models\TaskReminder;
use App\Models\TaskStep;
use App\Models\TaskTemplate;
use App\Models\TaskTemplateStep;
use App\Models\User;
use App\Notifications\TaskAssignedNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use function Laravel\Prompts\table;

class TaskController extends Controller
{
    public function index()
    {
        $user = Auth()->user();

        $tasks = Task::with('category')
        ->where('church_id', $user->church_id)
        ->where('church_branch_id', $user->church_branch_id)
        ->whereHas('assignees', function ($query) {
            $query->where('user_id', auth()->id());
        })
        ->with('creator')
        ->get()
        ->filter(function ($task) {
            // Exclude tasks that were completed more than 7 days ago
            if ($task->status === 'completed' && $task->completed_at) {
                return Carbon::parse($task->completed_at)->greaterThanOrEqualTo(Carbon::now()->subDays(7));
            }
            return true; // Return all other tasks
        })
        ->groupBy('status');

        $users = User::where('church_id', $user->church_id)->where('church_branch_id',$user->church_branch_id)->whereNotIn('status', ['Inactive'])->get();
        $category = TaskCategory::where('church_id', $user->church_id)->where('church_branch_id',$user->church_branch_id)->paginate(10);
        $task_category = TaskCategory::where('church_id', $user->church_id)->where('church_branch_id',$user->church_branch_id)->get();

        $templates = TaskTemplate::all();
        return view('tasks.index', compact('tasks', 'users', 'category', 'task_category', 'templates' ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'priority' => 'required|in:low,medium,high',
            'task_type' => 'required|in:template,custom',
            'template_id' => 'nullable|exists:task_templates,id',
            'steps' => 'nullable|array',  // For custom steps
            'steps.*' => 'nullable|string',  // Individual custom steps
        ]);

        // dd($request);
        $task = Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'due_date' => $request->input('due_date'),
            'created_by' => auth()->id(),
            'priority' => $request->input('priority'),
            'progress' => 0,
            'church_id' => auth()->user()->church_id,
            'church_branch_id' => auth()->user()->church_branch_id,

        ]);

        $steps = $request->input('steps');  // Get the steps input
        $levels = $request->input('levels');  // Get the levels input

        if ($validated['task_type'] === 'template' && $validated['template_id']) {
            // If task is created from a template, copy template steps
            $templateSteps = TaskTemplateStep::where('template_id', $validated['template_id'])->get();

            foreach ($templateSteps as $templateStep) {
                TaskStep::create([
                    'task_id' => $task->id,
                    'level' =>$templateStep->id,
                    'description' => $templateStep->description,
                    'church_id' => auth()->user()->church_id,
                    'church_branch_id' => auth()->user()->church_branch_id,
                ]);
            }

        } elseif ($validated['task_type'] === 'custom' && $validated['steps']) {
            // If task is custom, add the custom steps
            foreach ($validated['steps'] as $index => $stepDescription) {
                TaskStep::create([
                    'task_id' => $task->id,
                    'level' => $levels[$index],
                    'description' => $stepDescription,
                    'church_id' => auth()->user()->church_id,
                    'church_branch_id' => auth()->user()->church_branch_id,

                ]);
            }
        }

        $assigneeIds = $request->input('assignees');
        // $task->assignees()->attach($assigneeIds);
        $assignedUsers = User::whereIn('id', $assigneeIds)->get();

        foreach ($assignedUsers as $user) {

            $assigned_to = (string) Str::uuid();

            DB::table('task_assignees')->insert([
                'id' => $assigned_to,
                'task_id' => $task->id,
                'user_id' => $user->id,
            ]);

            TaskNotification::create([
                'task_id' => $task->id,
                'user_id' => $user->id,
                'message' => 'A new task has been assigned to you: ' . $task->title,
                'church_id' => auth()->user()->church_id,
                'church_branch_id' => auth()->user()->church_branch_id,

            ]);

            if ($request->set_reminder == 'set'){

                TaskReminder::create([
                    'task_id' => $task->id,
                    'user_id' => $user->id,
                    'reminder_time' => $request->input('reminder_time'),
                    'church_id' => auth()->user()->church_id,
                    'church_branch_id' => auth()->user()->church_branch_id,

                ]);
            }

            $user->notify(new TaskAssignedNotification($task));
        }

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function updateTask(Request $request)
    {
        // dd($request);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'priority' => 'required|in:low,medium,high',
        ]);


        $task = Task::find($request->selectedId);
        $task->update($request->all());
        return redirect()->back()->with('success', 'Task status updated.');
    }

    public function updateStep(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
        ]);


        $step = TaskStep::find($request->selectedId);
        $step->update($request->all());
        return redirect()->back()->with('success', 'Step updated successfully.');    }

    public function show($id)
    {
        $category = Task::findOrFail($id);
        return response()->json($category);

    }

    public function step($id)
    {
        $category = TaskStep::findOrFail($id);
        return response()->json($category);

    }

    public function view($task)
    {
        $user = Auth()->user();

        $task = Task::with('steps', )->findOrFail($task);

        // Calculate total steps and completed steps
        $totalSteps = $task->steps->count();
        $completedSteps = $task->steps->where('is_completed', 1)->count();

        // Calculate the completion percentage (avoid division by zero)
        $completionPercentage = $totalSteps > 0 ? ($completedSteps / $totalSteps) * 100 : 0;

        $assignedUserIds = $task->assignees->pluck('id')->toArray();
        // Retrieve users who are NOT assigned to this task
        $availableUsers = User::whereNotIn('id', $assignedUserIds)
        ->where('church_id', $user->church_id)
        ->where('church_branch_id', $user->church_branch_id)
        ->get();

        $removeUser = User::whereIn('id', $assignedUserIds)
        ->where('church_id', $user->church_id)
        ->where('church_branch_id', $user->church_branch_id)
        ->get();
        $removeUser;
        $task_category = TaskCategory::where('church_id', $user->church_id)->where('church_branch_id',$user->church_branch_id)->get();

        $notification = TaskNotification::where('user_id', $user->id)->where('task_id', $task->id)->first();
        $notification->is_read = true;
        $notification->save();

        // Pass task, totalSteps, completedSteps, and completionPercentage to the view
        return view('tasks.show', compact('task', 'totalSteps', 'completedSteps', 'completionPercentage', 'availableUsers', 'removeUser', 'task_category'));

    }

    public function destroy(Request $request)
    {
        $user = Auth()->user();

        $task = Task::find($request->selectedId);

        $notification = TaskNotification::where('task_id', $task->id)->get();
        foreach($notification as $item)
        {
            $item->delete();
        }

        $reminders = TaskReminder::where('task_id', $task->id)->get();
        foreach($reminders as $item)
        {
            $item->delete();
        }
        $steps = TaskStep::where('task_id', $task->id)->get();
        foreach($steps as $item)
        {
            $item->delete();
        }

        $comments = TaskComment::where('task_id', $task->id)->get();
        foreach($comments as $item)
        {
            $item->delete();
        }

        $task->delete();

        //LOG
        $description = "User ". $user->id . " deleted a task : ". $task->id;
        $action = "Delete";

        $log = Log::create([
            'user_id' => $user->id,
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'action' => $action,
            'description' => $description,
        ]);
        return redirect()->route('tasks.index')->with('success', 'Task deleted.');
    }


    public function updateStepStatus(Request $request, $stepId)
    {
        // Validate the request
        $request->validate([
            'is_completed' => 'required|boolean',
        ]);

        // Find the step by ID
        $step = TaskStep::findOrFail($stepId);

        // Find the associated task
        $task = Task::findOrFail($step->task_id);

        // Update the is_completed status of the task step
        $step->is_completed = $request->input('is_completed');
        $step->save();

        // Check the task's progress and update task status
        $totalSteps = $task->steps->count();
        $completedSteps = $task->steps->where('is_completed', 1)->count();

        // Calculate the completion percentage (avoid division by zero)
        $completionPercentage = $totalSteps > 0 ? ($completedSteps / $totalSteps) * 100 : 0;
        $task->progress = $completionPercentage;

        if ($completedSteps === $totalSteps) {
            // All steps completed
            $task->status = 'completed';
        } elseif ($completedSteps > 0) {
            // At least one step is completed but not all
            $task->status = 'in_progress';
        } else {
            // No steps completed
            $task->status = 'to_do';
        }



        // Save the task with updated status
        $task->save();

        return response()->json(['success' => 'Task step progress updated successfully.']);

        return redirect()->back()->with('success', 'Task step progress updated.');
    }

    public function addAssignees(Request $request, $taskId)
    {
        // dd($request);
        $task = Task::findOrFail($taskId);

        $assigneeIds = $request->input('assignees');
        // $task->assignees()->attach($assigneeIds);
        $assignedUsers = User::whereIn('id', $assigneeIds)->get();

        foreach ($assignedUsers as $user) {

            $assigned_to = (string) Str::uuid();

            DB::table('task_assignees')->insert([
                'id' => $assigned_to,
                'task_id' => $task->id,
                'user_id' => $user->id,
            ]);

            TaskNotification::create([
                'task_id' => $task->id,
                'user_id' => $user->id,
                'message' => 'A new task has been assigned to you: ' . $task->title,
                'church_id' => auth()->user()->church_id,
                'church_branch_id' => auth()->user()->church_branch_id,

            ]);
        }

        // Attach the selected users to the task
        $task->assignees()->attach($request->input('users'));

        return redirect()->back()->with('success', 'Users successfully assigned to the task.');
    }

    public function removeAssignees(Request $request, $taskId)
    {
        $user = Auth()->user();
        $currentUserId = auth()->id();

        $task = Task::findOrFail($taskId);

        $assigneeIds = $request->input('assignees');

        DB::table('task_assignees')
        ->where('task_id', $task->id)
        ->whereIn('user_id', $assigneeIds)
        ->where('user_id', '!=', $currentUserId)
        ->delete();

        $notification = TaskNotification::where('user_id', $user->id)
        ->where('user_id', '!=', $currentUserId)
        ->where('task_id', $task->id)->get();

        foreach($notification as $item)
        {
            $item->delete();
        }

        return redirect()->back()->with('success', 'User successfully removed to the task.');
    }


    public function addStep(Request $request)
    {
        // Validate the incoming steps
        $validated = $request->validate([
            'steps' => 'nullable|array',  // For custom steps
            'steps.*' => 'nullable|string',  // Individual custom steps
        ]);

        // Find the task using the selected ID from the request
        $task = Task::findOrFail($request->selectedId);

        // Get the highest level of the existing steps
        $highestLevel = TaskStep::where('task_id', $task->id)->max('level') ?? 0;

        // Retrieve the steps from the input
        $steps = $request->input('steps');  // Get the steps input

        // Iterate through each new step
        foreach ($validated['steps'] as $index => $stepDescription) {
            // Increment the level starting from the highest level found
            $newLevel = $highestLevel + $index + 1; // Start from the next level

            // Create the new step
            TaskStep::create([
                'task_id' => $task->id,
                'level' => $newLevel,
                'description' => $stepDescription,
                'church_id' => auth()->user()->church_id,
                'church_branch_id' => auth()->user()->church_branch_id,
            ]);
        }

        // Redirect back to the tasks index page with a success message
        return redirect()->back()->with('success', 'Task steps added successfully.');
    }


    public function destroyStep(Request $request)
    {
        $user = Auth()->user();

        $step = TaskStep::find($request->selectedId);
        $step->delete();

        //LOG
        $description = "User ". $user->id . " deleted a step : ". $step->id;
        $action = "Delete";

        $log = Log::create([
            'user_id' => $user->id,
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'action' => $action,
            'description' => $description,
        ]);
        return redirect()->back()->with('success', 'Task step deleted.');
    }


}
