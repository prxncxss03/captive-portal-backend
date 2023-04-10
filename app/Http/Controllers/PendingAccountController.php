<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PendingAccountController extends Controller
{
    //
    public function index(){
        $users = User::where('is_approved', false)->get();
        return response(['pending_accounts' => $users], 200);
    }

    public function approve($id){
        $user = User::find($id);
        $user->is_approved = true;
        $user->save();
        return response(['message' => 'Account approved successfully'], 200);
    }
    
    public function reject($id){
        $user = User::find($id);
        $user->delete();
        return response(['message' => 'Account rejected successfully'], 200);
    }

    public function approveAll (){
        $users = User::where('is_approved', false)->get();
        foreach($users as $user){
            $user->is_approved = true;
            $user->save();
        }
        return response(['message' => 'All accounts approved successfully'], 200);
    }

    public function rejectAll (){
        $users = User::where('is_approved', false)->get();
        foreach($users as $user){
            $user->delete();
        }
        return response(['message' => 'All accounts rejected successfully'], 200);
    }


}
