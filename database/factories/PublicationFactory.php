<?php

namespace Database\Factories;

use App\Models\Publication;
use App\Models\Journal;
use Illuminate\Database\Eloquent\Factories\Factory;

class PublicationFactory extends Factory
{
    protected $model = Publication::class;

    public function definition()
    {
        return [
            'journal_id' => Journal::factory(),
            'title' => $this->faker->sentence(4),
            'publication_date' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
        ];
    }
}