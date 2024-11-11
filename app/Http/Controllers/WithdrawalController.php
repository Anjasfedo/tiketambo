<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{
    public function index()
    {
        $withdrawals = Withdrawal::where('user_id', Auth::id())->latest()->get();
        return view('user.withdrawal', compact('withdrawals'));
    }

    /**
     * Request a withdrawal.
     */
    public function request(Request $request)
    {
        $user = Auth::user();

        // Validate the withdrawal amount
        $request->validate([
            'amount' => 'required|numeric|min:1|max:' . $user->money,
        ], [
            'amount.max' => 'The requested amount exceeds your available balance.',
        ]);

        // Create a new withdrawal request
        Withdrawal::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'status' => Withdrawal::STATUS_PENDING,
        ]);

        // Decrease the user's available balance temporarily (to prevent duplicate requests)
        $user->decrement('money', $request->amount);

        return redirect()->back()->with('success', 'Withdrawal request submitted successfully.');
    }

    /**
     * Process the withdrawal and mark it as completed.
     * Typically, this would be an admin function to approve withdrawals.
     */
    public function process(Request $request, $withdrawalId)
    {
        $withdrawal = Withdrawal::findOrFail($withdrawalId);

        // Check if the withdrawal is already completed or failed
        if ($withdrawal->status !== Withdrawal::STATUS_PENDING) {
            return redirect()->back()->withErrors('This withdrawal has already been processed.');
        }

        // Mark the withdrawal as completed
        $withdrawal->update(['status' => Withdrawal::STATUS_COMPLETED]);

        return redirect()->back()->with('success', 'Withdrawal has been processed successfully.');
    }

    /**
     * Cancel a pending withdrawal and return funds to the user's balance.
     */
    public function cancel(Request $request, $withdrawalId)
    {
        $withdrawal = Withdrawal::where('id', $withdrawalId)
            ->where('user_id', Auth::id())
            ->where('status', Withdrawal::STATUS_PENDING)
            ->firstOrFail();

        // Return the amount to the user's balance
        $withdrawal->user->increment('money', $withdrawal->amount);

        // Mark the withdrawal as failed
        $withdrawal->update(['status' => Withdrawal::STATUS_FAILED]);

        return redirect()->back()->with('success', 'Withdrawal has been canceled and funds returned to your balance.');
    }

    public function history()
    {
        $withdrawals = Withdrawal::where('user_id', Auth::id())->latest()->get();
        return view('user.withdrawals.history', compact('withdrawals'));
    }

}