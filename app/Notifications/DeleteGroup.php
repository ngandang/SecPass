<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\User;
use App\Group;

class DeleteGroup extends Notification
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
        $subject = sprintf('%s: Nhóm %s đã bị xoá', config('app.name'), $this->group->name);
        $greeting = sprintf('Xin chào %s!', $notifiable->name);
 
        return (new MailMessage)
                    ->subject($subject)
                    ->greeting($greeting)
                    ->line('Quản trị viên '.$this->admin_user->name.' của nhóm '.$this->group->name.' đã xoá nhóm bảo mật này.')
                    ->line('Từ lúc này, bạn sẽ không thể truy cập đến tài nguyên của nhóm nữa.')
                    ->line('Vui lòng liên hệ quản trị viên của nhóm để biết thêm thông tin chi tiết.');
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
