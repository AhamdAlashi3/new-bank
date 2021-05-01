<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'cus_name' =>$this->faker->name,
            'city'=>$this->faker->city,
            'work'=>$this->faker->jobTitle,
            'email' => $this->faker->safeEmail,
            'phone'=>$this->faker->phoneNumber,
            'gender' => 'M',
            'email_verified_at' => now(),
            'password'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token'=>Str::random(10),
        ];
    }
}