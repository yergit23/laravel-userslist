<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\ValidationException;
use App\Services\UserService;
use App\Services\FlashService;

class LoginController extends Controller
{
    private $user;
    private $flash;

    public function __construct(UserService $userService, FlashService $flashService)
    {
        $this->user = $userService;
        $this->flash = $flashService;
    }

    public function create()
    {
        return view('page_login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string']
        ]);

        if(!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                //'email' => 'These credentials do not match our records.'
                'email' => trans('auth.failed')
            ]);

            // Alternative option
            // return back()
            //     ->withInput()
            //     ->withErrors([
            //         'email' => 'These credentials do not match our records.'
            //     ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function destroy(Request $request)
    {
        $this->user->logout($request);

        return redirect()->route('login');
    }

    public function getDestroy()
    {
        $this->flash->flashMessage('danger', 'Нельзя выйти из системы через GET запрос');

        return redirect(RouteServiceProvider::HOME);
    }
}
