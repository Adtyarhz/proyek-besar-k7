<?php
namespace Database\Factories;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;
class UserFactory extends Factory
{
    protected $model = User::class;
    public function definition()
    {
        return [
            'username' => $this->faker->name,
            'role' => 'Mahasiswa',
            'password' => Hash::make('mahasiswa'),
            'remember_token' => Str::random(5),
        ];
    }
}

