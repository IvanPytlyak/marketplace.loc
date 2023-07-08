<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $user = User::where('id', $request)->first();
        $user = Auth::user();
        // if (!$user->isAdmin()) {
        if (!$user->isAdmin) {
            session()->flash('warning', 'У Вас недостаточно прав');
            return redirect()->route('index');
        }
        return $next($request);
    }
}
