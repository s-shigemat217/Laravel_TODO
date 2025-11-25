<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),  // ユーザーを自動作成
            'title' => $this->faker->sentence(),  // ランダムな文章
            'description' => $this->faker->paragraph(),  // ランダムな段落
            'is_completed' => $this->faker->boolean(),  // ランダムなbool値
        ];
    }
}
