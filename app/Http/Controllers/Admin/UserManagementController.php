<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserManagementController extends Controller
{
    /**
     * Display a listing of all users.
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Approve a user and assign a role.
     */
    public function approve(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:doctor,nurse,midwife,encoder',
        ]);

        $user->update([
            'status' => 'approved',
            'role' => $request->role,
        ]);

        // Log the activity
        ActivityLog::log(
            Auth::user(),
            'Approved User',
            "Approved user: {$user->name} ({$user->email}) and assigned role: {$request->role}"
        );

        return redirect()->route('admin.users.index')
            ->with('success', "User {$user->name} has been approved as {$request->role}.");
    }

    /**
     * Deny a user.
     */
    public function deny(User $user)
    {
        $user->update(['status' => 'denied']);

        // Log the activity
        ActivityLog::log(
            Auth::user(),
            'Denied User',
            "Denied user: {$user->name} ({$user->email})"
        );

        return redirect()->route('admin.users.index')
            ->with('success', "User {$user->name} has been denied.");
    }

    /**
     * Update a user's role.
     */
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,doctor,nurse,midwife,encoder,user',
        ]);

        $oldRole = $user->role;
        $user->update(['role' => $request->role]);

        // Log the activity
        ActivityLog::log(
            Auth::user(),
            'Updated Role',
            "Changed role for user {$user->name} ({$user->email}) from {$oldRole} to {$request->role}"
        );

        return redirect()->route('admin.users.index')
            ->with('success', "User {$user->name}'s role has been updated to {$request->role}.");
    }

    /**
     * Show the form for editing a user's role.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update a user's role from the edit form.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,doctor,nurse,midwife,encoder,user',
        ]);

        $oldRole = $user->role;
        $user->update(['role' => $request->role]);

        // Log the activity
        ActivityLog::log(
            Auth::user(),
            'Updated Role',
            "Changed role for user {$user->name} ({$user->email}) from {$oldRole} to {$request->role}"
        );

        return redirect()->route('admin.users.index')
            ->with('success', "User {$user->name}'s role has been updated to {$request->role}.");
    }

    /**
     * Delete a user.
     */
    public function destroy(User $user)
    {
        // Prevent admin from deleting themselves
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $userName = $user->name;
        $userEmail = $user->email;

        // Log the activity before deletion
        ActivityLog::log(
            Auth::user(),
            'Deleted User',
            "Deleted user: {$userName} ({$userEmail})"
        );

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', "User {$userName} has been deleted.");
    }
}
