<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class PaymentController extends Controller
{
    public function getPayment($id)
    {
        return view('user.payment')->with(['id' => $id]);
    }
    public function payment_momo(Request $request, $id)
    {
        $request->validate([
            'amount' => ['required']
        ]);

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

        $orderInfo = "Thanh toán qua MoMo";
        $amount = $request->amount;
        $orderId = time() . "";
        $redirectUrl = route('payment.complete', ['id' => $id, 'amount' => $amount]);
        $ipnUrl = route('payment.complete', ['id' => $id, 'amount' => $amount]);
        $extraData = "";

        if ($request->isMethod('post')) {
            $partnerCode =  $partnerCode;
            $accessKey = $accessKey;
            $secretKey = $secretKey;
            $orderId = $orderId;
            $orderInfo = $orderInfo;
            $amount = $amount;
            $ipnUrl = $ipnUrl;
            $redirectUrl = $redirectUrl;
            $extraData = $extraData;

            $requestId = time() . "";
            $requestType = "payWithATM";
            $extraData = $request->extraData ?? "";

            // before sign HMAC SHA256 signature
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);

            $data = [
                'id' => $id,
                'partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature,
            ];

            $result = Http::withoutVerifying()->post($endpoint, $data);
            $jsonResult = $result->json();

            // Just an example, please check more in there
            //return response()->json($jsonResult);
            return redirect($jsonResult['payUrl']);
        }

        // Handle the case where it's not a POST request
        return view('your_view_name');
    }
    public function complete_momo(Request $request, $id, $amount)
    {
        if ($request->message == "Successful.") {
            $user = User::find($id);
            if ($user) {
                $user->balance += $amount;
                $user->save();
                return redirect()->route('profile', ['id' => $id]);
            } else return response()->json(['message' => 'Not found'], 404);
        }
        return redirect()->route('profile', ['id' => $id]);
    }
}
