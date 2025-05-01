<?php

namespace App\Services;

use App\Http\Requests\VenueCreateRequest;
use App\Models\Venue;
use Illuminate\Database\Eloquent\Collection;

class VenueService
{
    public function create(VenueCreateRequest $request): void
    {
        Venue::create([
            'name' => $request->get('name'),
            'location' => $request->get('location'),
            'capacity' => $request->get('capacity')
        ]);
    }
    public function list(): Collection
    {
        return Venue::all();
    }
}
