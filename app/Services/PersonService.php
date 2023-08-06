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
        $person = Person::find($id);

        if ($person === null) {
            abort(Response::HTTP_NOT_FOUND, "person with id {$id} not found");
        }

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
        Person::where(['id' => $id])->update($validatedUpdatePersonData->toArray());

        return $this->findOrFail($id);
    }

    public function destroyOrFail(int $id): int
    {
        $count = Person::destroy($id);

        if ($count === 0) {
            abort(Response::HTTP_NOT_FOUND, "person with id {$id} not found");
        }

        return $count;
    }

    public function isIdAlreadyUsedByDescendants(int $id, int $descendantsId): bool
    {
        $person = Person::find($id);

        if ($person === null) {
            abort(Response::HTTP_NOT_FOUND, "person with id {$id} not found");
        }

        return $person->isIdAlreadyUsedByDescendants($descendantsId);
    }
}
