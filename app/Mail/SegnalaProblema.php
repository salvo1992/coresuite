<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use URL;

class SegnalaProblema extends Mailable
{
    use Queueable, SerializesModels;

    protected $dati = [];
    protected $image;

    /**
     * Create a new message instance.
     *
     * @param $request
     * @param $fullpath
     */
    public function __construct($request, $unencodedImmagine)
    {
        $this->dati['dati'] = $request;
        $this->dati['nominativo'] = \Auth::user()->nominativo();
        $this->dati['immagine'] = $unencodedImmagine;
        $this->dati['dati']['sito'] = URL::to('/');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Mail.segnalaProblema')->with($this->dati)
            ->from('error@andrea.spotorno.name', 'Segnalazione da '.\Auth::user()->nominativo().' su '.config('configurazione.tagTitle'))
            ->to('andicot@gmail.com')
            //->attachData($this->dati['immagine'], 'Blah.png') //Allega file
            ->replyTo(\Auth::user()->email)
            ->subject('Segnalazione: ' .( $this->dati['dati']['titolo']??"senza titolo"));

    }
}
