<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventIndexRequest;
use App\Http\Resources\EventResource;
use App\Services\EventService;
use Illuminate\Http\JsonResponse;

class EventIndexController extends Controller
{
    public function __construct(
        private readonly EventService $service
    ) {
    }

    public function __invoke(EventIndexRequest $request): JsonResponse
    {
        return response()->json([
            'events' => EventResource::collection($this->service->list($request))
        ]);
    }
}
