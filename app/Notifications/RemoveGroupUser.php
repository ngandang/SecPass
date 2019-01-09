<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\User;
use App\Group;

class RemoveGroupUser extends Notification
{
    use Queueable;

    public $group;
    public $admin_user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Group $group, User $admin_user)
    {
        $this->group = $group;
        $this->admin_user = $admin_user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $subject = sprintf('%s: Bạn vừa rời nhóm %s', config('app.name'), $this->group->name);
        $greeting = sprintf('Xin chào %s!', $notifiable->name); 
        return (new MailMessage)
                    ->subject($subject)
                    ->greeting($greeting)
                    ->line('Quản trị viên '.$this->admin_user->name.' của nhóm '.$this->group->name.' vừa mời bạn rời nhóm bảo mật này.')
                    ->line('Từ lúc này, bạn sẽ không thể truy cập đến tài nguyên của nhóm nữa.')
                    ->line('Nếu bạn cho đây là sự nhầm lẫn, vui lòng liên hệ quản trị viên của nhóm để giải quyết sự nhầm lẫn này.');
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
            'data' => 'Bạn vừa được mời khỏi nhóm '.$this->group->name.'.',
            'url' => '#',
        ];
    }
}
