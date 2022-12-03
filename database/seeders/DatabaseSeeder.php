<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
// use Faker;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		// \App\Models\Admin::factory(3)->create();

		// \App\Models\Admin::factory()->create([
		//     'username' => 'admin',
		//     "nama" => "admin",
		//     "token" => null,
		//     "password" => bcrypt("admin"),
		// ]);

		$faker = \Faker\Factory::create();

		\App\Models\Mahasiswa::factory()->create([
			'nim' => '11218011',
			"nama" => "akmal",
			"prodi" => 'Teknik Informatika',
			'thn_masuk' => '2018',
			"token" => null,
			"password" => bcrypt("12345678"),
			'verified_at' => Carbon::now(),
		]);

		for ($i = 0; $i < 3; $i++) {
			\App\Models\Mahasiswa::factory()->create([
				'nim' => $faker->randomNumber(8),
				"nama" => $faker->firstName(),
				"prodi" => 'Teknik Informatika',
				'thn_masuk' => '2018',
				"token" => null,
				"password" => bcrypt("12345678"),
				'verified_at' => null,
			]);
		}

		\App\Models\Kaprodi::factory()->create([
			'kode_dosen' => '11218011',
			"nama" => "akmal",
			"prodi" => 'Teknik Informatika',
			"token" => null,
			"password" => bcrypt("12345678"),
		]);

		for ($i = 0; $i < 3; $i++) {
			\App\Models\Kaprodi::factory()->create([
				'kode_dosen' => $faker->randomNumber(8),
				"nama" => $faker->firstName(),
				"prodi" => 'Teknik Informatika',
				"token" => null,
				"password" => bcrypt("12345678"),
			]);
		}

		for ($i = 0; $i < rand(2, 6); $i++) {
			\App\Models\Materi::factory()->create([
				'kaprodi_id' => 1,
				"nama_materi" => $faker->text(rand(20, 80)),
				"deskripsi" => $faker->text(rand(20, 40)),
				"waktu_soal" => rand(10, 90),
				"waktu_exp" => Carbon::now()->addDay(10),
			]);
		}
	}
}
