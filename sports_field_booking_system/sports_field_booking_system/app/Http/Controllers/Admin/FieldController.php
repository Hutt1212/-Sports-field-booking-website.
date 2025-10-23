<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SportsField;
use Illuminate\Support\Facades\Auth;

class FieldController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access. Admin privileges required.');
        }

        $fields = SportsField::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.fields.index', compact('fields'));
    }

    public function create()
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access. Admin privileges required.');
        }

        return view('admin.fields.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access. Admin privileges required.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sport_type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'size' => 'required|string|max:255',
            'surface' => 'required|string|max:255',
            'price_per_90min' => 'required|integer|min:0',
            'opening_time' => 'required|date_format:H:i',
            'closing_time' => 'required|date_format:H:i|after:opening_time',
            'status' => 'required|in:active,maintenance,unavailable',
        ]);

        $field = SportsField::create($validated);

        // Create notifications for all users about new field
        $users = \App\Models\User::where('role', 'user')->get();
        foreach ($users as $user) {
            \App\Models\Notification::create([
                'user_id' => $user->id,
                'type' => 'field_created',
                'title' => 'New Field Available',
                'message' => "A new {$field->sport_type} field '{$field->name}' has been added at {$field->location}.",
                'data' => ['field_id' => $field->id]
            ]);
        }

        return redirect()->route('fields.index')
            ->with('success', 'Field created successfully!');
    }

    public function show(SportsField $field)
    {
        return view('admin.fields.show', compact('field'));
    }

    public function edit(SportsField $field)
    {
        return view('admin.fields.edit', compact('field'));
    }

    public function update(Request $request, SportsField $field)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sport_type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'size' => 'required|string|max:255',
            'surface' => 'required|string|max:255',
            'price_per_90min' => 'required|integer|min:0',
            'opening_time' => 'required|date_format:H:i',
            'closing_time' => 'required|date_format:H:i|after:opening_time',
            'status' => 'required|in:active,maintenance,unavailable',
        ]);

        $field->update($validated);

        // Create notifications for all users about field update
        $users = \App\Models\User::where('role', 'user')->get();
        foreach ($users as $user) {
            \App\Models\Notification::create([
                'user_id' => $user->id,
                'type' => 'field_updated',
                'title' => 'Field Updated',
                'message' => "The field '{$field->name}' has been updated. Check the latest details and pricing.",
                'data' => ['field_id' => $field->id]
            ]);
        }

        return redirect()->route('fields.index')
            ->with('success', 'Field updated successfully!');
    }

    public function destroy(SportsField $field)
    {
        $field->delete();

        return redirect()->route('fields.index')
            ->with('success', 'Field deleted successfully!');
    }

    public function updateTimeSlots(Request $request, SportsField $field)
    {
        $validated = $request->validate([
            'time_slots' => 'required|array',
            'time_slots.*.start_time' => 'required|date_format:H:i',
            'time_slots.*.end_time' => 'required|date_format:H:i|after:time_slots.*.start_time',
            'time_slots.*.available' => 'required|boolean',
        ]);

        $field->update(['time_slots' => $validated['time_slots']]);

        return redirect()->route('fields.show', $field->id)
            ->with('success', 'Cập nhật khung giờ thành công!');
    }
}
