<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CardController extends Controller
{

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'card_uid' => ['required', 'unique:cards,card_uid']
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Card uid exists'], 422); // 422 Unprocessable Entity
        }
        $card = new Card;
        $card->card_uid = $request->card_uid;
        if ($request->user_id) $card->user_id = $request->user_id;
        if ($request->license_plates) $card->license_plates = $request->license_plates;
        $card->save();
        return response()->json($card);
    }

    public function destroy($id)
    {
        $card = Card::where('id', $id)->first();
        if ($card) {
            $card->destroy($card);
        }
        return response()->json(["message" => "Success"]);
        // return view('admin.manage');
    }

}
