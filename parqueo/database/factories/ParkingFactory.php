<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ParkingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    private static $order = 1;
    public function definition()
    {
        return [
            'name' => 'espacio '.(self::$order++),
            'status' => 'available',
        ];
    }
}
