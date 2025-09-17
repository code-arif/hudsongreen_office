<?php

namespace App\Http\Controllers\Web\Backend;

use App\Models\School;
use App\Models\Contact;
use App\Http\Controllers\Controller;
use App\Mail\SchoolApprovelSuccessMail;
use App\Mail\SchoolCancelSuccessMail;
use Illuminate\Support\Facades\Mail;

class SchoolApprovalController extends Controller
{
    /**
     * Summary of approve school
     */
    public function approveFromEmail($token)
    {
        $school = School::where('approval_token', $token)->first();
        $teacher = Contact::where('school_id', $school->id)->first();

        // Token invalid or already used
        if (!$school) {
            abort(404, 'School not found or approval token is invalid.');
        }

        // Already approved/cancelled
        if ($school->status !== 'pending') {
            return redirect()->route('dashboard')
                ->with('t-error', 'This school is already ' . $school->status);
        }

        // Must be logged in as admin
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect()->route('login')
                ->with('t-error', 'You must login as admin to approve.');
        }

        // Update approval status
        $school->update([
            'status'        => 'approved',
            'approved_by'   => auth()->id(),
            'approved_at'   => now(),
            'approval_token' => null,
        ]);


        // Mail::to($teacher->email)->send(new SchoolApprovelSuccessMail($teacher, $school));


        return redirect()->route('dashboard')
            ->with('t-success', 'School approved successfully.');
    }


    /**
     * Summary of cancel school
     */
    public function cancelFromEmail($token)
    {
        $user = auth('web')->user();

        $school = School::where('approval_token', $token)->first();

        if (!$school) {
            abort(404, 'School not found or already cancelled.');
        }

        if ($school->status !== 'pending') {
            return redirect()->route('dashboard')
                ->with('t-error', 'This school is already ' . $school->status);
        }

        if (!$user || $user->role !== 'admin') {
            return redirect()->route('login')
                ->with('t-error', 'You must login as admin to cancel.');
        }

        $school->update([
            'status'         => 'cancelled',
            'cancelled_by'   => $user->id,
            'cancelled_at'   => now(),
            'approval_token' => null,
        ]);

        // Get teacher info
        $teacher = Contact::where('school_id', $school->id)->first();

        // Send cancel mail
        if ($teacher && $teacher->email) {
            // Mail::to($teacher->email)->send(new SchoolCancelSuccessMail($teacher, $school));
        }

        return redirect()->route('dashboard')
            ->with('t-success', 'School cancelled successfully.');
    }
}
