<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Card;
use App\Models\History;
use Illuminate\Http\Request;

class UserController extends Controller
{

    function show($id)
    {
        $user = User::find($id);
        $cards = Card::with('histories')->where('user_id', $id)->get();

        return view('user.userprofile')->with(['user' => $user, 'cards' => $cards]);
    }

    function getRegisterCard($id)
    {
        return view('user.register_card')->with(['user_id' => $id]);
    }

    function postRegisterCard(Request $request, $id)
    {
        $request->validate([
            'license_plates' => ['required', 'unique:cards,license_plates'],
        ]);
        $user = User::find($id);
        $card = Card::where('user_id', null)->first();
        if ($card) {
            $card->user_id = $user->id;
            $card->license_plates = $request->license_plates;
            $card->save();
            return redirect()->route('profile', ['id' => $id])->with('success', 'Card registered successfully.');
        }
        return redirect()->route('profile', ['id' => $id])->with('error', 'Parking space not available.');
    }

    function deleteRegistedCard($cardId, $id)
    {
        $card = Card::where('id', $cardId)->first();
        if ($card) {
            $card->user_id = null;
            $card->license_plates = null;
            $card->save();
            History::where('card_id', $cardId)->delete();
            return redirect()->route('profile', ['id' => $id]);
        }
        return response()->json(['message' => 'Not found card to delete'], 404);
    }
}
