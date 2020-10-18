<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'invoice_no' => $this->faker->randomNumber(5),
            'terms' => $this->faker->randomElement(['15', '30', '45', 'Custom']),
            'due_date' => $this->faker->dateTimeBetween('now', '+45 days'),
        ];
    }
}
