<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Retrieves all transactions.
     * GET: /api/transactions
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::all();

        return response()->json([
            'ok' => true,
            'message' => 'All transactions have been retrieved.',
            'data' => $transactions
        ], 200);
    }

    /**
     * Creates a new transaction.
     * POST: /api/transactions
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'description' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'account_id' => 'required|exists:accounts,id',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'message' => "Request didn't pass the validation.",
                'errors' => $validator->errors()
            ], 400);
        }

        $transaction = Transaction::create($validator->safe()->only(['description', 'amount', 'account_id']));

        return response()->json([
            'ok' => true,
            'message' => 'Transaction has been created!',
            'data' => $transaction
        ], 201);
    }

    /**
     * Retrieves a specific transaction by ID.
     * GET: /api/transactions/{transaction}
     * @param Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return response()->json([
            'ok' => true,
            'message' => 'Transaction has been retrieved.',
            'data' => $transaction
        ], 200);
    }

    /**
     * Updates a specific transaction by ID.
     * PATCH: /api/transactions/{transaction}
     * @param Request $request
     * @param Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validator = validator($request->all(), [
            'description' => 'sometimes|string',
            'amount' => 'sometimes|numeric|min:0',
            'account_id' => 'sometimes|exists:accounts,id',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'message' => "Request didn't pass the validation.",
                'errors' => $validator->errors()
            ], 400);
        }

        $transaction->update($validator->safe()->only(['description', 'amount', 'account_id']));

        return response()->json([
            'ok' => true,
            'message' => 'Transaction has been updated!',
            'data' => $transaction
        ], 200);
    }

    /**
     * Deletes a specific transaction by ID.
     * DELETE: /api/transactions/{transaction}
     * @param Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return response()->json([
            'ok' => true,
            'message' => 'Transaction has been deleted.'
        ], 200);
    }
}
