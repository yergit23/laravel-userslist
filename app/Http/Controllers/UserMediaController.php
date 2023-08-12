<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Services\FlashService;
use App\Services\ValidationService;

class UserMediaController extends Controller
{
    private $user;
    private $flash;
    private $validation;

    public function __construct(UserService $userService, FlashService $flashService, ValidationService $validationService)
    {
        $this->user = $userService;
        $this->flash = $flashService;
        $this->validation = $validationService;
    }

    public function edit($id)
    {
        $userMedia = $this->user->one($id);

        return view('media', compact('userMedia'));
    }

    public function update(Request $request, $id)
    {
        $validator = $this->validation->updateMediaValid($request);

        if ($validator->fails()) {
            return redirect()->route('users.media', $id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $userImage = $this->user->updateMedia($request, $id);

        $this->flash->flashMessage('success', 'Профиль успешно обновлен');

        return redirect()->route('users.profile', $id);
    }
}
