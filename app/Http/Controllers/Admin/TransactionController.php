<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ApproveDepositMail;
use App\Mail\ApproveWithdrawalMail;
use App\Models\Deposit;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TransactionController extends Controller
{
    public function deposits()
    {
        $deposits = Deposit::latest()->get();
        return view('admin.transactions.deposits', compact('deposits'));
    }

    public function approveDeposit($id)
    {
        $deposit = Deposit::findOrFail($id);
        $deposit->status = 1;
        $deposit->save();
        Mail::to($deposit->user->email)->send(new ApproveDepositMail($deposit));
        return redirect()->back()->with('success', 'Deposit Approved');
    }
    public function withdrawal()
    {
        $withdrawal = Withdrawal::latest()->get();
        return view('admin.transactions.withdrawal', compact('withdrawal'));
    }

    public function approveWithdrawal($id)
    {
        $withdraw = Withdrawal::findOrFail($id);
        $withdraw->status = 1;
        $withdraw->save();
        Mail::to($withdraw->user->email)->send(new ApproveWithdrawalMail($withdraw));
        return redirect()->back()->with('success', 'Withdrawal Approved');
    }


}
