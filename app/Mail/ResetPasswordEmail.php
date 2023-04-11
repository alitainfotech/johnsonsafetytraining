<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $token, $email;

    /**
     * @author Jayesh
     * 
     * @uses Create a new message instance.
     *
     * @return void
     */
    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    /**
     * @author Jayesh
     * 
     * @uses Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address(env('MAIL_FROM_ADDRESS'), env('APP_NAME')),
            to: 'kishan.alitainfotech@gmail.com',
            subject: 'Reset Password',
        );
    }

    /**
     * @author Jayesh
     * 
     * @uses Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.forgot-password',
            with: [
                'title' => env('APP_NAME') . 'Reset Password',
                'token' => $this->token,
            ],
        );
    }

    /**
     * @author Jayesh
     * 
     * @uses Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
