<?php

namespace App\Http\Controllers;

use App\Mail\AdminDepositMail;
use App\Mail\DepositMail;
use App\Models\Deposit;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DepositController extends Controller
{
     public function deposit()
    {
        $user = Auth::user();
        $wallets = PaymentMethod::all();
        $deposits = Deposit::whereUserId(auth()->id())->latest()->get();
        return view('dashboard.transactions.deposit', compact('user', 'wallets', 'deposits'));
    }

    public function payment(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required',
            'payment_method_id' => 'required',
            'proof' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('proof')) {
            $avatarPath = $request->file('proof')->store('files', 'public');
        }

        $deposit = new Deposit();
        $deposit->user_id = Auth::id();
        $deposit->amount = $validated['amount'];
        $deposit->payment_method_id = $validated['payment_method_id'];
        $deposit->proof = $avatarPath ?? null;
        $deposit->save();

        $admin = User::where('role', 'admin')->first();
        Mail::to(auth()->user()->email)->send(new DepositMail($deposit));
        Mail::to($admin->email)->send(new AdminDepositMail($deposit));
        return redirect()->back()->with('success', 'Deposit Sent, awaiting for approval');

    }




}
