<?php

namespace App\Mail;

use App\Models\School;
use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SchoolApprovelSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $teacher;
    public $school;

    /**
     * Create a new message instance.
     */
    public function __construct(Contact $teacher, School $school)
    {
        $this->teacher = $teacher;
        $this->school  = $school;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('🎉 School Approval Successful')
            ->markdown('emails.approve')
            ->with([
                'teacher' => $this->teacher,
                'school'  => $this->school,
            ]);
    }
}
