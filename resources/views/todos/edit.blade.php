<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" action="{{ route('todos.update', $todo) }}">
                        @csrf
                        @method('patch')
                        <div class="w-full flex flex-col">
                            <label for="title" class="font-semibold mt-4">件名</label>
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            <input
                                type="text"
                                id="title"
                                name="title"
                                maxlength="255"
                                class="w-auto mt-1 p-2 border border-gray-300 rounded-md"
                                required
                                value="{{ old('title', $todo->title) }}"
                            >
                        </div>
                        <div class="w-full flex flex-col">
                            <label for="description" class="font-semibold mt-4">本文</label>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            <textarea
                                name="description"
                                id="description"
                                cols="30"
                                rows="8"
                                class="w-auto mt-1 p-2 border border-gray-300 rounded-md"
                            >{{ old('description', $todo->description) }}</textarea>
                        </div>
                        <div class="w-full flex flex-col">
                            <label for="is_completed" class="font-semibold mt-4">
                                <input type="hidden" name="is_completed" value="0">
                                <input
                                    type="checkbox"
                                    id="is_completed"
                                    name="is_completed"
                                    value="1"
                                    class="rounded"
                                    @checked(old('is_completed', $todo->is_completed))
                                >
                                完了
                            </label>
                        </div>
                        <flux:button variant="primary" type="submit" class="w-full mt-4 cursor-pointer">
                            送信する
                        </flux:button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
