<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Group;
use App\Models\Project;
use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Seeder;

class FactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();

        //Seed with fake values
        Client::factory(10)
            ->has(
                Project::factory()
                    ->count(2)
                    ->state(function (array $attributes, Client $client) {
                        return ['client_id' => $client->id];
                    })
                    ->hasGroups(3, function (array $attributes, Project $project) {
                        return ['project_id' => $project->id];
                    })
            )
            ->create();


        //Categories
        //Groups

        //Contract/Reduction/Teleworking
        //Working Report
    }
}
