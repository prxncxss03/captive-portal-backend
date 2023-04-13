<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Faculty; 
use App\Models\Webpage;


class DashboardController extends Controller
{
    //
    public function index (){
        $students = User::where('user_type', 'student') 
            ->where('is_approved', true)
            ->get();

        $faculty = User::where('user_type', 'faculty') 
            ->where('is_approved', true)
            ->get();

        $pendingAccounts = User::where('is_approved', false)
            ->get();

        $blockedWebsites = Webpage::all();

        return response(['students' => $students, 'faculty' => $faculty, 'pending_accounts' => $pendingAccounts, 'blocked_websites' => $blockedWebsites], 200);
    }
}
