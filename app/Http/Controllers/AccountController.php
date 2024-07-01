<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class AccountController extends Controller
{
    /**
     * Retrieves all accounts.
     * GET: /api/accounts
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Account::all();

        return response()->json([
            'ok' => true,
            'message' => 'All accounts have been retrieved.',
            'data' => $accounts
        ], 200);
    }

    /**
     * Creates a new account.
     * POST: /api/accounts
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'account_number' => 'required|string|unique:accounts',
            'nickname' => 'required|string',
            'balance' => 'required|numeric|min:0',
            'user_id' => 'required|exists:users,id',
            'account_type' => 'required|exists:account_types,id',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'message' => "Request didn't pass the validation.",
                'errors' => $validator->errors()
            ], 400);
        }

        $account = Account::create($validator->safe()->only([
            'account_number', 'nickname', 'balance', 'user_id', 'account_type'
        ]));

        return response()->json([
            'ok' => true,
            'message' => 'Account has been created!',
            'data' => $account
        ], 201);
    }

    /**
     * Retrieves a specific account by ID.
     * GET: /api/accounts/{account}
     * @param Account $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        return response()->json([
            'ok' => true,
            'message' => 'Account has been retrieved.',
            'data' => $account
        ], 200);
    }

    /**
     * Updates a specific account by ID.
     * PATCH: /api/accounts/{account}
     * @param Request $request
     * @param Account $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        $validator = validator($request->all(), [
            'account_number' => 'sometimes|string|unique:accounts,account_number',
            'nickname' => 'sometimes|string',
            'balance' => 'sometimes|numeric|min:0',
            'user_id' => 'sometimes|exists:users,id',
            'account_type' => 'sometimes|exists:account_types,id',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'message' => "Request didn't pass the validation.",
                'errors' => $validator->errors()
            ], 400);
        }

        $account->update($validator->safe()->only([
            'account_number', 'nickname', 'balance', 'user_id', 'account_type'
        ]));

        return response()->json([
            'ok' => true,
            'message' => 'Account has been updated!',
            'data' => $account
        ], 200);
    }

    /**
     * Deletes a specific account by ID.
     * DELETE: /api/accounts/{account}
     * @param Account $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        $account->delete();

        return response()->json([
            'ok' => true,
            'message' => 'Account has been deleted.'
        ], 200);
    }
}
