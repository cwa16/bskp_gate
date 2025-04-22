<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ActiveLoginNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $nik;

    public $email;

    public $currentTime;

    public $ipAddress;

    public $name;
    /**
     * Create a new message instance.
     */
    public function __construct($nik, $email, $currentTime, $ipAddress, $name)
    {
        $this->nik = $nik;
        $this->email = $email;
        $this->currentTime = $currentTime;
        $this->ipAddress = $ipAddress;
        $this->name = $name;
    }

    public function build()
    {
        return $this->view('emails.active-login')
            ->subject('Login Aktif Terdeteksi')
            ->with([
                'nik' => $this->nik,
                'email' => $this->email,
                'currentTime' => $this->currentTime,
                'ipAddress' => $this->ipAddress,
                'name' => $this->name,
            ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Login Aktif Terdeteksi',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.active-login',
        );
    }

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
