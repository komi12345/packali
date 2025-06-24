<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    // Method to show the settings page
    public function index()
    {
        // Gate to check if user is super admin
        if (!Auth::user()->is_super_admin) {
            abort(403, 'Unauthorized action.');
        }
        $users = User::where('is_admin', true)->get();
        return view('admin.settings.index', compact('users'));
    }

    // Method to update theme preference
    public function updateTheme(Request $request)
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        if ($user) {
            $theme = $request->input('theme', 'light'); // Default to light theme
            $user->theme = $theme;
            $user->save();
            session(['theme' => $theme]); // Also update session for immediate effect
            return back()->with('success', 'Theme updated successfully.');
        }

        return back()->with('error', 'User not authenticated.');
    }

    // Method to add a new admin user
    public function storeUser(Request $request)
    {
        if (!Auth::user()->is_super_admin) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'is_admin' => 'required|boolean',
            'is_super_admin' => 'nullable|boolean',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $request->is_admin,
            'is_super_admin' => $request->filled('is_super_admin') ? $request->is_super_admin : false,
            'email_verified_at' => now(), // Optionally verify email immediately
        ]);

        return back()->with('success', 'Admin user created successfully.');
    }

    // Method to show edit form for an admin user
    public function editUser(User $user)
    {
        if (!Auth::user()->is_super_admin) {
            abort(403, 'Unauthorized action.');
        }
        return view('admin.settings.edit_user', compact('user'));
    }

    // Method to update an admin user
    public function updateUser(Request $request, User $user)
    {
        if (!Auth::user()->is_super_admin) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'is_admin' => 'required|boolean',
            'is_super_admin' => 'nullable|boolean',
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'is_admin' => $request->is_admin,
            'is_super_admin' => $request->filled('is_super_admin') ? $request->is_super_admin : $user->is_super_admin,
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        return redirect()->route('admin.settings.index')->with('success', 'Admin user updated successfully.');
    }

    // Method to delete an admin user
    public function destroyUser(User $user)
    {
        if (!Auth::user()->is_super_admin) {
            abort(403, 'Unauthorized action.');
        }

        // Prevent super admin from deleting themselves
        if (Auth::id() === $user->id && $user->is_super_admin) {
            return back()->with('error', 'You cannot delete your own super admin account.');
        }

        $user->delete();
        return back()->with('success', 'Admin user deleted successfully.');
    }
}