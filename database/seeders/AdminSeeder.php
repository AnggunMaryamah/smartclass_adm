<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'username' => 'Admin smartclass',
            'email' => 'admin@smartclass.test',
            'password' => bcrypt('classmartytta'),
        ]);

    }
}
