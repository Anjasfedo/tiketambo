<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{
    public function request(Request $request)
    {
        $request->validate(['amount' => 'required|numeric|min:1']);

        Withdrawal::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Withdrawal request submitted successfully.');
    }
}