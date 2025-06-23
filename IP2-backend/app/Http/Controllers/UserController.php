<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;  // <-- Add this import
use Illuminate\Support\Facades\Auth;      // <-- Import Auth facade
use App\Models\User;

class UserController extends Controller
{
    // Register new user
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|confirmed|min:6', // password_confirmation required
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => [
                'user_id' => $user->user_id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ], 201);
    }

    // Login user (no token, just return user info)
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.'
            ], 401);
        }

        return response()->json([
            'message' => 'User logged in successfully',
            'user' => [
                'user_id' => $user->user_id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }

    // Send password reset link
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        if ($status == Password::RESET_LINK_SENT) {
            return response()->json(['message' => __($status)]);
        } else {
            return response()->json(['message' => __($status)], 400);
        }
    }

    // Reset password using the token
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|confirmed|min:6',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                if ($user instanceof \App\Models\User) {
                    $user->password = Hash::make($password);
                    $user->save();
                } else {
                    return response()->json(['message' => 'Authenticated user not found or invalid'], 404);
                }
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return response()->json(['message' => __($status)]);
        } else {
            return response()->json(['message' => __($status)], 400);
        }
    }
    // Add this method inside your UserController class

    public function index()
    {
        // Get all users with selected fields you want to expose
        $users = User::all();

        return response()->json($users);
    }
    // Update user info

public function update(Request $request)
{
    try {
        // Find user by ID from form data (from localStorage in frontend)
        $user = User::findOrFail($request->input('user_id'));

        // Assign raw fields (no validation)
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone');
        $user->address = $request->input('address');
        $user->bio = $request->input('bio');
        $user->birthday = $request->input('birthday');

        // Handle photo upload (optional)
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('avatars', 'public');
            $user->photo_url = Storage::url($photoPath);
        }

        // Update password if requested
        $oldPassword = $request->input('old_password');
        $newPassword = $request->input('new_password');
        $confirmPassword = $request->input('confirm_password');

        if ($oldPassword && $newPassword && $confirmPassword) {
            if (!Hash::check($oldPassword, $user->password)) {
                return response()->json(['message' => 'Old password is incorrect'], 403);
            }

            if ($newPassword !== $confirmPassword) {
                return response()->json(['message' => 'Passwords do not match'], 422);
            }

            $user->password = Hash::make($newPassword);
        }

        $user->save();

        return response()->json([
            'message' => 'User profile updated successfully.',
            'user' => $user,
        ]);
    } catch (\Throwable $e) {
        \Log::error('Update error: ' . $e->getMessage());
        return response()->json([
            'message' => 'Something went wrong.',
            'error' => $e->getMessage()
        ], 500);
    }
}

    public function destroy($user_id)
    {
        $user = User::find($user_id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
    public function profile()
    {
        return response()->json(Auth::user());
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'username' => 'required|string|max:255',
            'birthday' => 'nullable|date',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:1000',
            // Add validation if updating password or photo
        ]);

        $user->name = $data['username'];
        $user->birthday = $data['birthday'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->bio = $data['bio'];
        //$user->save();

        return response()->json(['message' => 'Profile updated successfully']);
    }
    // GET /api/users/{id}
    public function show($user_id)
{
    return User::findOrFail($user_id);
}

}
