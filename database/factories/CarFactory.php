<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Car::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'car_name' =>$this->faker->name,
            'price'=>$this->faker->buildingNumber,
            'type' => $this->faker->mimeType,
            'model'=>$this->faker->buildingNumber,
            'sour_car' => $this->faker->name,
            'merchant_id' => $this->faker->numberBetween(1, 20),
        ];
    }
}
