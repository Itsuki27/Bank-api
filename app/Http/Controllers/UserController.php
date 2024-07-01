<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{


    /**
     * Retrieves all users.
     * GET: /api/users
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return response()->json([
            'ok' => true,
            'message' => 'All users have been retrieved.',
            'data' => $users
        ], 200);
    }


    /**
     * Creates a new user.
     * POST: /api/users
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'username' => 'required|min:4|max:16|unique:users',
            'email' => 'required|email|max:64|unique:users',
            'password' => 'required|string|min:8|max:32|confirmed',
            'contact_number' => 'required|digits:11',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'message' => "Request didn't pass the validation.",
                'errors' => $validator->errors()
            ], 400);
        }

        $user_input = $validator->safe()->only(['username', 'email', 'password', 'contact_number']);

        $user = User::create($user_input);

        return response()->json([
            'ok' => true,
            'message' => 'Account has been created!',
            'data' => $user
        ], 201);
    }


    /**
     * Retrieves a specific user by ID.
     * GET: /api/users/{user}
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json([
            'ok' => true,
            'message' => 'User has been retrieved.',
            'data' => $user
        ], 200);
    }

    /**
     * Updates a specific user by ID.
     * PATCH: /api/users/{user}
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = validator($request->all(), [
            'username' => 'sometimes|min:4|max:16|alpha_dash|unique:users,username',
            'email' => 'sometimes|email|max:64|unique:users,email',
            'password' => 'sometimes|string|min:8|max:32|confirmed',
            'contact_number' => 'sometimes|digits:11',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'message' => "Request didn't pass the validation.",
                'errors' => $validator->errors()
            ], 400);
        }

        $user_input = $validator->safe()->only(['username', 'email', 'password', 'contact_number']);

        $user->update($user_input);

        return response()->json([
            'ok' => true,
            'message' => 'User has been updated!',
            'data' => $user
        ], 200);
    }

    /**
     * Deletes a specific user by ID.
     * DELETE: /api/users/{user}
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'ok' => true,
            'message' => 'User has been deleted.'
        ], 200);
    }
}
