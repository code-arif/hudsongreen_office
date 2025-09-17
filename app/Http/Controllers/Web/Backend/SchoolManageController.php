<?php

namespace App\Http\Controllers\Web\Backend;

use Exception;
use App\Models\School;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SchoolCancelSuccessMail;
use App\Mail\SchoolApprovelSuccessMail;
use App\Mail\SchoolPendingSuccessMail;
use Yajra\DataTables\Facades\DataTables;

class SchoolManageController extends Controller
{
    /**
     * show all school
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = School::latest('id');
            // Filter by status
            if ($request->has('status') && $request->status !== 'all') {
                $query->where('status', $request->status);
            }

            $schools = $query->latest()->get();

            return DataTables::of($schools)
                ->addIndexColumn()
                ->addColumn('name', fn($row) => $row->name)
                ->addColumn('principal', fn($row) => $row->principal_name)
                ->addColumn('email', fn($row) => $row->email ?? '---')
                ->addColumn('phone', fn($row) => $row->phone ?? '---')
                ->addColumn('location', function ($row) {
                    return $row->street_address . ', ' . $row->city . ', ' . $row->state . ' ' . $row->zip_code;
                })
                ->addColumn('students', fn($row) => $row->approximate_student_count ?? 'N/A')

                // Published Date column
                ->addColumn('published_date', function ($row) {
                    return $row->created_at
                        ? $row->created_at->format('d M Y h:i A')
                        : '---';
                })

                // Subscription Days Left column
                ->addColumn('subscription_days_left', function ($row) {
                    if (!$row->created_at) return 0;

                    $daysPassed = $row->created_at->diffInDays(now());
                    $daysLeft = max(0, 365 - $daysPassed);

                    return (int) $daysLeft;
                })


                ->addColumn('status', function ($row) {
                    $statuses = ['pending' => 'secondary', 'approved' => 'success', 'cancelled' => 'danger'];
                    $label = ucfirst($row->status);
                    $color = $statuses[$row->status] ?? 'secondary';

                    return '
                <div class="dropdown">
                    <button class="btn btn-' . $color . ' btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        ' . $label . '
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item change-status" href="#" data-id="' . $row->id . '" data-status="pending">Pending</a></li>
                        <li><a class="dropdown-item change-status" href="#" data-id="' . $row->id . '" data-status="approved">Approved</a></li>
                        <li><a class="dropdown-item change-status" href="#" data-id="' . $row->id . '" data-status="cancelled">Cancelled</a></li>
                    </ul>
                </div>';
                })
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-primary btn-sm view-school" data-id="' . $row->id . '">
                            <i class="fa fa-eye me-1"></i> View
                            </button>';
                })
                ->rawColumns(['status', 'action'])
                ->make();
        }

        return view('backend.layouts.school.index');
    }

    /**
     * show school information
     */
    public function show(Request $request)
    {
        try {
            $schoolId = $request->id;

            // Get school details
            $school = School::with('contact')->find($schoolId);
            if (!$school) {
                return response()->json([
                    'success' => false,
                    'message' => 'No school found!'
                ]);
            }

            return response()->json([
                'success' => true,
                'school' => $school,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'School not found'
            ], 404);
        }
    }

    /**
     * show status manage
     */
    public function status(Request $request, $id)
    {
        try {
            $school = School::findOrFail($id);
            $teacher = Contact::where('school_id', $school->id)->first();

            // Validate the status
            $validStatuses = ['pending', 'approved', 'cancelled'];
            $newStatus = $request->status;

            if (!in_array($newStatus, $validStatuses)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid status'
                ], 422);
            }

            // Update the status
            $school->status = $newStatus;

            // Handle approved
            if ($newStatus === 'approved') {
                $school->approved_by = auth()->id();
                $school->approved_at = now();
                $school->cancelled_by = null;
                $school->cancelled_at = null;
                $school->approval_token = null;

                // Mail::to($teacher->email)->send(new SchoolApprovelSuccessMail($teacher, $school));
            }
            // Handle cancelled
            elseif ($newStatus === 'cancelled') {
                $school->cancelled_by = auth()->id();
                $school->cancelled_at = now();
                $school->approved_by = null;
                $school->approved_at = null;
                $school->approval_token = null;

                // Mail::to($teacher->email)->send(new SchoolCancelSuccessMail($teacher, $school));
            }
            // Handle pending (renewal needed)
            else {
                $school->approved_by = null;
                $school->approved_at = null;
                $school->cancelled_by = null;
                $school->cancelled_at = null;

                // Mail::to($teacher->email)->send(new SchoolPendingSuccessMail($teacher, $school));
            }

            $school->save();

            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully',
                'status' => $school->status
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating status: ' . $e->getMessage()
            ], 500);
        }
    }
}
