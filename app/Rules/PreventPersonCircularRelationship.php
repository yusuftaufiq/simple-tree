<?php

namespace App\Rules;

use App\Models\Person;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PreventPersonCircularRelationship implements ValidationRule
{
    private readonly Person $person;

    public function __construct(int $personId)
    {
        $this->person = Person::findOrFail($personId);
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (is_numeric($value) === false) {
            $fail('parent id should be a number');

            return;
        }

        if ($this->person->isIdAlreadyUsedByDescendants((int) $value) === true) {
            $fail("parent of {$this->person->name} cannot be one of its ascendants");
        }
    }
}
