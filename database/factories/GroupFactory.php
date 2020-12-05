<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Group::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'project_id' => (Project::all())->random()->id,
            'name' => $this->faker->unique()->name(),
            'enabled' => $this->faker->boolean(95),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Group $group) {
            $group->name = 'Group' . ' ' . $group->id;
            $group->save();
        });
    }
}
