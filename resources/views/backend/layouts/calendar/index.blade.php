@extends('backend.app')

@section('title', 'Global Work Calendar')

@section('content')
    <div class="app-content main-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <!-- PAGE HEADER -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Work Schedule</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Calendar</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- FILTERS -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <select id="teamFilter" class="form-select">
                            <option value="">All Teams</option>
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}" {{ $teamId == $team->id ? 'selected' : '' }}>
                                    {{ $team->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select id="statusFilter" class="form-select">
                            <option value="">All Status</option>
                            <option value="completed" {{ $status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Pending</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select id="dateRangeFilter" class="form-select">
                            <option value="month" {{ $dateRange == 'month' ? 'selected' : '' }}>This Month</option>
                            <option value="week" {{ $dateRange == 'week' ? 'selected' : '' }}>This Week</option>
                            <option value="today" {{ $dateRange == 'today' ? 'selected' : '' }}>Today</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex gap-2">
                            <a href="{{ route('calendar.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i>Add Event
                            </a>
                            @if (auth()->user()->role === 'admin')
                                <a href="{{ route('google.redirect') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-sync-alt me-1"></i>Sync Google
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- CALENDAR -->
                <div class="row">
                    <div class="col-12 h-50">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-header bg-white px-4 border-0">
                                <h5 class="mb-0 text-dark fw-semibold p-3">
                                    <i class="fas fa-calendar-alt me-2 text-primary"></i>
                                    Work Schedule
                                    @if (session('google_access_token'))
                                        <span class="badge bg-success ms-2">Google Calendar Synced</span>
                                    @else
                                        <span class="badge bg-warning ms-2">Not Synced</span>
                                    @endif
                                </h5>
                            </div>
                            <div class="card-body py-3">
                                <div id="userCalendar" style="height: 600px;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- GOOGLE SYNC STATUS -->
                @if (auth()->user()->role === 'admin')
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                Google Calendar Status:
                                @if (session('google_access_token'))
                                    <span class="text-success">Connected</span>
                                    <a href="{{ route('google.disconnect') }}"
                                        class="btn btn-sm btn-outline-danger ms-2">Disconnect</a>
                                @else
                                    <span class="text-danger">Not Connected</span>
                                    <a href="{{ route('google.redirect') }}" class="btn btn-sm btn-primary ms-2">Connect
                                        Now</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/main.min.css' rel='stylesheet' />
    <link href='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.8/main.min.css' rel='stylesheet' />
    <link href='https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@6.1.8/main.min.css' rel='stylesheet' />
    <link href='https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@6.1.8/main.min.css' rel='stylesheet' />

    <!-- FullCalendar JS -->
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.8/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@6.1.8/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@6.1.8/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.8/main.min.js'></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('userCalendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['bootstrap5', 'interaction', 'dayGrid', 'timeGrid'],
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                initialView: 'dayGridMonth',
                editable: {{ auth()->user()->role === 'admin' ? 'true' : 'false' }},
                selectable: {{ auth()->user()->role === 'admin' ? 'true' : 'false' }},
                selectMirror: true,
                dayMaxEvents: true,
                weekends: true,
                events: {
                    url: '{{ route('calendar.events') }}',
                    method: 'GET',
                    extraParams: {
                        team_id: $('#teamFilter').val(),
                        status: $('#statusFilter').val()
                    },
                    failure: function() {
                        alert('Failed to fetch events');
                    }
                },
                eventClick: function(info) {
                    if ({{ auth()->user()->role === 'admin' ? 'true' : 'false' }}) {
                        if (confirm('Edit this event?')) {
                            window.location.href = info.event.extendedProps.url;
                        }
                    } else {
                        // Show event details for non-admins
                        showEventDetails(info.event);
                    }
                },
                eventDrop: function(info) {
                    if ({{ auth()->user()->role === 'admin' ? 'true' : 'false' }}) {
                        updateEventDate(info.event, info.delta);
                    }
                },
                eventResize: function(info) {
                    if ({{ auth()->user()->role === 'admin' ? 'true' : 'false' }}) {
                        updateEventTime(info.event, info.startDelta);
                    }
                },
                select: function(info) {
                    if ({{ auth()->user()->role === 'admin' ? 'true' : 'false' }}) {
                        var title = prompt('Event Title:');
                        if (title) {
                            $.ajax({
                                url: '{{ route('calendar.store') }}',
                                method: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    title: title,
                                    work_date: info.startStr.split(' ')[0],
                                    time: info.startStr.split(' ')[1] || '09:00:00',
                                    description: '',
                                    location: '',
                                },
                                success: function() {
                                    calendar.unselect();
                                    calendar.refetchEvents();
                                }
                            });
                        }
                    }
                    calendar.unselect();
                },
                eventColor: '#3788d8',
                eventTextColor: '#fff',
                eventBorderColor: '#3788d8',
                dayHeaderFormat: {
                    weekday: 'long'
                },
                timeFormat: 'h:mm a',
                slotMinTime: '06:00:00',
                slotMaxTime: '22:00:00',
                height: 'auto'
            });
            calendar.render();

            // Filter handlers
            $('#teamFilter, #statusFilter, #dateRangeFilter').on('change', function() {
                calendar.refetchEvents();
                // Update URL parameters
                updateUrlParams();
            });

            function showEventDetails(event) {
                var eventHtml = `
            <div class="modal fade" id="eventModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">${event.title}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Date:</strong> ${event.start.toLocaleDateString()}</p>
                            <p><strong>Time:</strong> ${event.start.toLocaleTimeString()} - ${event.end ? event.end.toLocaleTimeString() : 'N/A'}</p>
                            ${event.extendedProps.description ? `<p><strong>Description:</strong> ${event.extendedProps.description}</p>` : ''}
                            ${event.extendedProps.location ? `<p><strong>Location:</strong> ${event.extendedProps.location}</p>` : ''}
                            <p><strong>Status:</strong> ${event.extendedProps.completed ? 'Completed' : (event.extendedProps.rescheduled ? 'Rescheduled' : 'Pending')}</p>
                        </div>
                    </div>
                </div>
            </div>
        `;
                $('body').append(eventHtml);
                $('#eventModal').modal('show');
                $('#eventModal').on('hidden.bs.modal', function() {
                    $(this).remove();
                });
            }

            function updateEventDate(event, delta) {
                $.ajax({
                    url: event.extendedProps.url,
                    method: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        work_date: event.start.toISOString().split('T')[0],
                        time: event.start.toTimeString().split(' ')[0]
                    },
                    success: function() {
                        calendar.refetchEvents();
                    }
                });
            }

            function updateEventTime(event, delta) {
                // Similar to date update but for time
                $.ajax({
                    url: event.extendedProps.url,
                    method: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        time: event.start.toTimeString().split(' ')[0]
                    },
                    success: function() {
                        calendar.refetchEvents();
                    }
                });
            }

            function updateUrlParams() {
                const params = new URLSearchParams();
                if ($('#teamFilter').val()) params.append('team_id', $('#teamFilter').val());
                if ($('#statusFilter').val()) params.append('status', $('#statusFilter').val());
                if ($('#dateRangeFilter').val()) params.append('date_range', $('#dateRangeFilter').val());

                const newUrl = new URL(window.location);
                newUrl.search = params.toString();
                window.history.replaceState({}, '', newUrl);
            }
        });
    </script>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
@endpush
