<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validate the incoming request data
        $fields = $request->validate([
            'avatar'   => ['file', 'nullable', 'max:3000'],
            'name'     => ['required', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed']
        ]);

        // Save the avatar if it exists; otherwise assign a default avatar
        if ($request->hasFile('avatar')) {
            // This stores the uploaded file in storage/app/public/avatars
            // and returns the path to be stored in the database.
            $fields['avatar'] = $request->file('avatar')->store('avatars', 'public');
        } else {
            // Set the default avatar path (ensure this file exists in public/avatars/default.jpeg)
            $fields['avatar'] = 'avatars/default.jpeg';
        }

        // Create the user record in the database
        $user = User::create($fields);

        // Log the user in
        Auth::login($user);

        // Redirect to the dashboard with a welcome message
        return redirect()
            ->route('dashboard')
            ->with('message', 'Welcome to Laravel Inertia Vue app');
    }

    public function login(Request $request)
    {
        // Validate the login data
        $fields = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to log the user in
        if (Auth::attempt($fields, $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        // If authentication fails, return back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        // Log the user out
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        // Redirect the user to the home page
        return redirect()->route('home');
    }
}
