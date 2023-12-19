<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function show($id)
    {
        if (Auth::check() && Auth::user()->id == $id) {
            $user = User::find($id);

            // Load all cards with their histories for the given user ID
            $cards = $user->cards()->with('histories')->get();

            return view('user.userhistory')->with(['user' => $user, 'cards' => $cards]);
        }
        return redirect()->route('get.histories', ['id' => Auth::user()->id]);
    }
}
