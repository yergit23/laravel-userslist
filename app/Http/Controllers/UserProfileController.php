<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserService;

class UserProfileController extends Controller
{
    private $user;

    public function __construct(UserService $userService)
    {
        $this->user = $userService;
    }

    public function show($id)
    {
        $user = $this->user->one($id);

        return view('page_profile', compact('user'));
    }
}
