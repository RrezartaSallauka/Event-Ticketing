<?php

namespace App\Http\Controllers;

use App\Http\Resources\TicketResource;
use App\Services\TicketService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketIndexController extends Controller
{
    public function __construct(
        private readonly TicketService $service
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        return response()->json([
            'tickets' => TicketResource::collection($this->service->list($request->user()->id))
        ]);
    }
}
