@extends('backend.app')

@section('title', 'Employee Work List')

@section('content')
    <div class="app-content main-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">

                <div class="page-header">
                    <div>
                        <h1 class="page-title"> Employee Calendar</h1>
                    </div>
                    <div class="ms-auto pageheader-btn">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Employee</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Calendar</li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
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


@endpush




@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
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
                eventBorderColor: '#1e88e5',
                eventBackgroundColor: '#2196f3',
               
                events: @json($events),
                eventClick: function(info) {
                    let desc = info.event.extendedProps.description || 'No description';
                    Swal.fire({
                        title: `<strong>${info.event.title}</strong>`,
                        html: `<small class="text-muted">Date: ${info.event.startStr}</small><br><br>${desc}`,
                        icon: 'info',
                        confirmButtonText: 'Close',
                        customClass: {
                            popup: 'rounded-3',
                            title: 'fw-bold'
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
        });
    </script>

    <!-- Optional: Add SweetAlert2 for nice popups -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
