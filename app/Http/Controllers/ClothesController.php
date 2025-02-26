<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cloth;
use Illuminate\Support\Facades\Auth;

class ClothesController extends Controller {

    // Only returns clothes belonging to the authenticated user.
    public function index() {
        $clothes = Cloth::where('user_id', auth()->id())->get();
        return response()->json($clothes);
    }

    // Stores a new cloth associated with the current user.
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'isFavorite' => 'boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('clothes', 'public');
            $validated['image_url'] = asset('storage/' . $path);
        }

        // Associate the new cloth with the authenticated user.
        $validated['user_id'] = auth()->id();

        $cloth = Cloth::create($validated);
        return response()->json($cloth, 201);
    }

    // Updates an existing cloth, but only if it belongs to the current user.
    public function update(Request $request, Cloth $cloth) {
        // Ensure that the cloth belongs to the authenticated user.
        if ($cloth->user_id !== auth()->id()) {
            abort(403, "Unauthorized action.");
        }

        $validated = $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'isFavorite' => 'boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('clothes', 'public');
            $validated['image_url'] = asset('storage/' . $path);
        }

        $cloth->update($validated);
        return response()->json($cloth);
    }

    // Deletes a cloth, but only if it belongs to the authenticated user.
    public function destroy(Cloth $cloth) {
        // Ensure that the cloth belongs to the authenticated user.
        if ($cloth->user_id !== auth()->id()) {
            abort(403, "Unauthorized action.");
        }

        $cloth->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
