<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function build()
    {
        return $this->subject('Reset Your Password')
                    ->view('account.email_message_forgot_password') // Pastikan file ini ada
                    ->with([
                        'url' => $this->url, // Mengirim variabel $url ke view
                    ]);
    }

    /**
     * Get the message envelope.
     */
   /* public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reset Password Mail',
        );
    }
*/
    /**
     * Get the message content definition.
     */
 /*   public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }
*/
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
