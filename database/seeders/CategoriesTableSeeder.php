<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->delete();

        DB::table('categories')->insert([
            ['name' => 'Warrior', 'description' => 'Strong and resilient fighter'],
            ['name' => 'Mage', 'description' => 'Caster of powerful spells'],
            ['name' => 'Druid', 'description' => 'Nature-based magic wielder'],
            ['name' => 'Hunter', 'description' => 'Ranged attacker with traps'],
            ['name' => 'Neutral', 'description' => 'Universal for every Class'],
            // Tambahkan kelas lainnya sesuai kebutuhan
        ]);
    }
}
