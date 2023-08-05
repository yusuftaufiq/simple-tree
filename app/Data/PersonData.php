<?php

namespace App\Data;

use App\Enums\Gender;
use Illuminate\Contracts\Support\Arrayable;

final class PersonData implements Arrayable {
    public function __construct(
        public int $id,
        public int | null $parentId,
        public string $name,
        public Gender $gender,
    ) {
    }

    function toArray(): array
    {
        return [
            'id' => $this->id,
            'parentId' => $this->parentId,
            'name' => $this->name,
            'gender' => $this->gender->value,
        ];
    }
}
