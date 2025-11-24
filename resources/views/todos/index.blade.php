<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ToDo List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- 成功メッセージ表示 -->
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show my-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <!-- ToDo作成ボタン -->
            <div class="mt-4 mb-6 flex justify-end">
                <a href="{{ route('todos.create') }}" class="btn btn-primary">
                    + 新しいToDoを作成
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <!-- ToDoがある場合 -->
                    @if ($todos->count() > 0)
                    <div class="list-group">
                        @foreach ($todos as $todo)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-1">{{ $todo->title }}</h5>
                                    @if ($todo->description)
                                        <p class="mb-1 text-muted">{{ $todo->description }}</p>
                                    @endif
                                    <small class="text-secondary">
                                        作成日時: {{ $todo->created_at->format('Y年m月d日 H:i') }}
                                    </small>
                                </div>
                                <div>
                                    <!-- ステータス表示 -->
                                    @if ($todo->is_completed)
                                        <span class="badge bg-success">完了</span>
                                    @else
                                        <span class="badge bg-warning">未完了</span>
                                    @endif

                                    <!-- アクション -->
                                    <a href="{{ route('todos.edit', $todo) }}" class="btn btn-sm btn-warning ms-2">
                                        編集
                                    </a>
                                    <form action="{{ route('todos.destroy', $todo) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('削除してもよろしいですか？')">
                                            削除
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @else
                    <!-- ToDoがない場合 -->
                    <div class="alert alert-info" role="alert">
                        まだToDoがありません。<a href="{{ route('todos.create') }}">新しいToDoを作成</a>してみましょう！
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
