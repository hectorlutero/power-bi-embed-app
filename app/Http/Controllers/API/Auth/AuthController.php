<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\{AuthRequest, RegisterRequest, UpdateProfileRequest};
use App\Mail\UserRegistered;
use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function __construct(
        protected User $user,
        protected UserPolicy $userPolicy
    ) {
    }
    public function index(Request $request)
    {
        Log::debug(auth()->user());
        if (!Gate::check('view-any-user', auth()->user()))
            return response()->json(['message' => "You are not authorized to see this data"], 403);


        $users = User::all()->toArray();
        return response()->json([
            'message' => 'All users',
            'users' => $users
        ]);
    }

    public function login(AuthRequest $request)
    {

        $user = User::where('email', $request->email)->first();

        if (!$user) return response()->json(['error' => 'User not found.'], 404);

        $hash = Hash::check($request->password, $user->password);

        if (!$hash) return response()->json(['error' => 'Invalid Credentials'], 401);


        $user->tokens()->delete();

        return response()->json([
            'token' => $user->createToken('authToken')->plainTextToken,
            'user' => $user
        ]);
    }

    public function logout(Request $request)
    {

        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }

    public function profile(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ]);
    }


    public function register(RegisterRequest $request)
    {
        $user = User::create($request->all());

        Mail::to($user->email)->send(new UserRegistered($user));

        return response()->json([
            'message' => 'User registered successfully',
            'token' => $user->createToken('authToken')->plainTextToken,
            'user' => $user,
        ], 201);
    }
    public function insertUser(RegisterRequest $request)
    {
        if (!Gate::check('create-user', auth()->user()))
            return response()->json(['message' => "You are not authorized to register this user, only admins"], 403);

        $user = User::create($request->all());

        Mail::to($user->email)->send(new UserRegistered($user));

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
        ], 201);
    }

    public function updateProfile(UpdateProfileRequest $request, int $id)
    {

        $user = User::find($id);

        if (!$user)
            return response()->json([
                'message' => "User not found."
            ], 404);

        if (!Gate::check('update-user', $user))
            return response()->json(['message' => "You are not authorized to change this user, only admins"], 403);

        if (isset($request->is_admin)) {
            if (!Gate::check('update-user-role', $user))
                return response()->json(['message' => "You are not authorized to change the user role, only admins"], 403);
        }



        $user->update($request->all());

        return response()->json([
            'message' => "User updated successfully.",
            "user" => $user,
        ]);
    }

    public function deleteUser(string $id)
    {
        $user = User::find($id);

        if (!Gate::check('delete-user', $user))
            return response()->json(['message' => "You are not authorized to change this user, only admins"], 403);

        $user->delete();

        return response()->json([
            'message' => "User with ID of $id deleted successfully.",
        ]);
    }
}
