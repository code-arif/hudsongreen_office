<?php

namespace App\Mail;

use App\Models\Contact;
use App\Models\School;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;

class SchoolRegisterSuccessForAdminMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $contact;
    public $school;
    public $approveUrl;
    public $cancelUrl;

    public function __construct(School $school, string $approveUrl, string $cancelUrl, Contact $contact)
    {
        $this->school = $school;
        $this->approveUrl = $approveUrl;
        $this->cancelUrl = $cancelUrl;
        $this->contact = $contact;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Admin School Approval Mail',
        );
    }



    public function build()
    {
        return $this->subject('New School Registration - Approval Required')
            ->view('emails.register_success_for_admin');
    }
}
