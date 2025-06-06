<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function index()
    {
        $plans = Package::all();
        $user = Auth::user();
        $subscription = Subscription::whereUserId(auth()->id())->latest()->get();
        return view('dashboard.others.subscription', compact('plans', 'user', 'subscription'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $package = Package::findOrFail($request->plan_id);
        if ($request->amount < $package->min_amount || $request->amount > $package->max_amount){
            return redirect()->back()->with('error', 'Enter an amount within Min/Max Plan amount');
        }
        if ($request->amount <= $user->balance)
        {

            $sub = Subscription::whereUserId(auth()->id())->first();
            if ($sub)
            {
                $sub->amount = $request->amount;
                $sub->user_id = Auth::id();
                $sub->package_id = $request->plan_id;
                $sub->status = 'successful';
                $sub->save();
                return redirect()->back()->with('success', 'Subscription Activated Successful');
            }

            $sub = new Subscription();
            $sub->amount = $request->amount;
            $sub->user_id = Auth::id();
            $sub->package_id = $request->plan_id;
            $sub->status = 'successful';
            $sub->save();

            $user->balance -= $request->amount;
            $user->trader = 1;
            $user->save();
            return redirect()->back()->with('success', 'Subscription Activated Successful');
        }
         return redirect()->back()->with('error', 'insufficient balance');

    }

}
