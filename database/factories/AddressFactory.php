<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

    /**
     * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
     */
class AddressFactory extends Factory
{
        // protected $model = Address::class;
        /**
         * Define the model's default state.
         *
         * @return array<string, mixed>
         */
        public function definition(): array
        {
            return [
                'street' => $this->faker->streetName(),
                'full_address' => $this->faker->address(),
                'phone' => $this->faker->phoneNumber(),
                'prov_id' => $this->faker->numberBetween(1, 34),
                'city_id' => $this->faker->numberBetween(1, 100),
                'district_id' => $this->faker->numberBetween(1, 100),
                'postal_code' => $this->faker->postcode,
                'user_id' => $this->faker->numberBetween(1, 10),
                'is_default' => $this->faker->boolean,
            ];
        }
}
