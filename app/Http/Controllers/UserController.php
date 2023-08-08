<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userPage()
    {
        $users = User::get();
        return view('user-management.index', compact('users'));
    }

    public function editUserPage($userId)
    {
        $user = User::findOrFail($userId);
        if (!$user) {
            return redirect('user-management');
        }
        return view('user-management.edit', compact('user'));
    }

    public function deleteUser($userId)
    {
        $user = User::findOrFail($userId);
        if (!$user) {
            return response()->json([
                'message' => 'Error, User failed to delete',
            ]);
        }
        $user->delete();
        return response()->json([
            "message" => "User deleted successfully"
        ], 200);
    }
}
