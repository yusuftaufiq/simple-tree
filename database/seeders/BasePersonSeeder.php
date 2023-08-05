<?php

namespace Database\Seeders;

use App\Enums\Gender;
use App\Models\Person;
use Illuminate\Database\Seeder;

class BasePersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $budi = Person::create(['name' => 'Budi', 'gender' => Gender::Male]);

        $dedi = Person::create(['name' => 'Dedi', 'gender' => Gender::Male, 'parent_id' => $budi->id]);
        $dodi = Person::create(['name' => 'Dodi', 'gender' => Gender::Male, 'parent_id' => $budi->id]);
        $dede = Person::create(['name' => 'Dede', 'gender' => Gender::Male, 'parent_id' => $budi->id]);
        $dewi = Person::create(['name' => 'Dewi', 'gender' => Gender::Female, 'parent_id' => $budi->id]);

        $feri = Person::create(['name' => 'Dedi', 'gender' => Gender::Male, 'parent_id' => $dedi->id]);
        $farah = Person::create(['name' => 'Farah', 'gender' => Gender::Female, 'parent_id' => $dedi->id]);

        $feri = Person::create(['name' => 'Gugus', 'gender' => Gender::Male, 'parent_id' => $dodi->id]);
        $farah = Person::create(['name' => 'Gandi', 'gender' => Gender::Male, 'parent_id' => $dodi->id]);

        $hana = Person::create(['name' => 'Hana', 'gender' => Gender::Female, 'parent_id' => $dede->id]);
        $hani = Person::create(['name' => 'Hani', 'gender' => Gender::Female, 'parent_id' => $dede->id]);
    }
}
