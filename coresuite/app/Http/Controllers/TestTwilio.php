<?php

namespace App\Http\Controllers;

use App\Http\Funzioni\Twilio;
use App\Models\Cliente;
use Illuminate\Http\Request;
use function App\getInputAggiungi39;

class TestTwilio extends Controller
{
    public function show()
    {

        return view('TestTwilio.test', [
            'record' => new Cliente(),
            'controller' => get_class($this)
        ]);
    }

    public function post(Request $request)
    {

        $messageId=Twilio::sms(getInputAggiungi39($request->input('numero')), $request->input('messaggio'));
        session()->flash('twilio',$messageId);




        return redirect()->action([TestTwilio::class,'show']);
    }
}
