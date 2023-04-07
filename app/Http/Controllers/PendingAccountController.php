<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PendingAccountController extends Controller
{
    //
    public function index(){
        $users = User::where('is_approved', false)->get();
        return response(['Pending Accounts' => $users], 200);
    }
}
