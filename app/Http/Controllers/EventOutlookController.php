<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\EventOutlook;
use app\Events\EventCreatedOutlook;

class EventOutlookController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        // Create an event model instance
        $event = new EventOutlook($validatedData);

        // Dispatch job for creating the event in Outlook
        EventCreatedOutlook::dispatch($event);

        // Display success message
        return response()->json(['message' => 'Event created successfully!']);
    }
}
