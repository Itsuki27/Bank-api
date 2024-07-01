<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountType;

class AccountTypeController extends Controller
{
    /**
     * Retrieves all account types.
     * GET: /api/account-types
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accountTypes = AccountType::all();

        return response()->json([
            'ok' => true,
            'message' => 'All account types have been retrieved.',
            'data' => $accountTypes
        ], 200);
    }

    /**
     * Creates a new account type.
     * POST: /api/account-types
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'name' => 'required|string|unique:account_types',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'message' => "Request didn't pass the validation.",
                'errors' => $validator->errors()
            ], 400);
        }

        $accountType = AccountType::create($validator->safe()->only('name'));

        return response()->json([
            'ok' => true,
            'message' => 'Account type has been created!',
            'data' => $accountType
        ], 201);
    }

    /**
     * Retrieves a specific account type by ID.
     * GET: /api/account-types/{accountType}
     * @param AccountType $accountType
     * @return \Illuminate\Http\Response
     */
    public function show(AccountType $accountType)
    {
        return response()->json([
            'ok' => true,
            'message' => 'Account type has been retrieved.',
            'data' => $accountType
        ], 200);
    }

    /**
     * Updates a specific account type by ID.
     * PATCH: /api/account-types/{accountType}
     * @param Request $request
     * @param AccountType $accountType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccountType $accountType)
    {
        $validator = validator($request->all(), [
            'name' => 'sometimes|string|unique:account_types,name,'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'message' => "Request didn't pass the validation.",
                'errors' => $validator->errors()
            ], 400);
        }

        $accountType->update($validator->safe()->only('name'));

        return response()->json([
            'ok' => true,
            'message' => 'Account type has been updated!',
            'data' => $accountType
        ], 200);
    }

    /**
     * Deletes a specific account type by ID.
     * DELETE: /api/account-types/{accountType}
     * @param AccountType $accountType
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountType $accountType)
    {
        $accountType->delete();

        return response()->json([
            'ok' => true,
            'message' => 'Account type has been deleted.'
        ], 200);
    }
}
