<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function show($id)
    {
        $user = User::find($id);

        // Load all cards with their histories for the given user ID
        $cards = $user->cards()->with('histories')->get();

        return view('user.userhistory')->with(['user' => $user, 'cards' => $cards]);
    }
}
