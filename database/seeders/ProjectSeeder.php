<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $type_ids = Type::select('id')->pluck('id')->toArray();


        for ($i = 0; $i < 5; $i++) {
            $project = new Project();
            $project->title = $faker->company();
            // $project->image = $faker->imageUrl(300, 200, 'animals', true);
            $project->content = $faker->paragraph();
            $project->slogan = $faker->sentence();
            $project->save();
        }
    }
}
