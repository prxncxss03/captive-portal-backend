<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class StudentController extends Controller
{
    //
    public function index(){
        $students = User::where('user_type', 'student')->get();
        return response(['students' => $students], 200);
    }
}
