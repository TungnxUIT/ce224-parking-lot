<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\History;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    public function control(Request $request)
    {
        $request->validate([
            'card_uid' => ['required'],
            'license_plates' => ['required']
        ]);

        $card = Card::where('card_uid', $request->card_uid)
            ->where('license_plates', $request->license_plates)
            ->first();

        if ($card) {
            $history = $card->histories->last();
            if ($history == null) {
                $this->createHistory($history, $card, null);
                return response()->json(['message' => 'Allowed']);
            } else if ($history->status == 'Out') {
                $this->createHistory($history, $card, $history->status);
                return response()->json(['message' => 'Allowed']);
            } else if ($history->status == 'In') {
                $message = $this->updateHistory($history, $card, $history->status);
                if ($message == 1)
                    return response()->json(['message' => 'Allowed']);
                else return response()->json(['message' => 'Not Allowed, Please deposit more money into your account']);
            }
        } else return response()->json(['message' => 'Not Allowed, Card uid and license plate are not match']);
    }

    protected function createHistory($history, $card, $status)
    {
        if ($status == null || $status == 'Out') {
            $history = new History();
            $history->card_id = $card->id;
            $history->status = "In";
            $history->save();
        }
    }
    protected function updateHistory($history, $card)
    {
        if ($history->status == "In") {
            $user = $card->user;

            if ($user->balance - 5000 < 0) {
                return 0; // Not Allowed
            }

            $history->status = "Out";
            $user->balance -= 5000;
            $user->save();
            $history->save();
        } else {
            $history->status = "In";
            $history->save();
        }

        return 1; // Allowed
    }
}
