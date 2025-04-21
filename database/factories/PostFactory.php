<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; // 必要に応じて使う

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Fakerを使ってダミーデータを定義
        return [
        // 日本語のダミーデータが生成されるようになる
        'title' => $this->faker->realText(10), // 日本語のリアルなテキスト（最大50文字）
        'content' => $this->faker->realText(200), // 日本語のリアルなテキスト（最大500文字）

        // 他にも日本語対応のメソッドがあります
        // 'author_name' => $this->faker->name(), // 日本語氏名
        // 'address' => $this->faker->address(), // 日本語住所

        ];
    }
}