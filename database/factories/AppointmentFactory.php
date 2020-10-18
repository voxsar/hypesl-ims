<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AppointmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Appointment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $start = $this->faker->dateTimeBetween('now', '+2 weeks');
        $start = Carbon::parse($start);
        return [
            //
            'allday' => $this->faker->boolean(),
            'start' => $start,
            'end' => $start->addHours(2),
            'title' => $this->faker->company(),
            'description' => $this->faker->paragraph(),
            'url' => $this->faker->url(),
            'classNames' => $this->faker->word(),
            'editable' => $this->faker->boolean(),
            'startEditable' => $this->faker->boolean(),
            'durationEditable' => $this->faker->boolean(),
            'resourceEditable' => $this->faker->boolean(),
            'display' => $this->faker->randomElement(['auto', 'block', 'list-item']),
            'overlap' => $this->faker->boolean(),
            'backgroundColor' => $this->faker->hexcolor(),
            'borderColor' => $this->faker->hexcolor(),
            'textColor' => $this->faker->hexcolor(),
            'extendedProps' => '[]',
        ];
    }
}
