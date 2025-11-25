<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class CheckTodoOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // URLから{todo}パラメータを取得
        $todo = $request->route('todo');

        // ToDoが存在しており、ログイン中のユーザーが所有者か確認
        if ($todo && auth()->user()->id !== $todo->user_id) {
            abort(403, '権限がありません。');
        }

        return $next($request);
    }
}
