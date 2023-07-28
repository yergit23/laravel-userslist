<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Models\User;

class UserListController extends Controller
{
    private $users;

    public function __construct(UserService $usersService)
    {
        $this->users = $usersService;
    }

    public function index()
    {
        $users = $this->users->all();

        return view('users', compact('users'));
    }

}
