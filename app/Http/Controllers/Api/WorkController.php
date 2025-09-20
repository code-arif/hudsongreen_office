<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Work;
use App\Helper\Helper;
use App\Models\WorkImage;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\WorkResource;
use App\Http\Resources\MapWorkResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\WorkDetailsResource;

class WorkController extends Controller
{
    // work list view
    public function index(Request $request)
    {
        try {
            $user = auth('api')->user();
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found',
                ], 404);
            }

            $teamId = $user->team?->id;

            if (!$teamId) {
                return response()->json([
                    'status' => false,
                    'message' => 'User is not assigned to any team',
                ], 404);
            }

            $query = Work::where('team_id', $teamId);

            // Filter
            $filter = $request->query('filter');
            $today = Carbon::today();

            switch ($filter) {
                case 'previous':
                    $query->whereDate('work_date', '<', $today);
                    break;
                case 'current':
                    $query->whereDate('work_date', $today);
                    break;
                case 'next_2':
                case 'next_3':
                case 'next_4':
                case 'next_5':
                case 'next_6':
                    $days = (int)str_replace('next_', '', $filter);
                    $query->whereDate('work_date', '>', $today)
                        ->whereDate('work_date', '<=', $today->copy()->addDays($days));
                    break;
            }

            // Pagination
            $perPage = $request->query('per_page', 10);
            $works = $query->orderBy('work_date', 'asc')->paginate($perPage);

            return response()->json([
                'status' => true,
                'message' => 'Works fetched successfully',
                'data' => WorkResource::collection($works),
                'pagination' => [
                    'total' => $works->total(),
                    'current_page' => $works->currentPage(),
                    'last_page' => $works->lastPage(),
                    'per_page' => $works->perPage(),
                ],
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }

    // work list in map
    public function mapView(Request $request)
    {
        try {
            $user = auth('api')->user();
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found',
                ], 404);
            }

            $teamId = $user->team?->id;

            if (!$teamId) {
                return response()->json([
                    'status' => false,
                    'message' => 'User is not assigned to any team',
                ], 404);
            }

            $query = Work::where('team_id', $teamId);

            // Filter
            $filter = $request->query('filter');
            $today = Carbon::today();

            switch ($filter) {
                case 'previous':
                    $query->whereDate('work_date', '<', $today);
                    break;
                case 'current':
                    $query->whereDate('work_date', $today);
                    break;
                case 'next_2':
                case 'next_3':
                case 'next_4':
                case 'next_5':
                case 'next_6':
                    $days = (int)str_replace('next_', '', $filter);
                    $query->whereDate('work_date', '>', $today)
                        ->whereDate('work_date', '<=', $today->copy()->addDays($days));
                    break;
            }


            $perPage = $request->query('per_page', 10);
            $works = $query->orderBy('work_date', 'asc')->paginate($perPage);

            return response()->json([
                'status' => true,
                'message' => 'Works fetched successfully',
                'data' => MapWorkResource::collection($works),
                'pagination' => [
                    'total' => $works->total(),
                    'current_page' => $works->currentPage(),
                    'last_page' => $works->lastPage(),
                    'per_page' => $works->perPage(),
                ],
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }

    // work mark as complete
    public function completeWork(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $user = auth('api')->user();
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found',
                ], 404);
            }

            $work = Work::find($id);
            if (!$work) {
                return response()->json([
                    'status' => false,
                    'message' => 'Work not found',
                ], 404);
            }

            // Already completed check
            if ($work->is_completed) {
                return response()->json([
                    'status' => false,
                    'message' => 'This work has already been completed.',
                ], 400);
            }

            // Validation
            $validator = Validator::make($request->all(), [
                'note' => 'nullable|string|max:500',
                'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            // Update work
            $work->is_completed = true;
            $work->status = 1;
            $work->note = $request->note ?? $work->note;
            $work->save();

            // Initialize uploadedImages array
            $uploadedImages = [];

            // Handle images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imagePath = Helper::uploadImage($image, 'work_images');
                    if ($imagePath) {
                        WorkImage::create([
                            'work_id' => $work->id,
                            'image_path' => $imagePath,
                        ]);

                        $uploadedImages[] = url($imagePath);
                    }
                }
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Work marked as completed successfully.',
                'data' => [
                    'id' => $work->id,
                    'title' => $work->title,
                    'is_completed' => $work->is_completed,
                    'note' => $work->note,
                    'images' => $uploadedImages, // Now this variable is always defined
                ],
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }

    // work details
    public function show($id)
    {
        try {
            $work = Work::with(['images', 'team', 'category'])->find($id);

            if (!$work) {
                return response()->json([
                    'status' => false,
                    'message' => 'Work not found',
                ], 404);
            }

            return response()->json([
                'status' => true,
                'data' => new WorkDetailsResource($work),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }
}
