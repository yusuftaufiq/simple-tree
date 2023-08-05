<?php

namespace App\Services;

use App\Data\PersonData;
use App\Enums\Gender;

class PersonService {
    /**
     * @return \Illuminate\Support\Collection<array-key, \App\Data\PersonData>
     */
    public function all() {
        $persons = [
            [
                'id' => 1,
                'parent_id' => null,
                'name' => 'Budi',
                'gender' => 'MALE',
            ],
            [
                'id' => 2,
                'parent_id' => 1,
                'name' => 'Dedi',
                'gender' => 'MALE',
            ],
            [
                'id' => 3,
                'parent_id' => 1,
                'name' => 'Dodi',
                'gender' => 'MALE',
            ],
            [
                'id' => 4,
                'parent_id' => 1,
                'name' => 'Dede',
                'gender' => 'MALE',
            ],
            [
                'id' => 5,
                'parent_id' => 1,
                'name' => 'Dewi',
                'gender' => 'FEMALE',
            ],
            [
                'id' => 6,
                'parent_id' => 2,
                'name' => 'Feri',
                'gender' => 'MALE',
            ],
            [
                'id' => 7,
                'parent_id' => 2,
                'name' => 'Farah',
                'gender' => 'FEMALE',
            ],
            [
                'id' => 8,
                'parent_id' => 3,
                'name' => 'Gugus',
                'gender' => 'MALE',
            ],
            [
                'id' => 9,
                'parent_id' => 3,
                'name' => 'Gandi',
                'gender' => 'MALE',
            ],
            [
                'id' => 10,
                'parent_id' => 4,
                'name' => 'Hana',
                'gender' => 'FEMALE',
            ],
            [
                'id' => 11,
                'parent_id' => 4,
                'name' => 'Hani',
                'gender' => 'FEMALE',
            ],
        ];

        return collect($persons)->map(fn ($person) => new PersonData(
            id: $person['id'],
            parentId: $person['parent_id'],
            name: $person['name'],
            gender: Gender::from($person['gender']),
        ));
    }
}
