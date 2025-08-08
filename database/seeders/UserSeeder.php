<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Paul Adeleye',
            'email' => 'adeleyepaul2@gmail.com',
            'password' => Hash::make('NobulPlus94'),
        ]);
    }
}
