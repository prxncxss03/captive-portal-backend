<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Webpage;

class SearchController extends Controller
{
    //
    public function studentSearch ($key) {
        $students = User::where('user_type', 'student') 
            ->where('is_approved', true)
            ->where('first_name', 'like', '%' . $key . '%')
            ->orWhere('last_name', 'like', '%' . $key . '%')
            ->where('email', 'like', '%' . $key . '%')
            ->get();

        if ($students->isEmpty())
            return response(['message' => 'No student found'], 404);
        return response(['students' => $students], 200);
    }

    public function facultySearch ($key) {
        $faculty = User::where('user_type', 'faculty') 
            ->where('is_approved', true)
            ->where('first_name', 'like', '%' . $key . '%')
            ->orWhere('last_name', 'like', '%' . $key . '%')
            ->where('email', 'like', '%' . $key . '%')
            ->get();

        if ($faculty->isEmpty())
            return response(['message' => 'No faculty found'], 404);
        return response(['faculty' => $faculty], 200);
    }



    public function pendingAccountsSearch ($key) {
        $pendingAccounts = User::where('is_approved', false)
            ->where('first_name', 'like', '%' . $key . '%')
            ->orWhere('last_name', 'like', '%' . $key . '%')
            ->where('email', 'like', '%' . $key . '%')
            ->get();

        if ($pendingAccounts->isEmpty())
            return response(['message' => 'No pending account found'], 404);
        return response(['pending_accounts' => $pendingAccounts], 200);
    }

    public function blockedWebsiteSearch ($key) {
        $blockedWebsites = Webpage::where('name', 'like', '%' . $key . '%')
            ->orWhere('category', 'like', '%' . $key . '%')
            ->orWhere('url', 'like', '%' . $key . '%')
            ->get();

        if ($blockedWebsites->isEmpty())
            return response(['message' => 'No blocked website found'], 404);
        return response(['blocked_websites' => $blockedWebsites], 200);
    }
}
