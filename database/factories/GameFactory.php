<?php

namespace Database\Factories;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-30 days', '-1 hour');
        $endDateStart = (clone $startDate)->add(new \DateInterval('PT5M'));
        $endDateEnd = (clone $endDateStart)->add(new \DateInterval('PT59M'));

        $endDate = $this->faker->dateTimeBetween(
            $endDateStart,
            $endDateEnd,
        );
        return [
            'started_at' => $startDate,
            'ended_at' => $endDate,
        ];
    }
}
