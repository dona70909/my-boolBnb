<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [

            'apartment_id' => 'required',
            'email' => 'required|email',
            'message_content' => 'required'
        ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $message = new Message();
        $message->fill($data);
        $message->save();

        return response()->json([
            'success' => true,
            'alert_sent' => 'Messaggio  inviato correttamente.'
        ]);

        //return redirect('apartment-details')->with('alert_sent', 'Selected query is deleted successfully.');
    }

}
