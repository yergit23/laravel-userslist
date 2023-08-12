<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\FlashService;
use App\Services\UserService;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class UserDeleteController extends Controller
{
    private $flash;
    private $user;

    public function __construct(FlashService $flashService, UserService $userService)
    {
        $this->flash = $flashService;
        $this->user = $userService;
    }

    public function destroy(Request $request, $id)
    {
        $this->user->userDelete($id);

        if (Auth::user()->isAuthor()) {

            $this->user->logout($request);

            return redirect()->route('register');
        }

        $this->flash->flashMessage('info', 'Пользователь удален');

        return redirect(RouteServiceProvider::HOME);
    }

    public function getDestroy()
    {
        $this->flash->flashMessage('danger', 'Нельзя удалить пользователя через GET запрос!');

        return redirect(RouteServiceProvider::HOME);
    }
}
