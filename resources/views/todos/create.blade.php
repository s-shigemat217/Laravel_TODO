<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ToDo create page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" action="{{ route('todos.store') }}">
                    @csrf
                        <div class="w-full flex flex-col">
                            <label for="title" class="font-semibold mt-4">件名</label>
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            <input type="text" name="title" class="w-auto mt-1 p-2 border border-gray-300 rounded-md" id="title" max="255" required>
                        </div>
                        <div class="w-full flex flex-col">
                            <label for="description" class="font-semibold mt-4">本文</label>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            <textarea name="description" class="w-auto mt-1 p-2 border border-gray-300 rounded-md" id="description" cols="30" rows="8"></textarea>
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
