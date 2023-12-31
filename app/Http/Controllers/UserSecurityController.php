<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Services\FlashService;
use App\Services\ValidationService;

class UserSecurityController extends Controller
{
    private $user;
    private $flash;
    private $validation;

    public function __construct(UserService $userService, ValidationService $validationService, FlashService $flashService)
    {
        $this->user = $userService;
        $this->validation = $validationService;
        $this->flash = $flashService;
    }

    public function edit($id)
    {
        $userSecurity = $this->user->one($id);

        return view('security', compact('userSecurity'));
    }

    public function update(Request $request, $id)
    {
        $validator = $this->validation->userSecurityValid($request);

        if ($validator->fails()) {
            return redirect()->route('users.security', $id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $this->user->updateSafety($request, $id);

        $this->flash->flashMessage('success', 'Данные пользователя обновлены');

        return redirect()->route('users.profile', $id);
    }
}
