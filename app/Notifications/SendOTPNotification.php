<?php

namespace App\Notifications;

use App\Models\User;
use App\Services\OTPServices;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Mail\SendRegisterOTPMail;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\VonageMessage;

class SendOTPNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
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
    public function toMail(object $notifiable): Mailable
    {
        $user = User::where('id', $notifiable->id)->firstOrFail();

        $optService = new OTPServices();
        $otpData = $optService->generate();

        $user->otp = $otpData['code'];
        $user->otp_expiration = $otpData['expiration'];
        $user->save();

        return (new SendRegisterOTPMail($user))->to($notifiable->email);


        // return Mail::to($notifiable->email)->send(new SendRegisterOTPMail($user));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [];
    }

    public function toVonage(User $notifiable){
        $user = User::where('id', $notifiable->id)->firstOrFail();

        $optService = new OTPServices();
        $otpData = $optService->generate();

        $user->otp = $otpData['code'];
        $user->otp_expiration = $otpData['expiration'];
        $user->save();

        return (new VonageMessage)->content("Votre application Sidle Health. Votre code OTP est: $notifiable->opt. Ce code n'est valable que 3 min.");
    }
}
