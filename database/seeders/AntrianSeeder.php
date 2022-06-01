<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AntrianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create('id_ID');

        for($i = 1; $i <= 12; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->email(),
                'is_admin' => 0,
                'password' => Hash::make('12345678'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        } 

        for($i = 1; $i <= 5; $i++)
        {
            DB::table('antrians')->insert([
                'poli_id' => 1,
                'user_id' => $i,
                'nama' => $faker->name,
                'tanggal' => date('Y-m-d'),
                'nomor' => $i,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
        for($i = 1; $i <= 3; $i++)
        {
            DB::table('antrians')->insert([
                'poli_id' => 2,
                'user_id' => $i + 5,
                'nama' => $faker->name,
                'tanggal' => date('Y-m-d'),
                'nomor' => $i,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
        for($i = 1; $i <= 4; $i++)
        {
            DB::table('antrians')->insert([
                'poli_id' => 3,
                'user_id' => $i + 8,
                'nama' => $faker->name,
                'tanggal' => date('Y-m-d'),
                'nomor' => $i,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
