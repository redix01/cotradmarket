<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CopiedTrade;
use App\Models\CopyTrader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CopyTraderController extends Controller
{
    public function index()
    {
        $traders = CopyTrader::latest()->get();
        return view('admin.copy-trade.traders', compact('traders'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'amount' => 'required|numeric|min:0',
            'win_rate' => 'nullable|string',
            'profit_share' => 'nullable|string',
            'win' => 'nullable|string',
            'loss' => 'nullable|string',
        ]);

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('files', 'public');
            $validatedData['avatar'] = $avatarPath;
        }

        $trader = new CopyTrader();
        $trader->name = $validatedData['name'];
        $trader->avatar = $validatedData['avatar'] ?? null;
        $trader->amount = $validatedData['amount'];
        $trader->win_rate = $validatedData['win_rate'];
        $trader->profit_share = $validatedData['profit_share'];
        $trader->win = $validatedData['win'];
        $trader->loss = $validatedData['loss'];
        $trader->save();

        return redirect()->back()->with('success', "Trader Created Successfully");
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'amount' => 'required|numeric|min:0',
            'win_rate' => 'nullable|string',
            'profit_share' => 'nullable|string',
            'win' => 'nullable|string',
            'loss' => 'nullable|string',
        ]);

        $trader = CopyTrader::findOrFail($id);
        if ($request->hasFile('avatar')) {
            if ($trader->avatar) {
                Storage::delete('public/' . $trader->avatar);
            }

            $avatarPath = $request->file('avatar')->store('files', 'public');
            $validatedData['avatar'] = $avatarPath;
        }

        $trader->name = $validatedData['name'];
        $trader->avatar = $validatedData['avatar'] ?? $trader->avatar;
        $trader->amount = $validatedData['amount'];
        $trader->win_rate = $validatedData['win_rate'];
        $trader->profit_share = $validatedData['profit_share'];
        $trader->win = $validatedData['win'];
        $trader->loss = $validatedData['loss'];
        $trader->save();

        return redirect()->back()->with('success', "Trader Updated Successfully");
    }

    public function destroy($id)
    {
        $trader = CopyTrader::findOrFail($id);
        if ($trader->avatar) {
                Storage::delete('public/' . $trader->avatar);
            }
        $trader->delete();
        return redirect()->back()->with('success', "Trader Deleted Successfully");
    }

    public function copiedTrades()
    {
        $copiedTrades = CopiedTrade::latest()->get();
        return view('admin.copy-trade.copied-trades', compact('copiedTrades'));
    }

    public function fundCopiedTrade(Request $request, $id)
    {
        $copiedTrade = CopiedTrade::findOrFail($id);
        $copiedTrade->profit_loss += $request->input('amount');
        $copiedTrade->status = 'ended';
        $copiedTrade->save();
        return redirect()->back()->with('success', "Copied Trade Updated Successfully");
    }

    public function deleteCopiedTrade($id)
    {
        $copiedTrade = CopiedTrade::findOrFail($id);
        $copiedTrade->delete();
        return redirect()->back()->with('success', "Deleted Successfully");
    }


}
