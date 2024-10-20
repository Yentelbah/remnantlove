<?php

namespace App\Http\Controllers;

use App\Models\Evangelism;
use App\Models\Event;
use App\Models\Project;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $user = Auth()->user();

        $events = Event::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->get();

        $projects = Project::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->get();

        $evangelism = Evangelism::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->get();

        return view('calendar.index', compact('events','projects', 'evangelism'));
    }

}
