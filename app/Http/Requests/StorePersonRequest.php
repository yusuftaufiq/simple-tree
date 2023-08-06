<?php

namespace App\Http\Requests;

use App\Data\ValidatedStorePersonData;
use App\Enums\Gender;
use App\Models\Person;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @phpstan-import-type UnsavedPersonShape from \App\Data\ValidatedStorePersonData
 * @phpstan-type StorePersonRequestShape array{ parent_id: array<mixed>, name: array<mixed>, gender: array<mixed> }
 */
class StorePersonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return StorePersonRequestShape&array
     */
    public function rules(): array
    {
        return [
            'parent_id' => [
                'nullable',
                Rule::exists(Person::class, 'id'),
            ],
            'name' => ['max:255', 'required'],
            'gender' => [Rule::enum(Gender::class), 'required'],
        ];
    }

    /**
     * Convert the request into a data transfer object.
     */
    public function toDto(): ValidatedStorePersonData
    {
        /** @var UnsavedPersonShape $validated */
        $validated = $this->safe()->toArray();

        return new ValidatedStorePersonData(
            parentId: $validated['parent_id'],
            name: $validated['name'],
            gender: Gender::from($validated['gender']),
        );
    }
}
