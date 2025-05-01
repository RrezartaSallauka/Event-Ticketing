<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventCreateRequest;
use App\Services\EventService;

class EventCreateController extends Controller
{
    public function __construct(
        private readonly EventService $service
    ) {
    }

    public function __invoke(EventCreateRequest $request)
    {
        $this->service->create($request, $request->user()->id);

        return response()->json([
            'message' => 'Event created successfully'
        ], 201);
    }
}
