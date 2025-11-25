<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 5人のユーザーを作成
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => "User {$i}",
                'email' => "user{$i}@example.com",
                'password' => bcrypt("password{$i}"),
            ]);
        }
        // シーダーを実行
        $this->call([
            TodoSeeder::class,
        ]);
    }
}
