<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
}
