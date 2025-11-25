<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- メッセージ表示 -->
            <x-message type="success" :message="session('success')"/>

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
                    <div class="mt-6">
                        {{ $todos->links() }}
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
