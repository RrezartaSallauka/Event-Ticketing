<?php

namespace App\Services;

use App\Http\Requests\EventCreateRequest;
use App\Http\Requests\EventIndexRequest;
use App\Http\Requests\EventUpdateRequest;
use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;

class EventService
{
    public function create(EventCreateRequest $request, int $userId): void
    {
        Event::create([
            'user_id' => $userId,
            'venue_id' => $request->get('venue_id'),
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ]);
    }
    public function list(EventIndexRequest $request): Collection
    {
        $query = Event::query();
        if ($request->has('start_at')) {
            $query->where('date', '>=', $request->start_at);
        }
        if ($request->has('end_at')) {
            $query->where('date', '<=', $request->end_at);
        }
        if ($request->has('venue_id')) {
            $query->where('venue_id', '=', $request->venue_id);
        }
        if ($request->has('upcoming') && $request->get('upcoming')) {
            $query->where('date', '>=', now()->format('Y-m-d'));
        }

        return $query->get();
    }


    public function update(EventUpdateRequest $request, int $eventId): void
    {
        $event = Event::where('id', '=', $eventId)->firstOrFail();

        if ($request->has('name')) {
            $event->name = $request->get('name');
        }

        if ($request->has('description')) {
            $event->description = $request->get('description');
        }

        if ($request->has('venue_id')) {
            $event->venue_id = $request->get('venue_id');
        }

        $event->save();
    }

    public function delete(int $eventId): void
    {
        $event = Event::where('id', '=', $eventId)->firstOrFail();
        $event->delete();
    }
}
