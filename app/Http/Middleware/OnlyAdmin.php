<?php

namespace App\Http\Middleware;

use Closure;

class OnlyAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()->role->name !== 'admin') {
            return redirect()
                ->route('admin.dashboard.index')
                ->with('msg_error', 'Acesso negado!');
        }

        return $next($request);
    }
}
