<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use App\Models\User;

class FavoritesController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $favorites = $user->favorites()->with('bookings')->get();

        return view('favorites.index', compact('favorites'));
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'sports_field_id' => 'required|exists:sports_fields,id'
        ]);

        $user = Auth::user();
        $sportsFieldId = $request->sports_field_id;

        // Check if already favorited
        $existingFavorite = Favorite::where('user_id', $user->id)
            ->where('sports_field_id', $sportsFieldId)
            ->first();

        if ($existingFavorite) {
            // Remove from favorites
            $existingFavorite->delete();
            $isFavorited = false;
            $message = 'Field removed from favorites';
        } else {
            // Add to favorites
            Favorite::create([
                'user_id' => $user->id,
                'sports_field_id' => $sportsFieldId
            ]);
            $isFavorited = true;
            $message = 'Field added to favorites';
        }

        return response()->json([
            'success' => true,
            'isFavorited' => $isFavorited,
            'message' => $message
        ]);
    }

    public function checkStatus(Request $request)
    {
        $request->validate([
            'sports_field_id' => 'required|exists:sports_fields,id'
        ]);

        $user = auth()->user();
        $isFavorited = Favorite::where('user_id', $user->id)
            ->where('sports_field_id', $request->sports_field_id)
            ->exists();

        return response()->json([
            'success' => true,
            'isFavorited' => $isFavorited
        ]);
    }
}
