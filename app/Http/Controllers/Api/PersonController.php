<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Services\PersonService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

final class PersonController extends Controller
{
    public function __construct(
        private readonly PersonService $personService,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $persons = $this->personService->all();

        return JsonResource::collection($persons)->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonRequest $request): JsonResponse
    {
        $validatedPerson = $request->toStorePersonDto();
        $person = $this->personService->create($validatedPerson);

        return (new JsonResource($person))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $person = $this->personService->findOrFail($id);

        return (new JsonResource($person))->response();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonRequest $request, int $id): JsonResponse
    {
        $validatedPerson = $request->toUpdatePersonDto();
        $person = $this->personService->updateOrFail($validatedPerson, $id);

        return (new JsonResource($person))->response();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $this->personService->destroyOrFail($id);

        return response()->json()->setStatusCode(Response::HTTP_NO_CONTENT);
    }
}
