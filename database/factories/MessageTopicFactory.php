<?php

namespace Database\Factories;

use App\Models\MessageTopic;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MessageTopicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MessageTopic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->name(),
            'status' => $this->faker->randomElement(['Pending', 'Open', 'Canceled', 'Closed'])
        ];
    }
}
