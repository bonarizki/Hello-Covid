<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MitraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

    	for($i = 1; $i <= 50; $i++){

    	      // insert data ke table pegawai menggunakan Faker
    		DB::table('mitra_rs')->insert([
    			"mitra_name" => "RS. ".$faker->name,
                "mitra_address" => $faker->address,
                "mitra_phone" => '081'.$faker->randomNumber(),
                "mitra_type" => $faker->randomElement(['swab','rapid','all']),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
                "created_by" => "system",
                "updated_by" => "system"
    		]);

    	}
    }
}
