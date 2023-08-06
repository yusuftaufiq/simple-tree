<?php

namespace App\Data;

use App\Enums\Gender;
use Illuminate\Contracts\Support\Arrayable;

/**
 * @phpstan-import-type ValidatedStorePersonDataShape from ValidatedStorePersonData
 * @phpstan-type SavedPersonShape array{ id: int }&ValidatedStorePersonDataShape
 *
 * @implements Arrayable<key-of<SavedPersonShape>, value-of<SavedPersonShape>>
 */
class PersonData implements Arrayable
{
    public function __construct(
        public int $id,
        public int | null $parentId,
        public string $name,
        public Gender $gender,
    ) {
    }

    /**
     * @return SavedPersonShape|array<model-property<\App\Models\Person>, mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'parent_id' => $this->parentId,
            'name' => $this->name,
            'gender' => $this->gender->value,
        ];
    }
}
