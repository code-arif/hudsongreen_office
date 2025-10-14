@extends('backend.app')

@section('title', 'Work Calendar')

@section('content')
    <style>
        .calendar-wrapper {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .fc {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .fc-toolbar-title {
            font-size: 1.5rem !important;
            font-weight: 600 !important;
            color: #1a202c;
        }

        .fc-button {
            background: #fff !important;
            border: 1px solid #e2e8f0 !important;
            color: #4a5568 !important;
            text-transform: capitalize !important;
            padding: 0.5rem 1rem !important;
            border-radius: 6px !important;
            font-weight: 500 !important;
        }

        .fc-button:hover {
            background: #f7fafc !important;
            border-color: #cbd5e0 !important;
        }

        .fc-button-active {
            background: #3b82f6 !important;
            color: #fff !important;
            border-color: #3b82f6 !important;
        }

        .fc-event {
            border-radius: 4px;
            padding: 2px 4px;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .fc-event:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        .fc-daygrid-day-number {
            color: #4a5568;
            font-weight: 500;
        }

        .fc-day-today {
            background-color: #eff6ff !important;
        }

        .filter-card {
            background: #fff;
            border-radius: 12px;
            padding: 1rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
        }

        .badge-connected {
            background: #10b981;
            color: white;
            padding: 0.20rem 0.75rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-disconnected {
            background: #ef4444;
            color: white;
            padding: 0.20rem 0.75rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .modal-content {
            border-radius: 12px;
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 12px 12px 0 0;
            padding: 1.5rem;
        }

        .modal-body {
            padding: 2rem;
        }

        .form-label {
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 0.5rem;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            padding: 0.625rem 0.875rem;
            transition: all 0.2s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            padding: 0.625rem 1.25rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .sync-status {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.50rem 1rem;
            background: #f8fafc;
            border-radius: 8px;
            margin-top: 1rem;
        }

        .event-detail-item {
            display: flex;
            align-items: start;
            gap: 0.75rem;
            padding: 0.75rem;
            border-left: 3px solid #e2e8f0;
            margin-bottom: 0.5rem;
            background: #f8fafc;
            border-radius: 0 8px 8px 0;
        }

        .event-detail-item i {
            color: #667eea;
            margin-top: 0.25rem;
        }
    </style>

    <div class="app-content main-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <!-- PAGE HEADER -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="page-title mb-0">
                                <i class="fas fa-calendar-alt me-2 text-primary"></i>
                                Work Schedule Calendar
                            </h3>
                            <p class="text-muted mt-2">Manage and organize your team's work schedule</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createWorkModal">
                                <i class="fas fa-plus me-2"></i>Create Event
                            </button>
                        </div>
                    </div>
                </div>

                <!-- FILTERS & SYNC STATUS -->
                <div class="filter-card">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <label class="form-label">Team</label>
                            <select id="teamFilter" class="form-select form-select-sm">
                                <option value="">All Teams</option>
                                @foreach ($teams as $team)
                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select id="statusFilter" class="form-select form-select-sm">
                                <option value="">All Status</option>
                                <option value="completed">Completed</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Category</label>
                            <select id="categoryFilter" class="form-select form-select-sm">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Google Calendar</label>
                            <div class="d-flex gap-2">
                                @if ($isGoogleConnected)
                                    <button class="btn btn-success btn-sm flex-grow-1" id="syncGoogleBtn">
                                        <i class="fas fa-sync me-1"></i>Sync
                                    </button>
                                    <a href="{{ route('google.disconnect') }}" class="btn btn-outline-danger btn-sm">
                                        <i class="fas fa-unlink"></i>
                                    </a>
                                @else
                                    <a href="{{ route('google.redirect') }}" class="btn btn-primary btn-sm flex-grow-1">
                                        <i class="fab fa-google me-1"></i>Connect Google
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="sync-status">
                        <i class="fas fa-info-circle text-primary"></i>
                        <span class="text-muted">
                            Google Calendar Status:
                            @if ($isGoogleConnected)
                                <span class="badge-connected">Connected</span>
                            @else
                                <span class="badge-disconnected">Not Connected</span>
                            @endif
                        </span>
                    </div>
                </div>

                <!-- CALENDAR -->
                <div class="calendar-wrapper">
                    <div id="calendar" style="padding: 1.5rem;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- CREATE/EDIT WORK MODAL -->
    <div class="modal fade" id="createWorkModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">
                        <i class="fas fa-calendar-plus me-2"></i>Create New Work Schedule
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="workForm">
                        <input type="hidden" id="workId" name="work_id">
                        <input type="hidden" name="_method" id="formMethod" value="POST">

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-heading me-1"></i>Title *
                                </label>
                                <input type="text" class="form-control" name="title" id="title" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-align-left me-1"></i>Description
                                </label>
                                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-calendar me-1"></i>Date *
                                </label>
                                <input type="date" class="form-control" name="work_date" id="work_date" required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-clock me-1"></i>Start Time *
                                </label>
                                <input type="time" class="form-control" name="time" id="time" required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-clock me-1"></i>End Time
                                </label>
                                <input type="time" class="form-control" name="end_time" id="end_time">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-map-marker-alt me-1"></i>Location
                                </label>
                                <input type="text" class="form-control" name="location" id="location">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-users me-1"></i>Team
                                </label>
                                <select class="form-select" name="team_id" id="team_id">
                                    <option value="">Select Team</option>
                                    @foreach ($teams as $team)
                                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-tag me-1"></i>Category
                                </label>
                                <select class="form-select" name="category_id" id="category_id">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-sticky-note me-1"></i>Note
                                </label>
                                <textarea class="form-control" name="note" id="note" rows="2"></textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_completed"
                                        id="is_completed">
                                    <label class="form-check-label" for="is_completed">
                                        Mark as Completed
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_rescheduled"
                                        id="is_rescheduled">
                                    <label class="form-check-label" for="is_rescheduled">
                                        Mark as Rescheduled
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveWorkBtn">
                        <i class="fas fa-save me-2"></i>Save Work
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- VIEW EVENT DETAILS MODAL -->
    <div class="modal fade" id="viewEventModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-info-circle me-2"></i>Event Details
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="eventDetailsContent">
                    <!-- Event details will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning" id="editEventBtn">
                        <i class="fas fa-edit me-1"></i>Edit
                    </button>
                    <button type="button" class="btn btn-danger" id="deleteEventBtn">
                        <i class="fas fa-trash me-1"></i>Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <!-- FullCalendar -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            let currentEventId = null;

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                buttonText: {
                    today: 'Today',
                    month: 'Month',
                    week: 'Week',
                    day: 'Day',
                    list: 'List'
                },
                editable: true,
                selectable: true,
                selectMirror: true,
                dayMaxEvents: true,
                weekends: true,
                height: 'auto',
                events: {
                    url: '{{ route('calendar.events') }}',
                    method: 'GET',
                    extraParams: function() {
                        return {
                            team_id: $('#teamFilter').val(),
                            status: $('#statusFilter').val(),
                            category_id: $('#categoryFilter').val()
                        };
                    },
                    failure: function() {
                        showToast('Failed to load events', 'error');
                    }
                },
                eventClick: function(info) {
                    info.jsEvent.preventDefault();
                    showEventDetails(info.event);
                },
                select: function(info) {
                    openCreateModal(info.startStr);
                },
                eventDrop: function(info) {
                    updateEventDate(info.event);
                },
                eventResize: function(info) {
                    updateEventDate(info.event);
                }
            });

            calendar.render();

            // Filter change handlers
            $('#teamFilter, #statusFilter, #categoryFilter').on('change', function() {
                calendar.refetchEvents();
            });

            // Open create modal
            function openCreateModal(date = null) {
                $('#modalTitle').html('<i class="fas fa-calendar-plus me-2"></i>Create New Work Schedule');
                $('#workForm')[0].reset();
                $('#workId').val('');
                $('#formMethod').val('POST');

                if (date) {
                    $('#work_date').val(date);
                } else {
                    $('#work_date').val(new Date().toISOString().split('T')[0]);
                }

                $('#time').val('09:00');
                $('#createWorkModal').modal('show');
            }

            // Show event details
            function showEventDetails(event) {
                currentEventId = event.id;
                const props = event.extendedProps;

                const startDate = new Date(event.start);
                const endDate = event.end ? new Date(event.end) : null;

                const statusBadge = props.completed ?
                    '<span class="badge bg-success">Completed</span>' :
                    (props.rescheduled ? '<span class="badge bg-warning">Rescheduled</span>' :
                        '<span class="badge bg-primary">Pending</span>');

                let detailsHtml = `
            <div class="event-detail-item">
                <i class="fas fa-heading"></i>
                <div>
                    <strong>Title:</strong><br>
                    ${event.title}
                </div>
            </div>

            <div class="event-detail-item">
                <i class="fas fa-calendar"></i>
                <div>
                    <strong>Date & Time:</strong><br>
                    ${startDate.toLocaleDateString()} at ${startDate.toLocaleTimeString()}
                    ${endDate ? ' - ' + endDate.toLocaleTimeString() : ''}
                </div>
            </div>

            <div class="event-detail-item">
                <i class="fas fa-flag"></i>
                <div>
                    <strong>Status:</strong><br>
                    ${statusBadge}
                </div>
            </div>
        `;

                if (event.extendedProps.description) {
                    detailsHtml += `
                <div class="event-detail-item">
                    <i class="fas fa-align-left"></i>
                    <div>
                        <strong>Description:</strong><br>
                        ${event.extendedProps.description}
                    </div>
                </div>
            `;
                }

                if (event.extendedProps.location) {
                    detailsHtml += `
                <div class="event-detail-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <strong>Location:</strong><br>
                        ${event.extendedProps.location}
                    </div>
                </div>
            `;
                }

                if (props.team) {
                    detailsHtml += `
                <div class="event-detail-item">
                    <i class="fas fa-users"></i>
                    <div>
                        <strong>Team:</strong><br>
                        ${props.team}
                    </div>
                </div>
            `;
                }

                if (props.category) {
                    detailsHtml += `
                <div class="event-detail-item">
                    <i class="fas fa-tag"></i>
                    <div>
                        <strong>Category:</strong><br>
                        ${props.category}
                    </div>
                </div>
            `;
                }

                if (props.note) {
                    detailsHtml += `
                <div class="event-detail-item">
                    <i class="fas fa-sticky-note"></i>
                    <div>
                        <strong>Note:</strong><br>
                        ${props.note}
                    </div>
                </div>
            `;
                }

                $('#eventDetailsContent').html(detailsHtml);
                $('#viewEventModal').modal('show');
            }

            // Edit event
            $('#editEventBtn').on('click', function() {
                $('#viewEventModal').modal('hide');
                loadEventForEdit(currentEventId);
            });

            // Load event for editing
            function loadEventForEdit(eventId) {
                $.ajax({
                    url: `/calendar/${eventId}`,
                    method: 'GET',
                    success: function(work) {
                        $('#modalTitle').html('<i class="fas fa-edit me-2"></i>Edit Work Schedule');
                        $('#workId').val(work.id);
                        $('#formMethod').val('PUT');
                        $('#title').val(work.title);
                        $('#description').val(work.description);
                        $('#work_date').val(work.work_date);
                        $('#time').val(work.time);

                        if (work.end_datetime) {
                            const endTime = new Date(work.end_datetime).toTimeString().split(' ')[0]
                                .substring(0, 5);
                            $('#end_time').val(endTime);
                        }

                        $('#location').val(work.location);
                        $('#team_id').val(work.team_id);
                        $('#category_id').val(work.category_id);
                        $('#note').val(work.note);
                        $('#is_completed').prop('checked', work.is_completed);
                        $('#is_rescheduled').prop('checked', work.is_rescheduled);

                        $('#createWorkModal').modal('show');
                    },
                    error: function() {
                        showToast('Failed to load work details', 'error');
                    }
                });
            }

            // Save work
            $('#saveWorkBtn').on('click', function() {
                const workId = $('#workId').val();
                const method = $('#formMethod').val();
                const url = workId ? `/calendar/${workId}` : '{{ route('calendar.store') }}';

                const formData = {
                    _token: '{{ csrf_token() }}',
                    title: $('#title').val(),
                    description: $('#description').val(),
                    work_date: $('#work_date').val(),
                    time: $('#time').val(),
                    end_time: $('#end_time').val(),
                    location: $('#location').val(),
                    team_id: $('#team_id').val(),
                    category_id: $('#category_id').val(),
                    note: $('#note').val(),
                    is_completed: $('#is_completed').is(':checked') ? 1 : 0,
                    is_rescheduled: $('#is_rescheduled').is(':checked') ? 1 : 0
                };

                if (method === 'PUT') {
                    formData._method = 'PUT';
                }

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#createWorkModal').modal('hide');
                        calendar.refetchEvents();
                        showToast(response.message, 'success');
                    },
                    error: function(xhr) {
                        showToast('Failed to save work', 'error');
                    }
                });
            });

            // Delete event
            $('#deleteEventBtn').on('click', function() {
                if (confirm('Are you sure you want to delete this work schedule?')) {
                    $.ajax({
                        url: `/calendar/${currentEventId}`,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $('#viewEventModal').modal('hide');
                            calendar.refetchEvents();
                            showToast(response.message, 'success');
                        },
                        error: function() {
                            showToast('Failed to delete work', 'error');
                        }
                    });
                }
            });

            // Update event date/time via drag
            function updateEventDate(event) {
                const startDate = new Date(event.start);
                const endDate = event.end ? new Date(event.end) : null;

                $.ajax({
                    url: `/calendar/${event.id}`,
                    method: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        work_date: startDate.toISOString().split('T')[0],
                        time: startDate.toTimeString().split(' ')[0],
                        end_time: endDate ? endDate.toTimeString().split(' ')[0] : null
                    },
                    success: function(response) {
                        showToast('Event updated successfully', 'success');
                    },
                    error: function() {
                        showToast('Failed to update event', 'error');
                        calendar.refetchEvents();
                    }
                });
            }

            // Sync from Google Calendar
            $('#syncGoogleBtn').on('click', function() {
                const btn = $(this);
                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i>Syncing...');

                $.ajax({
                    url: '{{ route('google.sync') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        start: calendar.view.activeStart.toISOString(),
                        end: calendar.view.activeEnd.toISOString()
                    },

                    success: function(response) {
                        console.log(response);
                        calendar.refetchEvents();
                        showToast(response.message, 'success');
                    },
                    error: function(xhr) {
                        showToast(xhr.responseJSON?.message || 'Failed to sync', 'error');
                    },
                    complete: function() {
                        btn.prop('disabled', false).html(
                        '<i class="fas fa-sync me-1"></i>Sync');
                    }
                });
            });

            // Toast notification function
            function showToast(message, type = 'info') {
                const bgColor = type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#3b82f6';
                const icon = type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' :
                    'info-circle';

                const toast = $(`
            <div class="toast-notification" style="position: fixed; top: 20px; right: 20px; background: ${bgColor}; color: white; padding: 1rem 1.5rem; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.2); z-index: 9999; display: flex; align-items: center; gap: 0.75rem;">
                <i class="fas fa-${icon}"></i>
                <span>${message}</span>
            </div>
        `);

                $('body').append(toast);

                setTimeout(() => {
                    toast.fadeOut(300, function() {
                        $(this).remove();
                    });
                }, 3000);
            }
        });
    </script>

    @if (session('success'))
        <script>
            setTimeout(() => {
                showToast('{{ session('success') }}', 'success');
            }, 100);
        </script>
    @endif

    @if (session('error'))
        <script>
            setTimeout(() => {
                showToast('{{ session('error') }}', 'error');
            }, 100);
        </script>
    @endif
@endpush
