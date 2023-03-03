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


		//akun default atau tes mahasiswa
		\App\Models\Mahasiswa::factory()->create([
			'nim' => '11218010',
			"nama" => "akmal",
			"prodi" => 'Teknik Informatika',
			'thn_masuk' => '2018',
			"token" => null,
			"password" => bcrypt("mal"),
			'verified_at' => Carbon::now(),
		]);

		//akun dummy mahasiswa
		// for ($i = 0; $i < 3; $i++) {
		// 	\App\Models\Mahasiswa::factory()->create([
		// 		'nim' => $faker->randomNumber(8),
		// 		"nama" => $faker->firstName(),
		// 		"prodi" => 'Teknik Informatika',
		// 		'thn_masuk' => '2018',
		// 		"token" => null,
		// 		"password" => bcrypt("12345678"),
		// 		'verified_at' => null,
		// 	]);
		// }

		//akun admin 1 
		\App\Models\Admin::factory()->create([
			'username' => 'admin',
			"nama" => "admin",
			"token" => null,
			"password" => bcrypt("admin"),
		]);

		//akun admin 2 
		\App\Models\Admin::factory()->create([
			'username' => 'admin2',
			"nama" => "admin2",
			"token" => null,
			"password" => bcrypt("admin2"),
		]);

		//akun admin 3 
		\App\Models\Admin::factory()->create([
			'username' => 'admin3',
			"nama" => "admin3",
			"token" => null,
			"password" => bcrypt("admin3"),
		]);

		//akun kaprodi default atau tes
		\App\Models\Kaprodi::factory()->create([
			'kode_dosen' => '11218011',
			"nama" => "akmal",
			"prodi" => 'Teknik Informatika',
			"token" => null,
			"password" => bcrypt("12345678"),
		]);

		//akun kaprodi dummy
		// for ($i = 0; $i < 3; $i++) {
		// 	\App\Models\Kaprodi::factory()->create([
		// 		'kode_dosen' => $faker->randomNumber(8),
		// 		"nama" => $faker->firstName(),
		// 		"prodi" => 'Teknik Informatika',
		// 		"token" => null,
		// 		"password" => bcrypt("kaprodi"),
		// 	]);
		// }

		//data dummy materi 
		for ($i = 0; $i < rand(2, 6); $i++) {
			\App\Models\Materi::factory()->create([
				'kaprodi_id' => 1,
				"nama_materi" => $faker->text(rand(20, 80)),
				"deskripsi" => $faker->text(rand(20, 40)),
				"waktu_soal" => rand(10, 90),
				"waktu_exp" => Carbon::now()->addDay(10),
				"prodi" => 'Teknik Informatika',
			]);
		}

		//data dummy soal
		for ($i = 0; $i < rand(10, 40); $i++) {
			\App\Models\Soal::factory()->create([
				'materi_id' => 1,
				"soal" => $faker->text(rand(20, 80)),
				"jawaban_1" => $faker->text(rand(10, 20)),
				"jawaban_2" => $faker->text(rand(10, 20)),
				"jawaban_3" => $faker->text(rand(10, 20)),
				"jawaban_4" => $faker->text(rand(10, 20)),
				"jawaban" => 'a',
			]);
		}
	}
}
