<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Services\PersonService;
use Illuminate\Http\RedirectResponse;

final class PersonController extends Controller
{
    public function __construct(
        private readonly PersonService $personService,
    ) {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonRequest $request): RedirectResponse
    {
        $validatedPerson = $request->toStorePersonDto();

        $this->personService->create($validatedPerson);

        return redirect()->back()->with('success', 'Successfully inserted a new person.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonRequest $request, int $id): RedirectResponse
    {
        $validatedPerson = $request->toUpdatePersonDto();

        $this->personService->updateOrFail($validatedPerson, $id);

        return redirect()->back()->with('success', 'Successfully updated a person.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->personService->destroyOrFail($id);

        return redirect()->back()->with('success', 'Successfully deleted a person.');
    }
}
