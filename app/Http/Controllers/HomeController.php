<?php

namespace App\Http\Controllers;

use App\Services\GenderService;
use App\Services\PersonService;

final class HomeController extends Controller
{
    public function __construct(
        private readonly GenderService $genderService,
        private readonly PersonService $personService,
    ) {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('home.pages.index', [
            'genders' => $this->genderService->all(),
            'persons' => $this->personService->all(),
        ]);
    }
}
