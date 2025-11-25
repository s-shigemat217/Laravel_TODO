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
                    <ul class="list-group">
                        @foreach ($todos as $todo)
                            <li class="mt-4 pb-4">
                                <div class="flex justify-between items-center">
                                    <p class="text-primary font-bold mb-1 {{ $todo->is_completed ? 'line-through opacity-50 text-gray-500' : '' }}">{{ $todo->title }}</p>
                                    <div class="flex justify-start items-center gap-2">
                                        <flux:button href="{{ route('todos.edit', $todo) }}" icon:trailing="arrow-up-right">詳細／編集</flux:button>
                                        <form action="{{ route('todos.destroy', $todo) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <flux:button variant="danger" type="submit" onclick="return confirm('削除してもよろしいですか？')">
                                                削除
                                            </flux:button>
                                        </form>
                                    </div>
                                </div>
                                <p class="mt-1 text-sm ">作成日時: {{ $todo->created_at->format('Y年m月d日 H:i') }}</small>
                            </li>
                            {{-- <hr class="w-full"> --}}
                            <hr class="border-gray-800" />
                        @endforeach
                    </ul>
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
