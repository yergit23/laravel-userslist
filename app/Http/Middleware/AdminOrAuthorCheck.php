<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Services\FlashService;

class AdminOrAuthorCheck
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
        if(Auth::user()->isAdmin() || Auth::user()->isAuthor())
        {
            return $next($request);
        }
        
        $this->flash->flashMessage('warning', 'Вы можете редактировать только свою общую информацию');

        return redirect(RouteServiceProvider::HOME);
    }
}
