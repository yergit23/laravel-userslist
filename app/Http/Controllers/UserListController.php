<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserService;

class UserListController extends Controller
{
    private $users;

    public function __construct(UserService $usersService)
    {
        $this->users = $usersService;
    }

    public function index()
    {
        $usersList = $this->users->all();

        return view('users', compact('usersList'));
    }

    public function welcome()
    {
        return view('welcome');
    }

}
