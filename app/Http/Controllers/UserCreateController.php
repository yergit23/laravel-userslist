<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class UserCreateController extends Controller
{
    public function create()
    {
        return view('create_user');
    }
}
