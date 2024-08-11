<?php

namespace App\Http\Controllers;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class LegalController extends Controller
{
    public function terms_of_use(){
        return view('legal.terms_of_use');
    }

    public function privacy_policy(){
        return view('legal.privacy_policy');
    }

    public function refund_policy(){
        return view('legal.refund_policy');
    }

    // public function delete(Request $request)
    // {
    //     // Define the migration name
    //     $mig = '2024_06_05_225039_create_notifications_table';
    //     $mig2 = '2024_06_19_012230_add_principal_and_interest_column';
    //     // Drop the notifications table
    //     if (Schema::hasTable('notifications')) {
    //         Schema::drop('notifications');
    //     }

    //     // Remove the migration entry from the migrations table
    //     DB::table('migrations')->where('migration', $mig)->delete();
    //     DB::table('migrations')->where('migration', $mig2)->delete();

    //     // Optionally, add a success message to the session or log the action
    //     session()->flash('success', 'Notifications table and migration entry deleted successfully.');

    //     // Redirect back
    //     return redirect()->back();
    // }

}
