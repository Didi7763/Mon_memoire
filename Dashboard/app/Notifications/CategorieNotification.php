<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CategorieNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    /*
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Alerte Matériel')
                    ->line("La quantité du matériel  {$this->categorie_materiels->NomCatMat} est en dessous du seuil.")
                    ->line('Veuillez vous réapprovisionner svp.')
                    ->action('Voir le matériel', url(route('categorie.index', $this->categorie_materiels->RefCatMAt)))
                    ->line('Merci d\'utiliser notre application!');
    }
    */
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'data' => $this->message,
        ];
    }
}
