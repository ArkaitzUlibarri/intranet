<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        $this->call([
            ContractTypeSeeder::class,
            CategorySeeder::class
        ]);
        Client::factory(10)->create();
        Project::factory(10)->create();
    }
}
