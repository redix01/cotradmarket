<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   public function users()
   {
       $users = User::latest()->get();
       return view('admin.user.list', compact('users'));
   }

   public function deleteUser($id)
   {
       $user = User::findOrFail($id);
       $user->delete();
       return redirect()->back()->with('success', 'User has been deleted');
   }

   public function fundUser(Request $request, $id)
   {

      $user = User::findOrFail($id);
      if ($request->type == 'add')
      {
          $user->balance += $request->balance ?? null;
          $user->profit += $request->profit ?? null;
          $user->coinbase += $request->coinbase;
          $user->save();
          return redirect()->back()->with('success', 'Fund Added Successfully');
      }
      $user->balance -= $request->balance;
      $user->profit -= $request->profit;
      $user->coinbase -= $request->coinbase;
      $user->save();
      return redirect()->back()->with('success', 'Fund Removed Successfully');
   }



}
