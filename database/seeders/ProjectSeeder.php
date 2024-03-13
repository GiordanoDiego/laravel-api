<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Helpers
use Illuminate\Support\Str;

//model
use App\Models\Project;
use App\Models\Type;

//helper
use Illuminate\Support\Facades\Schema;

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
        
        for ($i = 0; $i < 10; $i++) {
            $project = new Project();
            $randomType = Type::inRandomOrder()->first();

            $project->title = fake()->sentence();
            $project->slug = Str::slug($project->title);
            $project->content = fake()->paragraph();
            $project->type_id = $randomType->id;
            
            
            $project->save();

        }
    }
}
