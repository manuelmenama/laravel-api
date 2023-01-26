<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Tecnology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectsTecnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 60; $i++){
            $project = Project::inRandomOrder()->first();

            $tecnology_id = Tecnology::inRandomOrder()->first()->id;

            $project->tecnologies()->attach($tecnology_id);
        }
    }
}
