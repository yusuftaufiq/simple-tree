<?php

namespace App\Services;

use App\Data\PersonData;
use App\Data\ValidatedStorePersonData;
use App\Data\ValidatedUpdatePersonData;
use App\Models\Person;
use Symfony\Component\HttpFoundation\Response;

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

    public function findOrFail(int $id): PersonData
    {
        $person = Person::findOrFail($id);

        return new PersonData(
            id: $person->id,
            parentId: $person->parent_id,
            name: $person->name,
            gender: $person->gender,
        );
    }

    public function create(ValidatedStorePersonData $validatedStorePersonData): PersonData
    {
        $person = Person::create($validatedStorePersonData->toArray());

        return new PersonData(
            id: $person->id,
            parentId: $person->parent_id,
            name: $person->name,
            gender: $person->gender,
        );
    }

    public function updateOrFail(ValidatedUpdatePersonData $validatedUpdatePersonData, int $id): PersonData
    {
        $count = (int) Person::where(['id' => $id])->update($validatedUpdatePersonData->toArray());

        if ($count === 0) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return new PersonData(
            id: $id,
            parentId: $validatedUpdatePersonData->parentId,
            name: $validatedUpdatePersonData->name,
            gender: $validatedUpdatePersonData->gender,
        );
    }

    public function destroyOrFail(int $id): int
    {
        $count = Person::destroy($id);

        if ($count === 0) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return $count;
    }
}
