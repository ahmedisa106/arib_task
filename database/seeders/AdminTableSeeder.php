<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::query()->truncate();
        Admin::query()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'phone' => '123456789',
            'password' => 'admin'
        ]);
    }
}
