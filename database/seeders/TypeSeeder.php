<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//model
use App\Models\Type;
// Helpers
use Illuminate\Support\Str;
//helper
use Illuminate\Support\Facades\Schema;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //svuoto prima di riempire
        Schema::withoutForeignKeyConstraints(function () {
            Type::truncate();
        });

        $types = [
            'Sito Web Statico',
            'Sito Web CMS',
            'Sito Web E-commerce',
            'Sito Web Responsive'
        ];

        foreach ($types as $singleType) {
            $type = Type::create([
                'name' => $singleType,
                'slug' => Str::slug($singleType),
            ]);
        }
    }
}
