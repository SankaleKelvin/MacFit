<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'Admin',
            'description' => 'Administrator with full access to the system.',
        ]);
        Role::create([
            'name' => 'Trainer',
            'description' => 'Trainer with access to training-related features.',
        ]);
        Role::create([
            'name' => 'Staff',
            'description' => 'Staff Member with access to general features.',
        ]);
        Role::create([
            'name' => 'User',
            'description' => 'Regular user with basic access.',
        ]);
    }
}
