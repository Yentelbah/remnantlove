<?php

namespace App\Http\Controllers;

use App\Models\Church;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth()->user();

        $results = Church::all();
        return view ('client.index', compact('results'));
    }


    public function getDetails($churchId)
    {
        $church = Church::find($churchId);
        return response()->json($church);
    }



}
