<?php

namespace App\Http\Controllers;

use App\Services\GenderService;
use App\Services\PersonService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

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
    public function __invoke(): View|Factory
    {
        return view('home.index', [
            'genders' => $this->genderService->all(),
            'persons' => $this->personService->all(),
        ]);
    }
}
