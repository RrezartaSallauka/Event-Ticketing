<?php

namespace App\Http\Controllers;

use App\Services\EventService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventDeleteController extends Controller
{
    public function __construct(
        private readonly EventService $service
    ) {
    }

    public function __invoke(Request $request, int $eventId): JsonResponse
    {
        try {
            $this->service->delete($eventId);
        } catch (ModelNotFoundException) {
            return response()->json([
                'message' => 'Event with id ' . $eventId . ' does not exist'
            ], 422);
        }

        return response()->json([
            'message' => 'Event deleted successfully'
        ]);
    }
}
