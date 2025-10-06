@extends('backend.app')

@section('title', 'Team Work Calendar')

@section('content')
    {{-- <div class="app-content main-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">{{ $team->name }} - Work Calendar</h1>
                        <p class="text-muted mb-0">Manage and sync team work schedule with Google Calendar</p>
                    </div>
                    <div class="ms-auto pageheader-btn">
                        @if (Session::has('google_token'))
                            <button id="sync-button" class="btn btn-success btn-sm me-2">
                                <i class="fas fa-sync-alt"></i> Sync All to Google Calendar
                            </button>
                        @else
                            <a href="{{ route('google.auth') }}" class="btn btn-danger btn-sm me-2">
                                <i class="fab fa-google"></i> Connect Google Calendar
                            </a>
                        @endif
                        <a href="{{ route('team.list') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">
                                    <i class="fab fa-google me-2"></i>Google Calendar View
                                </h5>
                            </div>
                            <div class="card-body">
                                @if (Session::has('google_token'))
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe
                                            src="https://calendar.google.com/calendar/embed?src={{ urlencode($googleCalendarId) }}&ctz=Asia/Dhaka"
                                            class="embed-responsive-item" style="border: 0" width="100%" height="650"
                                            frameborder="0" scrolling="no"></iframe>
                                    </div>
                                @else
                                    <div class="text-center p-5">
                                        <h4>Please connect your Google Calendar to view the schedule.</h4>
                                        <a href="{{ route('google.auth') }}" class="btn btn-danger mt-3">
                                            <i class="fab fa-google"></i> Connect Now
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div> --}}

    <p> Calendar is under construction. Actually this is criticaly work. so we impliment carefully. We hope you will see the calendar soon </p>
@endsection

@push('styles')
    <style>
        .embed-responsive {
            position: relative;
            display: block;
            width: 100%;
            padding: 0;
            overflow: hidden;
        }

        .embed-responsive-16by9::before {
            padding-top: 56.25%;
            content: "";
            display: block;
        }

        .embed-responsive .embed-responsive-item {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
    </style>
@endpush

