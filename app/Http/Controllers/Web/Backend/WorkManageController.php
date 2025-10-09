<?php

namespace App\Http\Controllers\Web\Backend;

use App\Models\Category;
use App\Models\RescheduleRequest;
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
            $query = Work::with('category', 'team')
                ->withCount(['rescheduleRequests' => function ($q) {
                    $q->where('status', 1);
                }])
                ->latest('id');

            // Apply filters if present
            if ($request->has('is_completed') && $request->is_completed !== null && $request->is_completed !== '') {
                $query->where('is_completed', $request->is_completed);
            }

            if ($request->has('is_rescheduled') && $request->is_rescheduled !== null && $request->is_rescheduled !== '') {
                $query->where('is_rescheduled', $request->is_rescheduled);
            }

            // Filter for reschedule requests
            if ($request->filled('has_reschedule_request')) {
                if ($request->has_reschedule_request == 1) {
                    $query->has('rescheduleRequests');
                } elseif ($request->has_reschedule_request == 0) {
                    $query->doesntHave('rescheduleRequests');
                }
            }

            $works = $query->get();

            return DataTables::of($works)
                ->addIndexColumn()

                // Title
                ->addColumn('title', function ($item) {
                    return strlen($item->title) > 15 ? substr($item->title, 0, 15) . '...' : $item->title;
                })

                // Category
                ->addColumn('category', function ($item) {
                    $categoryName = $item->category ? $item->category->name : 'No Category';

                    // truncate if more than 15 chars
                    if (strlen($categoryName) > 15) {
                        $categoryName = substr($categoryName, 0, 15) . '...';
                    }

                    return '<span class="badge bg-info">' . e($categoryName) . '</span>';
                })

                // Team
                ->addColumn('team', function ($item) {
                    $teamName = $item->team ? $item->team->name : 'No Team';

                    // truncate if more than 15 chars
                    if (strlen($teamName) > 15) {
                        $teamName = substr($teamName, 0, 15) . '...';
                    }

                    return '<span class="badge bg-success">'
                        . e($teamName)
                        . ' </span>';
                })

                // Location
                ->addColumn('location', function ($item) {
                    return strlen($item->location) > 20 ? substr($item->location, 0, 20) . '...' : $item->location;
                })

                // Time
                ->addColumn('time', fn($item) => $item->time ? date('h:i A', strtotime($item->time)) : '---')

                // Work Date
                ->addColumn('work_date', fn($item) => $item->work_date ? date('d M Y', strtotime($item->work_date)) : '---')

                // Is Completed
                ->addColumn('is_completed', function ($item) {
                    $isCompleted = $item->is_completed ? true : false;

                    $yesActive = $isCompleted ? 'active' : '';
                    $noActive = !$isCompleted ? 'active' : '';

                    return '
                        <div class="completion-toggle" data-id="' . $item->id . '">
                            <span onclick="showCompletionChangeAlert(' . $item->id . ', 0)" class="toggle-option ' . $noActive . ' left">No</span>
                            <span onclick="showCompletionChangeAlert(' . $item->id . ', 1)" class="toggle-option ' . $yesActive . ' right">Yes</span>
                        </div>
                    ';
                })

                // Is Rescheduled
                ->addColumn('is_rescheduled', fn($item) => $item->is_rescheduled ? '<span class="badge bg-info">Yes</span>' : '<span class="badge bg-secondary">No</span>')

                // Actions
                ->addColumn('action', function ($item) {
                    $buttons = '<div class="d-flex justify-content-start align-items-center gap-1">
                    <button type="button" class="btn btn-primary btn-sm editwork" data-id="' . $item->id . '">
                        <i class="fa fa-pen-to-square"></i> Edit
                    </button>
                    <button type="button" class="btn btn-sm btn-danger deleteBtn" onclick="showDeleteConfirm(' . $item->id . ')">
                        <i class="fa fa-trash"></i> Delete
                    </button>';


                    if ($item->reschedule_requests_count > 0) {
                        $buttons .= '<button type="button" class="btn btn-warning btn-sm WorkRescheduleBtn"
                             data-id="' . $item->id . '">
                             <i class="fa fa-clock-rotate-left"></i> Reschedule
                         </button>';
                    }

                    $buttons .= '</div>';
                    return $buttons;
                })

                ->rawColumns(['title', 'location', 'is_completed', 'is_rescheduled', 'action', 'category', 'team'])
                ->make();
        }

        // work reschedule request
        $scheduleRequest = RescheduleRequest::where('status', true)->count();

        // compact use
        return view("backend.layouts.works.index", compact('scheduleRequest'));
    }

    // Store work
    public function store(Request $request)
    {
        $request->all();
        DB::beginTransaction();

        try {
            // Validation
            $validator = Validator::make($request->all(), [
                'title'        => 'required|string|max:255',
                'description'  => 'nullable|string',
                'location'     => 'nullable|string',
                'latitude'     => 'nullable|numeric|between:-90,90',
                'longitude'    => 'nullable|numeric|between:-180,180',
                'time'     => 'nullable',
                'work_date'    => 'nullable|date',
                'team_id'      => 'nullable|exists:teams,id',

                // Category
                'category_id'   => 'nullable|exists:categories,id',
                'category_name' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Validation failed',
                    'errors'  => $validator->errors(),
                ], 422);
            }

            // Handle Category
            $categoryId = $request->category_id;

            if (!$categoryId && $request->category_name) {
                $category = Category::create([
                    'name' => $request->category_name,
                ]);
                $categoryId = $category->id;
            }

            // Save Work
            $work = Work::create([
                'title'         => $request->title,
                'description'   => $request->description,
                'location'      => $request->location,
                'latitude'      => $request->latitude,
                'longitude'     => $request->longitude,
                'time'    => $request->time,
                'work_date'     => $request->work_date,
                'team_id'       => $request->team_id,
                'category_id'   => $categoryId,
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
            $work = Work::find($id);

            if (!$work) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Work not found!',
                ], 404);
            }

            // Validation
            $validator = Validator::make($request->all(), [
                'title'         => 'required|string|max:255',
                'description'   => 'nullable|string',
                'location'      => 'nullable|string',
                'latitude'      => 'nullable|numeric|between:-90,90',
                'longitude'     => 'nullable|numeric|between:-180,180',
                'time'    => 'nullable',
                'work_date'     => 'nullable|date',
                'team_id'       => 'nullable|exists:teams,id',
                'category_id'   => 'nullable|exists:categories,id',
                'category_name' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Validation failed',
                    'errors'  => $validator->errors(),
                ], 422);
            }

            // Handle Category
            $categoryId = $request->category_id;

            if (!$categoryId && $request->category_name) {
                $category = Category::firstOrCreate(['name' => $request->category_name]);
                $categoryId = $category->id;
            }

            // Update Work
            $work->update([
                'title'        => $request->title,
                'description'  => $request->description,
                'location'     => $request->location,
                'latitude'     => $request->latitude,
                'longitude'    => $request->longitude,
                'time'   => $request->time,
                'work_date'    => $request->work_date,
                'team_id'      => $request->team_id,
                'category_id'  => $categoryId,
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

    // Change wodrk complation status
    public function complation($id)
    {
        $work = Work::with(['team'])->find($id);

        if (!$work) {
            return response()->json(['success' => false, 'message' => 'Work not found.'], 404);
        }

        // Toggle status
        $work->is_completed = $work->is_completed == true ? false : true;
        $work->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status Changed successfully!',
        ]);
    }

    // List of all category
    public function getCategory()
    {
        $categories = Category::select('id', 'name')->get();

        return response()->json([
            'status' => true,
            'data'   => $categories
        ]);
    }

    // edit reschedule work list
    public function reschedultEdit($id)
    {
        try {
            $reschedule = Work::with('request')->find($id);
            if (!$reschedule) {
                return response()->json(['success' => false, 'message' => 'Work not found.'], 404);
            }

            return response()->json(['success' => true, 'data' => $reschedule]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to fetch work. ' . $e->getMessage()]);
        }
    }

    // Update reschedule work
    public function rescheduleUpdate(Request $request, $id)
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
