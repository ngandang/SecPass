<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\User;
use App\Group;

class GroupPGP extends Notification implements ShouldQueue
{
    use Queueable;

    public $group;
    public $creator;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Group $group, User $creator)
    {
        $this->group = $group;
        $this->creator = $creator;
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
        $subject = sprintf('%s: Bạn vừa được thêm vào nhóm %s', config('app.name'), $this->group->name);
        $greeting = sprintf('Xin chào %s!', $notifiable->name);
 
        return (new MailMessage)
                    ->subject($subject)
                    ->greeting($greeting)
                    ->line('Bạn vừa được '.$this->creator->name.' thêm vào nhóm bảo mật '.$this->group->name.'.')
                    ->line('Bạn hãy nhấn vào nút bên dưới để nhận khoá PGP và truy cập tài nguyên của nhóm.')
                    ->action('Truy cập vào nhóm', url("/group/".$this->group->id) )
                    ->line('Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi');
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
