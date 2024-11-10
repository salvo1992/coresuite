<?php

namespace App\Notifications;

use App\Models\ContrattoTelefonia;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotificaSollecitoGestoreTelefonia extends Notification implements ShouldQueue
{
    use Queueable;

    protected $contratto;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($contrattoid)
    {
        $this->contratto = ContrattoTelefonia::withoutGlobalScope('filtroOperatore')->find($contrattoid);
        \Log::debug('que');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $this->contratto->sollecito_gestore = now();
        $this->contratto->save();

        return (new MailMessage)
            ->line('Richiesta informazioni sullo stato di attivazione di:')
            ->line($this->contratto->tipoContratto->nome)
            ->line($this->contratto->nominativo())
            ->subject('Richiesta informazioni sullo stato di attivazione');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
