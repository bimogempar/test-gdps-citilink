<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userPage()
    {
        return view('user-management.index');
    }
}
