<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Todo;
use App\Models\User;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 各ユーザーに対して20個ずつToDoを作成
        User::all()->each(function ($user) {
            Todo::factory()->count(20)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
