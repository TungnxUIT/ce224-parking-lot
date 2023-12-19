<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Card;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    function show($id)
    {
        if (Auth::check() && Auth::user()->id == $id) {
            $user = User::find($id);
            $cards = Card::with('histories')->where('user_id', $id)->get();

            return view('user.userprofile')->with(['user' => $user, 'cards' => $cards]);
        } else {
            return redirect()->route('profile', ['id' => Auth::user()->id]);
        }
    }

    function getRegisterCard($id)
    {
        if (Auth::check() && Auth::user()->id == $id) {
            return view('user.register_card')->with(['user_id' => $id]);
        } return redirect()->route('get.registercard', ['id' => Auth::user()->id]);
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
            History::where('card_id', $cardId)->delete();
            $card->delete($card);
            return redirect()->route('profile', ['id' => $id])->with('success', 'Xóa thẻ thành công.');
        }
        return response()->json(['message' => 'Not found card to delete'], 404);
    }

    function getUpdatePlate(Request $request, $cardId, $id)
    {
        if (Auth::check() && Auth::user()->id == $id) {
            
            return view('user.update_plate')->with(['cardId' => $cardId, 'id' => $id]);
        } else {
            return redirect()->route('get.updatecard', ['id' => Auth::user()->id, 'cardId' => $cardId, '_token' => $request->_token]);
        }
    }
    

    public function updatePlates(Request $request, $cardId, $id)
    {
        $request->validate(['license_plates' => ['required', 'unique:cards,license_plates']]);
        $card = Card::where('id', $cardId)->first();
        if ($card) {
            $card->license_plates = $request->license_plates;
            $card->save();
        }
        return redirect()->route('profile', ['id' => $id])->with('success', 'Cập nhật thành công.');
    }
}
