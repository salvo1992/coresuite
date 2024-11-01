<?php

namespace App\Http\Funzioni;

use Twilio\Rest\Client;

class Twilio
{
    public static function oneWay($destinatario, $messaggio)
    {
        try {
            // Seleziona l'ambiente: 'sandbox', 'api_key', 'live'
            $environment = env('TWILIO_ENVIRONMENT', 'live');

            // Ottieni le credenziali in base all'ambiente selezionato
            switch ($environment) {
                case 'sandbox':
                    $sid = env('TWILIO_SANDBOX_SID');
                    $token = env('TWILIO_SANDBOX_TOKEN');
                    break;

                case 'api_key':
                    $sid = env('TWILIO_API_KEY_SID');
                    $token = env('TWILIO_API_KEY_TOKEN');
                    break;

                case 'live':
                default:
                    $sid = env('TWILIO_LIVE_SID');
                    $token = env('TWILIO_LIVE_TOKEN');
                    break;
            }

            $from_whatsapp = env('TWILIO_WHATSAPP_FROM');

            $twilio = new Client($sid, $token);

            // Rimuovi o commenta se non necessario
            // $twilio->setLogLevel('debug');

            $message = $twilio->messages
                ->create("whatsapp:$destinatario", // to
                    [
                        "from" => "whatsapp:$from_whatsapp",
                        "body" => $messaggio
                    ]
                );
            return $message->sid . '-' . $message->status;
        } catch (\Exception $e) {
            dd("Error: " . $e->getMessage());
        }
    }

    public static function sms($destinatario, $messaggio)
    {
        try {
            // Seleziona l'ambiente: 'sandbox', 'api_key', 'live'
            $environment = env('TWILIO_ENVIRONMENT', 'live');

            // Ottieni le credenziali in base all'ambiente selezionato
            switch ($environment) {
                case 'sandbox':
                    $sid = env('TWILIO_SANDBOX_SID');
                    $token = env('TWILIO_SANDBOX_TOKEN');
                    break;

                case 'api_key':
                    $sid = env('TWILIO_API_KEY_SID');
                    $token = env('TWILIO_API_KEY_TOKEN');
                    break;

                case 'live':
                default:
                    $sid = env('TWILIO_LIVE_SID');
                    $token = env('TWILIO_LIVE_TOKEN');
                    break;
            }

            // Seleziona il numero del mittente
            $sender_option = env('TWILIO_SENDER_OPTION', 'sender1');
            $from_sms = ($sender_option === 'sender1') ? env('TWILIO_SENDER1') : env('TWILIO_SENDER2');

            $twilio = new Client($sid, $token);

            // Rimuovi o commenta se non necessario
             $twilio->setLogLevel('debug');

            $message = $twilio->messages
                ->create($destinatario, // to
                    [
                        "body" => $messaggio,
                        'from' => $from_sms
                    ]
                );
            return $message->sid . '-' . $message->status;
        } catch (\Exception $e) {
            dd("Error: " . $e->getMessage());
        }
    }
}
