<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function userPage()
    {
        $users = User::orderBy('name', 'asc')->get();
        return view('user-management.index', compact('users'));
    }

    public function addUserPage()
    {
        return view('user-management.create');
    }

    public function createUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'username' => str_replace(' ', '', $request['name']) . rand(pow(10, 5 - 1), pow(10, 5) - 1),
                'password' => $request['password'] ? $request['password'] : 'password',
                'remember_token' => Str::random(10),
                'role' => $request['role'] ? $request['role'] : 'user',
            ]);

            return redirect('/user-management');
        } catch (\Exception $e) {
            return back()->withErrors($e)->withInput();
        }
    }

    public function editUserPage($userId)
    {
        $user = User::findOrFail($userId);
        if (!$user) {
            return redirect('user-management');
        }
        return view('user-management.edit', compact('user'));
    }

    public function updateUser(Request $request, $userId)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'username' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $user = User::findOrFail($userId);
            $user->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'username' => $request['username'],
                'password' => $request['password'] ? $request['password'] : 'password',
                'role' => $request['role'] ? $request['role'] : $user->role,
            ]);

            return redirect('/user-management');
        } catch (\Exception $e) {
            return back()->withErrors($e)->withInput();
        }
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
