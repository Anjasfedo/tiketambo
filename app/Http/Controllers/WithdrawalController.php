<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{
    public function index()
    {
        $withdrawals = Withdrawal::where('user_id', Auth::id())->latest()->paginate(10);
        return view('user.withdrawal.index', compact('withdrawals'));
    }

    public function admin(Request $request)
    {
        $query = $request->input('search');
        $status = $request->input('status');

        $withdrawals = Withdrawal::query()
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->whereHas('user', function ($subQuery) use ($query) {
                    $subQuery->where('name', 'like', '%' . $query . '%');
                })
                    ->orWhere('jumlah', 'like', '%' . $query . '%');
            })
            ->when($status, function ($queryBuilder) use ($status) {
                $queryBuilder->where('status', $status);
            })
            ->latest()
            ->paginate(10);

        return view('admin.withdrawal.index', compact('withdrawals'));
    }


    /**
     * Request a withdrawal.
     */
    public function request(Request $request)
    {
        $user = Auth::user();

        // Validate the withdrawal amount
        $request->validate([
            'amount' => 'required|numeric|min:1|max:' . $user->saldo,
        ], [
            'amount.max' => 'The requested amount exceeds your available balance.',
        ]);

        // Create a new withdrawal request
        Withdrawal::create([
            'user_id' => $user->id,
            'jumlah' => $request->amount,
            'status' => Withdrawal::STATUS_PENDING,
        ]);

        // Decrease the user's available balance temporarily (to prevent duplicate requests)
        $user->decrement('saldo', $request->amount);

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
        $withdrawal->user->increment('saldo', $withdrawal->jumlah);

        // Mark the withdrawal as failed
        $withdrawal->update(['status' => Withdrawal::STATUS_FAILED]);

        return redirect()->back()->with('success', 'Withdrawal has been canceled and funds returned to your balance.');
    }
}
