<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class StudentController extends Controller
{
    //
    public function index(){
        //user with user_type = student and is_approved = true
        $students = User::where('user_type', 'student')->where('is_approved', true)->get();
        return response(['students' => $students], 200);      
    }

    public function delete($id){
        $student = User::where('id', $id)->first();
        $student->delete();
        return response(['message' => 'Student with id ('. $id . ') was deleted successfully'], 200);

    }
}
