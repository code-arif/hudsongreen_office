@extends('backend.app')

@section('title', 'Global Work Calendar')

@section('content')
    <div class="app-content main-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Global Work Calendar</h1>
                    </div>
                    <div class="ms-auto pageheader-btn">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Calendar</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Global</li>
                        </ol>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <select id="teamSelect" class="form-control">
                            <option value="">All Teams</option>
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}" {{ $teamId == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 h-50">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-header bg-white px-4 border-0">
                                <h5 class="mb-0 text-dark fw-semibold p-3">
                                    <i class="fas fa-calendar-alt me-2 text-primary"></i>
                                    Work Schedule
                                </h5>
                            </div>
                            <div class="card-body py-3">
                                <div id="userCalendar" style="height: 600px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid/main.css" rel="stylesheet" />
    <style>
        #userCalendar {
            background-color: #f8fafc;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .fc .fc-button {
            background-color: #38a3a5;
            border: none;
            border-radius: 6px;
            padding: 8px 12px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .fc .fc-button:hover {
            background-color: #2a7c7e;
            transform: translateY(-2px);
        }

        .fc .fc-button-primary:not(:disabled):active {
            background-color: #1e5a5c;
            transform: translateY(0);
        }

        .fc .fc-toolbar-title {
            font-size: 1.5rem;
            color: #1e3a8a;
            font-weight: 600;
        }

        .fc .fc-daygrid-day,
        .fc .fc-timegrid-slot {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
        }

        .fc .fc-daygrid-day.fc-day-today {
            background-color: #e6f3ff;
        }

        .fc .fc-event {
            padding: 8px 12px;
            border-radius: 6px;
            border: 2px solid;
            color: #fff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .fc .fc-event:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .fc .fc-event-title {
            font-weight: 500;
            font-size: 0.9rem;
        }

        .fc .fc-timegrid-event {
            padding: 8px;
        }

        .fc .fc-daygrid-event {
            margin: 4px 2px;
        }

        /* Custom styling for SweetAlert2 popup */
        .swal2-popup {
            text-align: left !important; /* Align all content to the left */
        }
        .swal2-html-container {
            text-align: left !important; /* Ensure HTML content is left-aligned */
        }
        .swal2-title {
            text-align: left !important; /* Ensure title is left-aligned */
        }
        /* Custom styling for SweetAlert2 close button */
        .swal2-confirm {
            background-color: #dc3545 !important; /* Red background for close button */
            border: none !important;
            border-radius: 6px !important;
            padding: 10px 20px !important;
            transition: background-color 0.3s ease !important;
            position: absolute !important; /* Position button absolutely */
            bottom: 10px !important; /* Place at bottom */
            right: 10px !important; /* Place at right */
        }
        .swal2-confirm:hover {
            background-color: #c82333 !important; /* Darker red on hover */
        }
        /* Ensure popup content has padding to avoid overlap with button */
        .swal2-content {
            padding-bottom: 50px !important; /* Add space for button at bottom */
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('userCalendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek'
                },
                buttonText: {
                    today: 'Today',
                    month: 'Month',
                    week: 'Week'
                },
                editable: false,
                selectable: false,
                eventTextColor: '#fff',
                events: @json($events),
                eventClick: function(info) {
                    let desc = info.event.extendedProps.description || 'No description';
                    let location = info.event.extendedProps.location || 'Not specified';
                    let status = info.event.extendedProps.status || 'Unknown';
                    let isRescheduled = info.event.extendedProps.is_rescheduled ? 'Yes' : 'No';
                    let note = info.event.extendedProps.note || 'No notes';
                    let team = info.event.extendedProps.team || 'No Team';
                    Swal.fire({
                        title: `<strong>${info.event.title}</strong>`,
                        html: `
                            <small class="text-muted">Date: ${info.event.startStr}</small><hr>
                            <strong>Description:</strong> ${desc}<hr>
                            <strong>Location:</strong> ${location}<br>
                            <strong>Status:</strong> ${status}<br>
                            <strong>Rescheduled:</strong> ${isRescheduled}<br>
                            <strong>Note:</strong> ${note}<br>
                            <strong>Team:</strong> ${team}
                        `,
                        icon: 'info',
                        width: '800px',
                        confirmButtonText: 'Close',
                        customClass: {
                            popup: 'rounded-3',
                            title: 'fw-bold',
                            confirmButton: 'swal2-confirm'
                        }
                    });
                },
                dayMaxEventRows: true,
                views: {
                    dayGridMonth: {
                        dayMaxEventRows: 3
                    }
                }
            });
            calendar.render();

            // Team select change event
            document.getElementById('teamSelect').addEventListener('change', function() {
                const teamId = this.value;
                const url = new URL(window.location.href);
                if (teamId) {
                    url.searchParams.set('team_id', teamId);
                } else {
                    url.searchParams.delete('team_id');
                }
                window.location.href = url.toString();
            });
        });
    </script>
@endpush
