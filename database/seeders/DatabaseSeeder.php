<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Admin::factory(3)->create();

        \App\Models\Admin::factory()->create([
            'username' => 'admin',
            "nama" => "admin",
            "token" => null,
            "password" => bcrypt("admin"),
        ]);
    }
}
