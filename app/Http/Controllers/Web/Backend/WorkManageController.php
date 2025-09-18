<?php

namespace App\Http\Controllers\Web\Backend;

use Exception;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class WorkManageController extends Controller
{
    // List of all work
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $works = Work::latest('id')->get();

            return DataTables::of($works)
                ->addIndexColumn()

                // Title
                ->addColumn('title', function ($item) {
                    return strlen($item->title) > 15 ? substr($item->title, 0, 15) . '...' : $item->title;
                })

                // Description
                ->addColumn('description', function ($item) {
                    return strlen($item->description) > 25 ? substr($item->description, 0, 25) . '...' : $item->description;
                })

                // Location
                ->addColumn('location', function ($item) {
                    return strlen($item->location) > 20 ? substr($item->location, 0, 20) . '...' : $item->location;
                })

                // Start Time
                ->addColumn('start_time', fn($item) => $item->start_time ? date('h:i A', strtotime($item->start_time)) : '---')

                // End Time
                ->addColumn('end_time', fn($item) => $item->end_time ? date('h:i A', strtotime($item->end_time)) : '---')

                // Work Date
                ->addColumn('work_date', fn($item) => $item->work_date ? date('d M Y', strtotime($item->work_date)) : '---')

                // Is Completed
                ->addColumn('is_completed', fn($item) => $item->is_completed ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-warning">No</span>')

                // Is Rescheduled
                ->addColumn('is_rescheduled', fn($item) => $item->is_rescheduled ? '<span class="badge bg-info">Yes</span>' : '<span class="badge bg-secondary">No</span>')

                // Status (switch)
                ->addColumn('status', function ($item) {
                    $checked = $item->status == 1 ? 'checked' : '';
                    return '<div class="form-check form-switch" style="display: flex; justify-content: center; align-items: center;">
                            <input onclick="showStatusChangeAlert(' . $item->id . ')"
                                   type="checkbox"
                                   class="form-check-input"
                                   role="switch"
                                   style="cursor: pointer; width: 40px; height: 20px;"
                                   ' . $checked . '>
                        </div>';
                })

                // Actions
                ->addColumn('action', function ($item) {
                    return '<div class="d-flex justify-content-start align-items-center gap-1">
                             <button type="button"
                                   class="btn btn-primary btn-sm editwork"
                                   data-id="' . $item->id . '">
                            <i class="fa fa-pen-to-square"></i> Edit
                            </button>

                            <button type="button" class="btn btn-sm btn-success rescheduleBtn"
                                data-id="' . $item->id . '">
                                <i class="fas fa-calendar"></i> Reschedule
                            </button>

                           <button type="button" class="btn btn-sm btn-danger deleteBtn"
                                onclick="showDeleteConfirm(' . $item->id . ')">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </div>';
                })

                ->rawColumns(['title', 'description', 'location', 'is_completed', 'is_rescheduled', 'status', 'action'])
                ->make();
        }

        return view("backend.layouts.works.index");
    }

    // Store work
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // Validation
            $validator = Validator::make($request->all(), [
                'title'        => 'required|string|max:255',
                'description'  => 'nullable|string',
                'location'     => 'nullable|string',
                'latitude'     => 'nullable|numeric|between:-90,90',
                'longitude'    => 'nullable|numeric|between:-180,180',
                'start_time'   => 'nullable|date_format:H:i',
                'end_time'     => 'nullable|date_format:H:i',
                'work_date'    => 'nullable|date',
                'team_id'      => 'nullable|exists:teams,id',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Validation failed',
                    'errors'  => $validator->errors(),
                ], 422);
            }

            // Save Work
            $work = Work::create([
                'title'         => $request->title,
                'description'   => $request->description,
                'location'      => $request->location,
                'latitude'      => $request->latitude,
                'longitude'     => $request->longitude,
                'start_time'    => $request->start_time,
                'end_time'      => $request->end_time,
                'work_date'     => $request->work_date,
                'team_id'       => $request->team_id,
            ]);

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Work created successfully!',
                'data'    => $work,
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Edit work
    public function edit($id)
    {
        try {
            $work = Work::with(['team'])->find($id);

            if (!$work) {
                return response()->json(['success' => false, 'message' => 'Work not found.'], 404);
            }

            return response()->json(['success' => true, 'data' => $work]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to fetch work. ' . $e->getMessage()]);
        }
    }

    // Update work
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $work = Work::findOrFail($id);

            // Validation
            $validator = Validator::make($request->all(), [
                'title'        => 'required|string|max:255',
                'description'  => 'nullable|string',
                'location'     => 'nullable|string',
                'latitude'     => 'nullable|numeric|between:-90,90',
                'longitude'    => 'nullable|numeric|between:-180,180',
                'start_time'   => 'nullable|date_format:H:i',
                'end_time'     => 'nullable|date_format:H:i',
                'work_date'    => 'nullable|date',
                'team_id'      => 'nullable|exists:teams,id',
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
                'title'          => $request->title,
                'description'    => $request->description,
                'location'       => $request->location,
                'latitude'       => $request->latitude,
                'longitude'      => $request->longitude,
                'start_time'     => $request->start_time,
                'end_time'       => $request->end_time,
                'work_date'      => $request->work_date,
                'team_id'        => $request->team_id,
            ]);

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Work updated successfully!',
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


    // Delete work
    public function delete($id)
    {
        try {
            $work = Work::with(['team'])->find($id);

            if (!$work) {
                return response()->json(['success' => false, 'message' => 'Work not found.'], 404);
            }

            $work->delete();

            return response()->json([
                'success' => true,
                'message' => 'Work deleted successfully.'
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete work. ' . $e->getMessage()
            ], 500);
        }
    }


    // Change status
    public function status($id)
    {
        $work = Work::with(['team'])->find($id);

        if (!$work) {
            return response()->json(['success' => false, 'message' => 'Work not found.'], 404);
        }

        // Toggle status
        $work->status = $work->status == 0 ? 1 : 0;
        $work->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status Changed successfully!',
        ]);
    }
}
