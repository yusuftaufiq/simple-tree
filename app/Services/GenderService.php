<?php

namespace App\Services;

use App\Enums\Gender;

class GenderService {
    /**
     * @return \Illuminate\Support\Collection<array-key, string>
     */
    public function all() {
        return collect(Gender::cases())->map(fn ($v) => $v->value);
    }
}
