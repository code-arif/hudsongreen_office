<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Work;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\RescheduleRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class WorkScheduleRequest extends Controller
{
    use ApiResponse;

    // Store schedule
    public function store(Request $request)
    {
        try {
            // Authenticated user check
            $user = auth('api')->user();
            if (!$user) {
                return $this->error([], 'User not found.', 404);
            }

            // Validation
            $validator = Validator::make($request->all(), [
                'work_id'               => 'required|exists:works,id',
                'suggested_start_time'  => 'nullable|date_format:H:i',
                'suggested_end_time'    => 'nullable|date_format:H:i|after_or_equal:suggested_start_time',
                'suggested_work_date'   => 'nullable|date',
                'note'                  => 'nullable|max:250',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                $message = $errors[0] ?? 'Validation failed.';
                if (count($errors) > 1) {
                    $message .= ' (and ' . (count($errors) - 1) . ' more errors)';
                }
                return $this->error([], $message, 422);
            }

            // Work find kore oi work er team_id niye aschi
            $work = Work::find($request->work_id);
            if (!$work) {
                return $this->error([], 'Work not found.', 404);
            }

            // Create reschedule request using work->team_id
            $reschedule = RescheduleRequest::create([
                'work_id'              => $work->id,
                'team_id'              => $work->team_id,
                'suggested_start_time' => $request->suggested_start_time,
                'suggested_end_time'   => $request->suggested_end_time,
                'suggested_work_date'  => $request->suggested_work_date,
                'status'               => 1,
                'note'                 => $request->note
            ]);

            return $this->success($reschedule, 'Reschedule request created successfully!', 200);
        } catch (Exception $e) {
            return $this->error([], $e->getMessage(), 500);
        }
    }


    // Edit schedule
    public function edit($id)
    {
        try {
            $user = auth('api')->user();
            if (!$user) {
                return $this->error([], 'User not found.', 404);
            }

            $reschedule = RescheduleRequest::find($id);
            if (!$reschedule) {
                return $this->error([], 'Reschedule request not found.', 404);
            }

            return $this->success($reschedule, 'Reschedule request fetched successfully!', 200);
        } catch (Exception $e) {
            return $this->error([], $e->getMessage(), 500);
        }
    }

    // Update schedule
    public function update(Request $request, $id)
    {
        try {
            $user = auth('api')->user();
            if (!$user) {
                return $this->error([], 'User not found.', 404);
            }

            $reschedule = RescheduleRequest::find($id);
            if (!$reschedule) {
                return $this->error([], 'Reschedule request not found.', 404);
            }

            // Validation
            $validator = Validator::make($request->all(), [
                'work_id'               => 'required|exists:works,id',
                'suggested_start_time'  => 'nullable|date_format:H:i',
                'suggested_end_time'    => 'nullable|date_format:H:i|after_or_equal:suggested_start_time',
                'suggested_work_date'   => 'nullable|date',
                'note'                  => 'nullable|max:250'
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                $message = $errors[0] ?? 'Validation failed.';
                if (count($errors) > 1) {
                    $message .= ' (and ' . (count($errors) - 1) . ' more errors)';
                }
                return $this->error([], $message, 422);
            }

            // Find the work and its team_id
            $work = Work::find($request->work_id);
            if (!$work) {
                return $this->error([], 'Work not found.', 404);
            }

            // Update reschedule request with team_id from work
            $reschedule->update([
                'work_id'              => $request->work_id,
                'team_id'              => $work->team_id,
                'suggested_start_time' => $request->suggested_start_time,
                'suggested_end_time'   => $request->suggested_end_time,
                'suggested_work_date'  => $request->suggested_work_date,
                'note'                 => $request->note
            ]);

            return $this->success($reschedule, 'Reschedule request updated successfully!', 200);
        } catch (Exception $e) {
            return $this->error([], $e->getMessage(), 500);
        }
    }

    // Delete schedule
    public function destroy($id)
    {
        try {
            $user = auth('api')->user();
            if (!$user) {
                return $this->error([], 'User not found.', 404);
            }

            $reschedule = RescheduleRequest::find($id);
            if (!$reschedule) {
                return $this->error([], 'Reschedule request not found.', 404);
            }

            $reschedule->delete();

            return $this->success([], 'Reschedule request deleted successfully!', 200);
        } catch (Exception $e) {
            return $this->error([], $e->getMessage(), 500);
        }
    }
}
