<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $situations = ['online', 'offline'];
        $categories = ['A', 'B', 'C', 'D'];

        $situation = $situations[rand(0, count($situations) - 1)];
        $category = $categories[rand(0, count($categories) - 1)];
        return [
            //
            'name' => $this->faker->name,
            'title' => $this->faker->word,
            'image' => $this->faker->imageUrl,
            'body' => $this->faker->realText,
            'start_date' => $this->faker->dateTimeBetween('+1 week', '+2 week'),
            'finish_date' => $this->faker->dateTimeBetween('+2 week', '+3 week'),
            'situation' => $situation,
            'venue' => $this->faker->secondaryAddress,
            'category' => $category,
            'address' => $this->faker->prefecture,
        ];
    }
}
