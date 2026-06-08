<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\PetRequest;

class RequestStatusNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $petRequest;
    protected $status;

    /**
     * Create a new notification instance.
     */
    public function __construct(PetRequest $petRequest, string $status)
    {
        $this->petRequest = $petRequest;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $requestType = ucfirst($this->petRequest->type);
        $petName = $this->petRequest->requestable->name ?? 'Unknown Pet';

        $subject = "Your {$requestType} Request for {$petName} has been " . ucfirst($this->status);

        $mail = (new MailMessage)
            ->subject($subject)
            ->greeting("Hello {$notifiable->first_name}!");

        if ($this->status === 'approved') {
            $mail->line("Great news! Your {$requestType} request for {$petName} has been approved.")
                 ->line("You can now proceed with the next steps. Please check your dashboard for more details.")
                 ->action('View My Requests', url('/user/requests'));
        } elseif ($this->status === 'completed') {
            $mail->line("Congratulations! Your {$requestType} request for {$petName} has been completed successfully!")
                 ->line("The pet is now registered in your account. You can view all your adopted or claimed pets in your dashboard.")
                 ->action('View My Adopted/Claimed Pets', url('/user/adopted-claimed-pets'));
        } else {
            $mail->line("We regret to inform you that your {$requestType} request for {$petName} has been denied.")
                 ->line("Reason: " . ($this->petRequest->denial_reason ?? $this->petRequest->admin_notes ?? 'No specific reason provided.'))
                 ->line("You can submit a new request or contact us for more information.")
                 ->action('View My Requests', url('/user/requests'));
        }

        $mail->line('Thank you for using CityVet!')
             ->salutation('Best regards, CityVet Team');

        return $mail;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $statusLabel = match($this->status) {
            'completed' => 'Successfully ' . ($this->petRequest->type === 'claim' ? 'Claimed' : 'Adopted'),
            'approved' => 'Approved',
            'denied' => 'Denied',
            default => ucfirst($this->status)
        };

        return [
            'pet_request_id' => $this->petRequest->id,
            'status' => $this->status,
            'status_label' => $statusLabel,
            'type' => $this->petRequest->type,
            'pet_name' => $this->petRequest->requestable->name ?? 'Unknown Pet',
        ];
    }
}
