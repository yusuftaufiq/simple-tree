<?php

namespace App\Http\Requests;

use App\Data\ValidatedUpdatePersonData;
use App\Enums\Gender;
use App\Rules\PreventPersonCircularRelationship;
use Illuminate\Validation\Rule;

/**
 * @phpstan-import-type ValidatedUpdatePersonDataShape from \App\Data\ValidatedUpdatePersonData
 * @phpstan-import-type StorePersonRequestShape from StorePersonRequest
 */
class UpdatePersonRequest extends StorePersonRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return StorePersonRequestShape&array
     */
    public function rules(): array
    {
        /** @var int $currentPerson */
        $currentPerson = request()->route()?->parameter('person');
        $rules = parent::rules();

        return [
            ...$rules,
            'parent_id' => [
                Rule::notIn([$currentPerson]),
                new PreventPersonCircularRelationship($currentPerson),
                ...$rules['parent_id'],
            ],
        ];
    }

    /**
     * Convert the request into a data transfer object.
     */
    public function toUpdatePersonDto(): ValidatedUpdatePersonData
    {
        /** @var ValidatedUpdatePersonDataShape $validated */
        $validated = $this->safe()->toArray();

        return new ValidatedUpdatePersonData(
            parentId: $validated['parent_id'] ?? null,
            name: $validated['name'],
            gender: Gender::from($validated['gender']),
        );
    }
}
