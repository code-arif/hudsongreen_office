<?php

namespace App\Http\Controllers\Web\Backend;

use Exception;
use App\Models\Work;
use Illuminate\Http\Request;
use App\Models\RescheduleRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class WorkScheduleRequest extends Controller
{
    // get reschedule work list
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $rescheduleRequest = RescheduleRequest::where('status', true)->with([
                'work:id,title',
                'team:id,name'
            ])->get();

            return DataTables::of($rescheduleRequest)
                ->addIndexColumn()

                // Title
                ->addColumn('title', function ($item) {
                    return strlen($item->work->title) > 15
                        ? substr($item->work->title, 0, 15) . '...'
                        : $item->work->title;
                })

                // Team
                ->addColumn('team', function ($item) {
                    $teamName = $item->team ? $item->team->name : 'No Team';
                    if (strlen($teamName) > 15) {
                        $teamName = substr($teamName, 0, 15) . '...';
                    }
                    return '<span class="badge bg-success">' . e($teamName) . '</span>';
                })

                // Note
                ->addColumn('note', function ($item) {
                    return $item->note
                        ? (strlen($item->note) > 25 ? substr($item->note, 0, 25) . '...' : $item->note)
                        : '---';
                })

                // Start Time
                ->addColumn(
                    'time',
                    fn($item) =>
                    $item->time
                        ? date('h:i A', strtotime($item->time))
                        : '---'
                )

                // Work Date
                ->addColumn(
                    'work_date',
                    fn($item) =>
                    $item->suggested_date
                        ? date('d M Y', strtotime($item->suggested_date))
                        : '---'
                )

                // Actions
                ->addColumn('action', function ($item) {
                    return '<div class="d-flex justify-content-start align-items-center gap-1">
                         <button type="button" class="btn btn-sm btn-success rescheduleBtn"
                             data-id="' . $item->id . '">
                             <i class="fas fa-clock-rotate-left"></i> Reschedule
                         </button>
                    </div>';
                })

                ->rawColumns(['title', 'note', 'action', 'team'])
                ->make(true);
        }

        return view("backend.layouts.reschedule.index");
    }

    // edit reschedule work list
    public function edit($id)
    {
        try {
            $reschedule = RescheduleRequest::with('work')->find($id);
            if (!$reschedule) {
                return response()->json(['success' => false, 'message' => 'Work not found.'], 404);
            }

            return response()->json(['success' => true, 'data' => $reschedule]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to fetch work. ' . $e->getMessage()]);
        }
    }

    // update reschedule work
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $work = Work::find($id);
            if (!$work) {
                return response()->json([
                    'status' => false,
                    'message' => 'Work not found!'
                ], 404);
            }

            // Validation (match frontend fields!)
            $validator = Validator::make($request->all(), [
                'time' => 'nullable|date_format:H:i',
                'suggested_date'  => 'nullable|date',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Validation failed',
                    'errors'  => $validator->errors(),
                ], 422);
            }

            // Update Work
            $work->update([
                'time'     => $request->time,
                'work_date'      => $request->suggested_date,
                'is_rescheduled' => true,
                'is_completed' => false,
            ]);

            // Update Reschedule request
            $reschedule = RescheduleRequest::where('work_id', $work->id)->first();
            if ($reschedule) {
                $reschedule->update([
                    'status' => false,
                ]);
            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Work rescheduled!',
                'data'    => $work,
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }
}
