<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Services\FlashService;

class UserEditController extends Controller
{
    private $user;
    private $flash;

    public function __construct(UserService $userService, FlashService $flashService)
    {
        $this->user = $userService;
        $this->flash = $flashService;
    }

    public function edit($id)
    {
        $userEdit = $this->user->one($id);

        return view('edit', compact('userEdit'));
    }

    public function update(Request $request, $id)
    {
        $this->user->update($request, $id);

        $this->flash->flashMessage('success', 'Общая информация пользователя обновлена');

        return redirect()->route('users.profile', $id);
    }
}
