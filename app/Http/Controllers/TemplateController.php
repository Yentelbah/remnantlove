<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Template;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TemplateController extends Controller
{

    public function details($id)
    {
        $result = Template::find($id);
        return response()->json($result);
    }

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ], [
            'senderID.required' => 'Provide Sender ID',
            'content.required' => 'State the purose for the Sender ID',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Some inputs are missing.');
        }

        $user = Auth()->user();
        $input = $request->all();

        $input['user_id'] = $user->id;
        $input ['church_id'] = $user->church_id;
        $input ['church_branch_id'] = $user->church_branch_id;

        $template = Template::create($input);


            //LOG
            $description = "User ". $user->id . " created a template:  ". $template->name . "(".  $template->id . ")";
            $action = "Message template";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);

        return redirect()->back()->with('success', 'Message template created successfully.');
    }

    public function update(Request $request)
    {

        // dd($request);
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ], [
            'senderID.required' => 'Provide Sender ID',
            'content.required' => 'State the purose for the Sender ID',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Some inputs are missing.');
        }

        $id = $request->input('selectedId');
        $result = Template::findOrFail($id);
        $result->title = $request->title;
        $result->content = $request->content;

        $result->save();

            //LOG
            $user = Auth::user();
            $description = "User ". $user->id . " modified a temmplate: ". $result->title . "(".  $result->id . ")";
            $action = "Update";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);


        return redirect()->back()->with('success', 'Template updated successfully.');

    }

    public function delete(Request $request)
    {
        $result = Template::findOrFail($request->selectedId);
        $result->delete();

        // dd($request);
            //LOG
            $user = Auth::user();
            $description = "User ". $user->id . " deleted an sms template: ". $result->title . "(".  $result->id . ")";
            $action = "Delete SMS Template";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,

                'action' => $action,
                'description' => $description,
            ]);


        return redirect()->back()->with('success', 'Template deleted successfully.');
    }
}
