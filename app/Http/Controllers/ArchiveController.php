<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Employee;
use App\Models\User;

class ArchiveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('archive.index');
    }

    public function Clients()
    {
        $clients = Client::where('is_deleted', true)->orderBy('fname', 'asc')->get();
        return view('archive.clients.index', compact('clients'));
    }

    public function Employees()
    {
        $employees = Employee::where('is_deleted', true)->orderBy('name', 'asc')->get();
        return view('archive.employees.index', compact('employees'));
    }

    public function Users()
    {
        $users = User::where('is_deleted', true)->orderBy('name', 'asc')->get();
        return view('archive.user_profiles.index', compact('users'));
    }

}
