<?php

namespace App\Notifications;

use App\Models\Comparasemplice;
use App\Models\ContrattoTelefonia;
use App\Models\ServizioFinanziario;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class NotificaAgenteCambioEsitoComparasemplice extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @param Comparasemplice $servizioFinanziario
     */
    public function __construct(protected $servizioFinanziario)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Segnalazione ComparaSemplice aggiornata')
                    ->line('La segnalazione di '.$this->servizioFinanziario->nominativo())
                    ->line('è stata aggiornata a: ')
                    ->line(new HtmlString('<strong>'.$this->servizioFinanziario->esito->nome.'</strong>'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
