<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Helpers
use Illuminate\Support\Str;

//model
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;


//helper
use Illuminate\Support\Facades\Schema;

use Faker\Factory as FakerFactory;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Project::truncate();
        Schema::enableForeignKeyConstraints();
        
        $technologies = Technology::all();
        for ($i = 0; $i < 10; $i++) {
            $faker = FakerFactory::create();
            $project = new Project();
            $randomType = Type::inRandomOrder()->first();

            $project->title = $faker->sentence();
            $project->slug = Str::slug($project->title);
            $project->content = $faker->paragraph();
            $project->type_id = $randomType->id;
            
            $project->save();

            

            // Determina il numero di tecnologie casuali da assegnare (da 1 a 3)
            $numberOfTechnologies = min(3, $technologies->count()); // Assicura che il numero non superi la quantità disponibile
            // Ottieni un insieme casuale di tecnologie
            $randomTechnologies = $technologies->random($numberOfTechnologies);
            // Associa le tecnologie al progetto
            $project->technologies()->attach($randomTechnologies->pluck('id')->toArray());
        }
    }
}
