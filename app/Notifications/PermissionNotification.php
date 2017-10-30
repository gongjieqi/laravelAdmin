<?php

namespace App\Notifications;

use App\AdminRoles;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PermissionNotification extends Notification
{
    use Queueable;

    public $roles;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($roles)
    {
        //
        $this->roles = $roles;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $nofity['title'] = '系统通知';

        $nofity['modify'] = $notifiable->name;

        foreach($this->roles as $role){

            $nofity['role'][] = $role->display_name;
        }
        return $nofity;
    }
}
