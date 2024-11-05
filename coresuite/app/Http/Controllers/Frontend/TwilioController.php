<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TwilioController extends Controller
{
    public function statusCallback(Request $request)
    {
        \Log::notice(__FUNCTION__, $request->all());

        return __FUNCTION__;
    }

    public function messageCallback(Request $request)
    {
        \Log::notice(__FUNCTION__, $request->all());

        return __FUNCTION__;
    }

    /*
     * Esempi di payload ricevuti da Twilio:

    {
        "SmsSid": "SMxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
        "SmsStatus": "sent",
        "MessageStatus": "sent",
        "ChannelToAddress": "+39XXXXXXXXXXX",
        "To": "whatsapp:+39XXXXXXXXXXX",
        "ChannelPrefix": "whatsapp",
        "MessageSid": "SMxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
        "AccountSid": "ACxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
        "StructuredMessage": "true",
        "From": "whatsapp:+14155238886",
        "ApiVersion": "2010-04-01",
        "ChannelInstallSid": "XExxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
    }
    {
        "SmsSid": "SMxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
        "SmsStatus": "delivered",
        "MessageStatus": "delivered",
        "ChannelToAddress": "+39XXXXXXXXXXX",
        "To": "whatsapp:+39XXXXXXXXXXX",
        "ChannelPrefix": "whatsapp",
        "MessageSid": "SMxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
        "AccountSid": "ACxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
        "From": "whatsapp:+14155238886",
        "ApiVersion": "2010-04-01",
        "ChannelInstallSid": "XExxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
    }
    {
        "SmsSid": "SMxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
        "SmsStatus": "read",
        "MessageStatus": "read",
        "ChannelToAddress": "+39XXXXXXXXXXX",
        "To": "whatsapp:+39XXXXXXXXXXX",
        "ChannelPrefix": "whatsapp",
        "MessageSid": "SMxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
        "AccountSid": "ACxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
        "From": "whatsapp:+14155238886",
        "ApiVersion": "2010-04-01",
        "ChannelInstallSid": "XExxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
    }

    {
        "SmsMessageSid": "SMxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
        "NumMedia": "0",
        "ProfileName": "Nome Profilo",
        "SmsSid": "SMxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
        "WaId": "39XXXXXXXXXXX",
        "SmsStatus": "received",
        "Body": "Messaggio ricevuto",
        "To": "whatsapp:+14155238886",
        "NumSegments": "1",
        "ReferralNumMedia": "0",
        "MessageSid": "SMxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
        "AccountSid": "ACxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
        "From": "whatsapp:+39XXXXXXXXXXX",
        "ApiVersion": "2010-04-01"
    }

     */
}
