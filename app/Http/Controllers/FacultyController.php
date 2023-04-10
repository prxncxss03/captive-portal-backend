<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FacultyController extends Controller
{
    //
    public function index(){
 
        $faculty = User::where('user_type', 'faculty')->where('is_approved', true)->get();
        return response(['faculty' => $faculty], 200);      
    }

    public function delete($id){
        $faculty = User::where('id', $id)->first();
        $faculty->delete();
        return response(['message' => 'Student with id ('. $id . ') was deleted successfully'], 200);

    }

    
}
