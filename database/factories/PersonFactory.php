<?php

namespace Database\Factories;

use App\Enums\Gender;
use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Configure the factory.
     */
    public function configure(): self
    {
        return $this->afterCreating(function (): void {
            if (fake()->boolean(chanceOfGettingTrue: 40) === false) {
                return;
            }

            /** @var \Illuminate\Database\Eloquent\Collection<Person> $persons */
            $persons = Person::whereNull('parent_id')
                ->get()
                ->filter(fn (): bool => fake()->boolean(chanceOfGettingTrue: 40));

            /** @var Person $person */
            $person = Person::factory()->create();

            Person::whereIn(column: 'id', values: $persons->pluck('id'))
                ->update([
                    'parent_id' => $person->id,
                ]);
        });
    }

    /**
     * Define the model's default state.
     *
    * @return array{ name: string, gender: Gender }
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'gender' => fake()->randomElement(Gender::cases()),
        ];
    }
}
