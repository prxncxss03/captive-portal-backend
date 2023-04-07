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
        return response(['students' => $students], 200);
    }
}
