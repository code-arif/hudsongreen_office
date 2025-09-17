<?php

namespace App\Mail;

use App\Models\School;
use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class SchoolPendingSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $teacher;
    public $school;

    public function __construct(Contact $teacher, School $school)
    {
        $this->teacher = $teacher;
        $this->school = $school;
    }

    public function build()
    {
        return $this->subject('📌 Renewal Required for ' . $this->school->name)
            ->markdown('emails.pending');
    }
}
