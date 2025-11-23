<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ログインユーザーのTodoを取得（新しい順）
        $todos = Auth::user()->todos()->latest()->get();

        return view('todos.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // ログインユーザーのTodoとして作成
        Auth::user()->todos()->create($validated);

        return redirect()->route('todos.index')
            ->with('success', 'Todoを作成しました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        // 認可チェック：自分のTodoのみ閲覧可能
        if ($todo->user_id !== Auth::id()) {
            abort(403);
        }

        return view('todos.show', compact('todo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        // 認可チェック：自分のTodoのみ編集可能
        if ($todo->user_id !== Auth::id()) {
            abort(403);
        }

        return view('todos.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        // 認可チェック：自分のTodoのみ更新可能
        if ($todo->user_id !== Auth::id()) {
            abort(403);
        }

        // バリデーション
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_completed' => 'boolean',
        ]);

        // is_completedがリクエストに含まれない場合はfalse
        $validated['is_completed'] = $request->has('is_completed');

        $todo->update($validated);

        return redirect()->route('todos.index')
            ->with('success', 'Todoを更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        // 認可チェック：自分のTodoのみ削除可能
        if ($todo->user_id !== Auth::id()) {
            abort(403);
        }

        $todo->delete();

        return redirect()->route('todos.index')
            ->with('success', 'Todoを削除しました。');
    }
}
