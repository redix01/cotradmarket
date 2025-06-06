<?php

namespace App\Http\Controllers;

use App\Models\CopiedTrade;
use App\Models\CopyTrader;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpertTraderController extends Controller
{
    public function index()
    {
        $traders = CopyTrader::all();
        $copiedTrades = CopiedTrade::whereUserId(\auth()->id())->get();
        return view('dashboard.others.expert-trader', compact('traders', 'copiedTrades'));
    }

    public function store(Request $request)
    {
        $trader_id = $request->trader_id;
        $data = CopiedTrade::whereUserId(\auth()->id())->where('copy_trader_id', $trader_id)->first();
        if ($data) {
            return redirect()->back()->with('error', 'You Already Copied This Trader');
        }
        $copied_trade = new CopiedTrade();
        $copied_trade->amount = $request->amount;
        $copied_trade->user_id = Auth::id();
        $copied_trade->copy_trader_id = $trader_id;
        $copied_trade->status = 'successful';
        $copied_trade->save();

        $user = User::findOrFail(\auth()->id());
        $user->balance -= $copied_trade->amount;
        $user->save();
        return redirect()->back()->with('success', 'Copied Trade Added Successfully');
    }


}
