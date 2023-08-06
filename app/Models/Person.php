<?php

namespace App\Models;

use App\Enums\Gender;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Person extends Model
{
    use HasFactory;
    use HasRecursiveRelationships;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'persons';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be cast.
     *
     * @var array<model-property<Person>, class-string>
     */
    protected $casts = [
        'gender' => Gender::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<model-property<Person>>
     */
    protected $fillable = [
        'name',
        'parent_id',
        'gender',
    ];

    /**
     * Check if the given id is already in use by the current person's
     * descendants (recursive children) to prevent circular relationships.
     */
    public function isIdAlreadyUsedByDescendants(int $id): bool
    {
        /** @var \Illuminate\Database\Eloquent\Collection<int, Person> $descendants */
        $descendants = $this->descendants()->get();

        return $descendants->some(fn (Person $person) => $person->id === $id);
    }
}
