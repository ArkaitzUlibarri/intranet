<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->name(),
            'description' => 'Description',
            'client_id' => (Client::all())->random()->id,
            'start_date' => $this->faker->dateTimeBetween('-10 years', 'now'),
            'end_date' => null,
    //        'manager_id' => '',
        ];
    }

   /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Project $project) {
            $project->name = 'Project' . ' ' . $project->id;
            $project->description = $project->name . ' ' . $project->description;
            $project->end_date = $this->faker->boolean(25) ? Carbon::parse($project->start_date)->addMonth() : null;
            $project->save();
        });
    }
}
