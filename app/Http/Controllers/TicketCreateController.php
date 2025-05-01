<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketCreateRequest;
use App\Services\TicketService;
use Illuminate\Http\JsonResponse;

class TicketCreateController extends Controller
{
    public function __construct(
        private readonly TicketService $service
    ) {
    }

    public function __invoke(TicketCreateRequest $request): JsonResponse
    {
        try {
            $this->service->create($request, $request->user()->id);
        }catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 422);
        }

        return response()->json([
            'message' => 'Ticket created successfully'
        ], 201);
    }
}
