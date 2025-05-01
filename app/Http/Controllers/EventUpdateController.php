<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventUpdateRequest;
use App\Services\EventService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class EventUpdateController extends Controller
{
    public function __construct(
        private readonly EventService $service
    ) {
    }

    public function __invoke(EventUpdateRequest $request, int $eventId): JsonResponse
    {
        try {
            $this->service->update($request, $eventId);
        } catch (ModelNotFoundException) {
            return response()->json([
                'message' => 'Event with id ' . $eventId . ' does not exist'
            ], 422);
        }

        return response()->json([
            'message' => 'Event updated successfully'
        ]);
    }
}
