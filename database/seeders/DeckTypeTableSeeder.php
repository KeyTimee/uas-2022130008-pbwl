<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeckTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('deck_types')->delete();

        DB::table('deck_Types')->insert([
            ['name' => 'Standard', 'description' => 'Only for Standard Mode'],
            ['name' => 'Wild', 'description' => 'For All Games Mode'],
            // Tambahkan kelas lainnya sesuai kebutuhan
        ]);
    }
}
