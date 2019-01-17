<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;



class PGPRecovery extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        $subject = sprintf('%s: Xác thực tài khoản', config('app.name'));
        $greeting = sprintf('Xin chào %s!', $notifiable->name);
        // $a = sprintf('Bạn vừa được %s thêm vào nhóm bảo mật %s.', $this->creator->name, $this->group->name);
 
        return (new MailMessage)
                    ->subject($subject)
                    ->greeting($greeting)
                    ->line('Hệ thống nhận được yêu cầu phục hồi tài khoản. Vui lòng nhấn vào link bên dưới để xác thực:')
                    ->action('Xác thực tài khoản', url("/pgp/verify/".$notifiable->verification_code) )
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
