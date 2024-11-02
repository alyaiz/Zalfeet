<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Size::create([
            'name' => '38',
            'type' => 'shoe_size'
        ]);

        Size::create([
            'name' => '39',
            'type' => 'shoe_size'
        ]);

        Size::create([
            'name' => '40',
            'type' => 'shoe_size'
        ]);

        Size::create([
            'name' => '41',
            'type' => 'shoe_size'
        ]);

        Size::create([
            'name' => '42',
            'type' => 'shoe_size'
        ]);

        Size::create([
            'name' => '43',
            'type' => 'shoe_size'
        ]);

        Size::create([
            'name' => '44',
            'type' => 'shoe_size'
        ]);

        Size::create([
            'name' => 'FR',
            'type' => 'kids_1_3_size'
        ]);

        Size::create([
            'name' => 'FR',
            'type' => 'kids_4_6_size'
        ]);
    }
}
