<?php

namespace App\Http\Controllers;

use App\Http\Resources\VenueResource;
use App\Services\VenueService;
use Illuminate\Http\JsonResponse;

class VenueIndexController extends Controller
{
    public function __construct(
        private readonly VenueService $venueService
    ) {
    }

    public function __invoke(): JsonResponse
    {
        return response()->json([
            'venues' => VenueResource::collection($this->venueService->list())
        ]);
    }
}
