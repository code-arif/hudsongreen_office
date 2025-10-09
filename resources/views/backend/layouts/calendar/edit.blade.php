@extends('backend.app')

@section('title', 'Edit Work Schedule')

@section('content')
<div class="app-content main-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <h3 class="page-title">Edit Work Schedule</h3>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('calendar.update', $work) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                               id="title" name="title" value="{{ old('title', $work->title) }}" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="team_id" class="form-label">Team</label>
                                        <select class="form-select @error('team_id') is-invalid @enderror" id="team_id" name="team_id">
                                            <option value="">Select Team</option>
                                            @foreach($teams as $team)
                                                <option value="{{ $team->id }}" {{ old('team_id', $work->team_id) == $team->id ? 'selected' : '' }}>
                                                    {{ $team->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('team_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="work_date" class="form-label">Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('work_date') is-invalid @enderror"
                                               id="work_date" name="work_date" value="{{ old('work_date', $work->work_date) }}" required>
                                        @error('work_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="time" class="form-label">Time <span class="text-danger">*</span></label>
                                        <input type="time" class="form-control @error('time') is-invalid @enderror"
                                               id="time" name="time" value="{{ old('time', $work->time) }}" required>
                                        @error('time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" class="form-control @error('location') is-invalid @enderror"
                                           id="location" name="location" value="{{ old('location', $work->location) }}"
                                           placeholder="Enter location">
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              id="description" name="description" rows="4">{{ old('description', $work->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_completed" name="is_completed" value="1" {{ old('is_completed', $work->is_completed) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_completed">
                                                Mark as Completed
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_rescheduled" name="is_rescheduled" value="1" {{ old('is_rescheduled', $work->is_rescheduled) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_rescheduled">
                                                Mark as Rescheduled
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="note" class="form-label">Notes</label>
                                    <textarea class="form-control @error('note') is-invalid @enderror"
                                              id="note" name="note" rows="3">{{ old('note', $work->note) }}</textarea>
                                    @error('note')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="{{ route('calendar.index') }}" class="btn btn-secondary me-md-2">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Update Event</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
