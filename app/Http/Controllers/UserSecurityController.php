<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Services\FlashService;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;

class UserSecurityController extends Controller
{
    private $user;
    private $flash;

    public function __construct(UserService $userService, FlashService $flashService)
    {
        $this->user = $userService;
        $this->flash = $flashService;
    }

    public function show($id)
    {
        $user = $this->user->one($id);

        return view('security', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'email' => 'Не корректно заполнен email',
            'email.unique' => 'Указанный email не уникален',
            'password.min' => 'Минимальное количество символов 8',
            'password.confirmed' => 'Пароль не совпадает',
        ];

        $validator = Validator::make($request->all(), [
            'email' => ['email', 'unique:users'],
        ], $messages);

        if($request->password) {
            $validator = Validator::make($request->all(), [
                'password' => ['confirmed', 'min:8'],
            ], $messages);
        }

        if ($validator->fails()) {
            return redirect()->route('users.security', $id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $this->user->updateSafety($request, $id);

        $this->flash->flashMessage('success', 'Данные пользователя обновлены');

        return redirect(RouteServiceProvider::HOME);
    }
}
