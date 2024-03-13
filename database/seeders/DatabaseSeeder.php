<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//model
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {   


        // Chiamate ai seeders
        $this->call([
            TypeSeeder::class,
            ProjectSeeder::class,
            UserSeeder::class,
            TechnologySeeder::class
        ]);
    }
}
