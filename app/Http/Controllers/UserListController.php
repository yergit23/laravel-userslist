<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Services\FlashService;
use App\Providers\RouteServiceProvider;

class UserListController extends Controller
{
    private $users;
    private $flash;

    public function __construct(UserService $usersService, FlashService $flashService)
    {
        $this->users = $usersService;
        $this->flash = $flashService;
    }

    public function index()
    {
        $usersList = $this->users->all();

        return view('users', compact('usersList'));
    }

    public function search(Request $request)
    {
        $usersList = $this->users->userSearch($request);

        if ($usersList->isEmpty()) {
            $this->flash->flashMessage('info', 'По запросу ничего не найдено.');

            return redirect(RouteServiceProvider::HOME);
        }

        return view('users', compact('usersList'));
    }

    public function welcome()
    {
        return view('welcome');
    }

}
