<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\TaskCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskCategoryController extends Controller
{
    // public function index()
    // {
    //     $user = Auth()->user();

    //     $categories = TaskCategory::where('church_id', $user->church_id)->where('church_branch_id',$user->church_branch_id)->get();
    //     return view('tasks.category.index', compact('categories' ));
    // }

    public function store(Request $request)
    {
        // dd($request);
        $user = Auth()->user();

        $task = TaskCategory::create([
            'name' => $request->input('name'),
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
        ]);

        //LOG
        $description = "User ". $user->id . " created a task category:  ". $task->id;
        $action = "Create";

        $log = Log::create([
            'user_id' => $user->id,
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'action' => $action,
            'description' => $description,
        ]);

        return redirect()->back()->with('success', 'Task category created successfully.');
    }

    public function show($id)
    {
        $category = TaskCategory::findOrFail($id);
        return response()->json($category);

    }

    public function update(Request $request)
    {
        // dd($request);
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], [
            'name.required' => 'Provide a name for the project',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Some inputs are missing.');
        }

        $result = TaskCategory::findOrFail($request->selectedId);
        $result->name = $request->name;
        $result->save();

            //LOG
            $description = "User ". $user->id . " modified a task category: ". $result->id;
            $action = "Update";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                    'action' => $action,
                'description' => $description,
            ]);


        return redirect()->back()->with('success', 'Task category created successfully.');
    }


    public function destroy(Request $request)
    {

        $user = Auth()->user();
        $category = TaskCategory::find($request->selectedId);
        $category->delete();

        //LOG
        $description = "User ". $user->id . " deleted a task category : ". $category->id;
        $action = "Delete";

        $log = Log::create([
            'user_id' => $user->id,
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'action' => $action,
            'description' => $description,
        ]);

        return redirect()->back()->with('success', 'Task category deleted.');
    }


}
