<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Services\FlashService;
use App\Services\StatusService;

class UserStatusController extends Controller
{
    private $user;
    private $flash;
    private $statuses;

    public function __construct(UserService $userService, FlashService $flashService, StatusService $statusService)
    {
        $this->user = $userService;
        $this->flash = $flashService;
        $this->statuses = $statusService;
    }

    public function edit($id)
    {
        $userStatus = $this->user->one($id);

        $statuses = $this->statuses->allStatus();

        return view('status', compact('userStatus', 'statuses'));
    }

    public function update(Request $request, $id)
    {
        $this->user->updateStatus($request, $id);

        $this->flash->flashMessage('success', 'Статус пользователя обновлен');

        return redirect()->route('users.profile', $id);
    }
}
