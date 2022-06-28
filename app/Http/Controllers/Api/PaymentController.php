<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Sponsorship;
use Illuminate\Http\Request;
use Braintree\Gateway;
use Braintree_Transaction;

use App\Http\Requests\PaymentRequest;

class PaymentController extends Controller
{
    public function makePayment(Request $request, Gateway $gateway){

        
        
        $data=$request->all();

        

        if(isset($data['sponsorship'])){
            $sponsorship = Sponsorship::find($data['sponsorship']);
            $price = $sponsorship->price;
        } else {
            $data = [
                "message" => "Transazione fallita"
            ];
            return view('admin.error',compact('data'));
            // # SOLO QUANDO L'USER NON SELEZIONA UNA SPONSORSHIP
            //response()->json($data,401);
        }

        
        $apartment =  Apartment::find($data['apartment']);

        $result = $gateway->transaction()->sale([
            'amount' => $price,
            'paymentMethodNonce' => $data['payment_method_nonce'],
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if($result->success){
            $data = [
                "message" => "Transazione effettuata con successo!"
            ];
            return  redirect()->route('admin.sponsor.store',["apartment" => $apartment, "sponsorship" => $sponsorship]);
            //response()->json($data);
        } 

        return redirect()->route('admin.apartments.index')->with("message","La transazione è fallita!");
    }
}
