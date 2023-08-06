<?php

namespace App\Rules;

use App\Services\PersonService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PreventPersonCircularRelationship implements ValidationRule
{
    private readonly PersonService $personService;

    public function __construct(
        private readonly int $personId
    ) {
        $this->personService = app(PersonService::class);
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

        if ($this->personService->isIdAlreadyUsedByDescendants($this->personId, (int) $value) === true) {
            $fail('parent cannot be one of its ascendants');
        }
    }
}
