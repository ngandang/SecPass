<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;



class VerifyUser extends Notification
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
        $subject = sprintf('%s: Chứng thực tài khoản', config('app.name'));
        $greeting = sprintf('Xin chào %s!', $notifiable->name);
        // $a = sprintf('Bạn vừa được %s thêm vào nhóm bảo mật %s.', $this->creator->name, $this->group->name);
 
        return (new MailMessage)
                    ->subject($subject)
                    ->greeting($greeting)
                    ->line('Cảm ơn bạn đã đăng ký sử dụng hệ thống quản lý thông tin cá nhân SecPASS. Vui lòng nhấn vào link bên dưới để xác thực tài khoản của bạn:')
                    ->action('Xác thực', url("/register/verify/".$notifiable->verification_code) )
                    ->line('Lưu ý: Chúng tôi chỉ lưu trữ khoá công khai của bạn tại máy chủ. Khoá riêng tư được lưu trong Tiện ích SecPASS trên thiết bị của bạn. Bạn cần sao lưu và bảo đảm an toàn thông tin cho cặp khoá này.')
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
