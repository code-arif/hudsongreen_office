<?php

namespace App\Mail;

use App\Models\School;
use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class SchoolRegisterSuccessForTeacherMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $contact;
    public $school;

    public function __construct(Contact $contact, School $school)
    {
        $this->contact = $contact;
        $this->school = $school;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Teacher Pending Mail',
        );
    }


    public function build()
    {
        return $this->subject('Welcome! Your School Registration is Pending')
            ->view('emails.register_success_for_teacher');
    }
}
