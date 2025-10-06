@extends('backend.app')

@section('title', 'Team Work Calendar')

@section('content')
    <div class="app-content main-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">{{ $team->name }} - Work Calendar</h1>
                        <p class="text-muted mb-0">Manage and sync team work schedule</p>
                    </div>
                    <div class="ms-auto pageheader-btn">
                        @if (Session::has('google_token'))
                            <span class="badge bg-success me-2">
                                <i class="fas fa-check-circle"></i> Google Calendar Connected
                            </span>
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

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="stats-icon bg-primary">
                                        <i class="fas fa-tasks"></i>
                                    </div>
                                    <div class="ms-3">
                                        <p class="text-muted mb-0">Total Works</p>
                                        <h4 class="mb-0">{{ count($events) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="stats-icon bg-success">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div class="ms-3">
                                        <p class="text-muted mb-0">Completed</p>
                                        <h4 class="mb-0">
                                            {{ collect($events)->where('backgroundColor', '#34c38f')->count() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="stats-icon bg-warning">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="ms-3">
                                        <p class="text-muted mb-0">Pending</p>
                                        <h4 class="mb-0">
                                            {{ collect($events)->where('backgroundColor', '#60a5fa')->count() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="stats-icon bg-info">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="ms-3">
                                        <p class="text-muted mb-0">Team Members</p>
                                        <h4 class="mb-0">{{ $team->users->count() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Calendar -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div
                                class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <i class="fas fa-calendar-alt me-2"></i>Work Schedule
                                </h5>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-light" onclick="calendar.prev()">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <button class="btn btn-sm btn-light" onclick="calendar.today()">Today</button>
                                    <button class="btn btn-sm btn-light" onclick="calendar.next()">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Work Details Modal -->
                <div class="modal fade" id="workModal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="modalTitle">Work Details</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body" id="modalBody">
                                <!-- Dynamic content -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .stats-card {
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
        }

        #calendar {
            height: 650px;
        }

        .fc-event {
            cursor: pointer;
            border-left: 4px solid;
        }

        .fc-daygrid-day.fc-day-today {
            background-color: #fff3cd !important;
        }

        .detail-row {
            padding: 12px;
            background: #f8f9fa;
            border-radius: 6px;
            margin-bottom: 10px;
        }

        .sync-btn {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
    <script>
        let calendar;
        const teamId = {{ $team->id }};
        const events = @json($events);

        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');

            calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: '',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                editable: false,
                selectable: true,
                dayMaxEvents: true,
                events: events,

                dateClick: function(info) {
                    if (confirm(`Create new work for ${info.dateStr}?`)) {
                        window.location.href =
                            `{{ route('work.index') }}?team_id=${teamId}&date=${info.dateStr}`;
                    }
                },

                eventClick: function(info) {
                    showWorkDetails(info.event);
                }
            });

            calendar.render();
        });

        function showWorkDetails(event) {
            const props = event.extendedProps;
            const isCompleted = event.backgroundColor === '#34c38f';
            const isSynced = event.id && event.extendedProps.google_event_id;

            let timeInfo = event.allDay ?
                `<strong>Date:</strong> ${event.startStr} (All Day)` :
                `<strong>Start:</strong> ${new Date(event.start).toLocaleString()}<br>
                 <strong>End:</strong> ${new Date(event.end).toLocaleString()}`;

            const content = `
                <div class="detail-row">
                    <i class="fas fa-calendar text-primary me-2"></i>
                    ${timeInfo}
                </div>
                <div class="detail-row">
                    <i class="fas fa-info-circle text-info me-2"></i>
                    <strong>Status:</strong>
                    <span class="badge ${isCompleted ? 'bg-success' : 'bg-warning'}">${isCompleted ? 'Completed' : 'Pending'}</span>
                    ${isSynced ? '<span class="badge bg-primary ms-2"><i class="fab fa-google"></i> Synced</span>' : ''}
                </div>
                <div class="detail-row">
                    <i class="fas fa-align-left text-success me-2"></i>
                    <strong>Description:</strong><br>
                    <div class="mt-2">${props.description || 'No description'}</div>
                </div>
                <div class="detail-row">
                    <i class="fas fa-map-marker-alt text-danger me-2"></i>
                    <strong>Location:</strong> ${props.location || 'Not specified'}
                </div>
                ${props.note ? `
                    <div class="detail-row">
                        <i class="fas fa-sticky-note text-warning me-2"></i>
                        <strong>Notes:</strong> ${props.note}
                    </div>` : ''}
                <div class="mt-4 text-center">
                    ${!isSynced ? `
                            <button onclick="syncToGoogle(${event.id})" class="btn btn-danger sync-btn">
                                <i class="fab fa-google me-2"></i>Sync to Google Calendar
                            </button>
                        ` : ''}
                    ${props.location && props.location !== 'Not specified' ? `
                            <button onclick="viewOnMap('${props.location}')" class="btn btn-info ms-2">
                                <i class="fas fa-map me-2"></i>View on Map
                            </button>
                        ` : ''}
                </div>
            `;

            document.getElementById('modalTitle').innerHTML = `<i class="fas fa-briefcase me-2"></i>${event.title}`;
            document.getElementById('modalBody').innerHTML = content;
            new bootstrap.Modal(document.getElementById('workModal')).show();
        }

        function syncToGoogle(workId) {
            if (!{{ Session::has('google_token') ? 'true' : 'false' }}) {
                if (confirm('You need to connect Google Calendar first. Connect now?')) {
                    window.location.href = "{{ route('google.auth') }}";
                }
                return;
            }

            $.ajax({
                url: `/google/sync-work/${workId}`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                beforeSend: function() {
                    toastr.info('Syncing to Google Calendar...');
                },
                success: function(res) {
                    if (res.status) {
                        toastr.success(res.message);
                        $('#workModal').modal('hide');
                        location.reload();
                    } else {
                        if (res.redirect) {
                            window.location.href = res.redirect;
                        } else {
                            toastr.error(res.message);
                        }
                    }
                },
                error: function(xhr) {
                    toastr.error('Failed to sync: ' + (xhr.responseJSON?.message || 'Unknown error'));
                }
            });
        }

        function viewOnMap(location) {
            window.open(`https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(location)}`, '_blank');
        }
    </script>
@endpush
