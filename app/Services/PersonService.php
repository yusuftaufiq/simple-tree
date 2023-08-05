<?php

namespace App\Services;

use App\Data\PersonData;
use App\Models\Person;

class PersonService
{
    /**
     * @return \Illuminate\Support\Collection<array-key, \App\Data\PersonData>
     */
    public function all()
    {
        return Person::all()->map(fn (Person $person) => new PersonData(
            id: $person->id,
            parentId: $person->parent_id,
            name: $person->name,
            gender: $person->gender,
        ));
    }
}
