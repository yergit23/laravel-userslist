<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Services\FlashService;

class AdministratorCheck
{
    private $flash;

    public function __construct(FlashService $flashService)
    {
        $this->flash = $flashService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::user()->isAdmin())
        {
            $this->flash->flashMessage('warning', 'У Вас нет прав администратора');

            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
