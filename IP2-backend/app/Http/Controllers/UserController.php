<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'phone_number' => 'required|string',
            'address' => 'nullable|string',
            'role' => 'sometimes|in:user,admin'
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = $validated['role'] ?? 'user';

        $user = User::create($validated);
        return response()->json($user, 201);
    }

    public function show(User $user)
{
    return response()->json([
        'id' => $user->id,
        'name' => $user->username, // or real name if exists
        'avatar' => $user->avatar ?? 'https://randomuser.me/api/portraits/women/45.jpg',
        'email' => $user->email
    ]);
}


    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'username' => 'sometimes|string|max:255|unique:users,username,'.$user->user_id.',user_id',
            'email' => 'sometimes|email|unique:users,email,'.$user->user_id.',user_id',
            'password' => 'sometimes|string|min:8',
            'phone_number' => 'sometimes|string',
            'address' => 'nullable|string',
            'role' => 'sometimes|in:user,admin'
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);
        return response()->json($user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }

    public function orders(User $user)
    {
        return response()->json($user->orders()->with(['items.product', 'payment', 'delivery'])->get());
    }

    public function cart(User $user)
    {
        return response()->json($user->cartItems()->with('product')->get());
    }

    public function wishlist(User $user)
    {
        return response()->json($user->wishlistItems()->with('product')->get());
    }
}