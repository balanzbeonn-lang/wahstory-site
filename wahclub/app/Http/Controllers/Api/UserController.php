<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function AllClubUsers() 
    {
        // return response()->json(User::take(50)->get());
        // return response()->json(User::all());
        return response()->json(['message' => 'Users not found'], 404);
    }
    
    public function GetUsers($limit) 
    {
        $users = User::take($limit)->get();
        if(!$users) {
            return response()->json(['message' => 'Users not found'], 404);
            
        }
        return response()->json($users);
    }
}
