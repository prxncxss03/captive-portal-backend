<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Models\User;

class SettingsController extends Controller
{
    //
    public function index(){
        $message = "This is the settings page";
        return response()->json($message);
    }

    public function editInformation (Request $request, $id){
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
                'data' => ''
            ], 400);
        }
        $user->first_name = $request->first_name ? $request->first_name : $user->first_name;
        $user->last_name = $request->last_name ? $request->last_name : $user->last_name;
        $user->email = $request->email ? $request->email : $user->email;
        $user->save();
        return response()->json($user);
   
    }

    public function resetPassword(Request $request, $id){

        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
                'data' => ''
            ], 400);
        }

        
        $user->password = bcrypt($request->new_password);
        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'Password reset successfully',
        ], 200);
    

    }
}
