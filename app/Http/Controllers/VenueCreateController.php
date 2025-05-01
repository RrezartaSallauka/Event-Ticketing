<?php

namespace App\Http\Controllers;

use App\Http\Requests\VenueCreateRequest;
use App\Services\VenueService;
use Illuminate\Http\JsonResponse;

class VenueCreateController extends Controller
{
    public function __construct(
        private readonly VenueService $venueService
    ) {
    }

    public function __invoke(VenueCreateRequest $request): JsonResponse
    {
        $this->venueService->create($request);

        return response()->json([
            'message' => 'Venue created successfully'
        ], 201);
    }
}
