<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\EventRegistration;

class EventRegistrationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $eventRegistration;
    protected $action; // 'registered' or 'approved'

    /**
     * Create a new notification instance.
     */
    public function __construct(EventRegistration $eventRegistration, string $action = 'registered')
    {
        $this->eventRegistration = $eventRegistration;
        $this->action = $action;
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
        $event = $this->eventRegistration->event;
        $pet = $this->eventRegistration->pet;

        $subject = "Event Registration Update: {$pet->name} for {$event->title}";

        $mail = (new MailMessage)
            ->subject($subject)
            ->greeting("Hello {$notifiable->first_name}!");

        if ($this->action === 'registered') {
            $mail->line("Your pet {$pet->name} has been successfully registered for the event '{$event->title}'.")
                 ->line("Event Details:")
                 ->line("📅 Date: " . $event->event_date->format('F j, Y'))
                 ->line("📍 Location: {$event->location}")
                 ->line("Your registration is pending approval from our administrators.")
                 ->action('View Event Details', url("/events/{$event->id}"));
        } elseif ($this->action === 'approved') {
            $mail->line("Great news! Your pet {$pet->name}'s registration for '{$event->title}' has been approved!")
                 ->line("Event Details:")
                 ->line("📅 Date: " . $event->event_date->format('F j, Y'))
                 ->line("📍 Location: {$event->location}")
                 ->line("We look forward to seeing you and your pet at the event!")
                 ->action('View Event Details', url("/events/{$event->id}"));
        }

        $mail->line('Thank you for being part of the CityVet community!')
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
        return [
            'event_registration_id' => $this->eventRegistration->id,
            'event_id' => $this->eventRegistration->event_id,
            'pet_id' => $this->eventRegistration->pet_id,
            'action' => $this->action,
            'event_title' => $this->eventRegistration->event->title,
            'pet_name' => $this->eventRegistration->pet->name,
        ];
    }
}
