<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Services\ValidationService;
use App\Services\FlashService;
use App\Providers\RouteServiceProvider;

class UserCreateController extends Controller
{
    private $users;
    private $validation;
    private $flash;

    public function __construct(UserService $userService, ValidationService $validationService, FlashService $flashService)
    {
        $this->users = $userService;
        $this->validation = $validationService;
        $this->flash = $flashService;
    }

    public function create()
    {
        return view('create_user');
    }

    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = $this->validation->addUserValid($request);

        if ($validator->fails()) {
            return redirect()->route('users.create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $this->users->addUser($request);

        $this->flash->flashMessage('success', 'Создан новый пользователь');

        return redirect(RouteServiceProvider::HOME);
    }

}
