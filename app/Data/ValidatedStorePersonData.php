<?php

namespace App\Data;

use App\Enums\Gender;
use Illuminate\Contracts\Support\Arrayable;

/**
 * @phpstan-type ValidatedStorePersonDataShape array{ parent_id: int | null, name: string, gender: value-of<Gender> }
 *
 * @implements Arrayable<key-of<ValidatedStorePersonDataShape>, value-of<ValidatedStorePersonDataShape>>
 */
class ValidatedStorePersonData implements Arrayable
{
    public function __construct(
        public int | null $parentId,
        public string $name,
        public Gender $gender,
    ) {
    }

    /**
     * @return ValidatedStorePersonDataShape|array<model-property<\App\Models\Person>, mixed>
     */
    public function toArray(): array
    {
        return [
            'parent_id' => $this->parentId,
            'name' => $this->name,
            'gender' => $this->gender->value,
        ];
    }
}
