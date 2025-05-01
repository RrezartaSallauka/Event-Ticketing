<?php

namespace App\Services;

use App\Http\Requests\TicketCreateRequest;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Collection;

class TicketService
{
    public function create(TicketCreateRequest $request, int $userId): void
    {
        $event = Event::withCount('tickets')->where('id', '=', $request->event_id)->first();
        if ($event->tickets_count >= $event->venue->capacity) {
            throw new \Exception('No more tickets available');
        }

        $isSeatTaken = Ticket::query()->where('event_id', '=', $event->id)
            ->where('seat', '=', $request->seat)->exists();
        if ($isSeatTaken) {
            throw new \Exception('Seat is not available');
        }

        Ticket::create([
            'user_id' => $userId,
            'event_id' => $event->id,
            'price' => $request->price,
            'seat' => $request->seat
        ]);

    }
    public function list(int $userId): Collection
    {
        return Ticket::query()->where('tickets.user_id', '=', $userId)
            ->join('events', function ($join) {
                $join->on('tickets.event_id', '=', 'events.id');
            })
            ->where('events.date', '>=', now()->format('Y-m-d'))
            ->orderBy('events.date')->get();
    }
}
