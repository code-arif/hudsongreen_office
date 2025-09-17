@extends('backend.app')
@section('title', 'Schools')

@push('styles')
    <link href="{{ asset('default/datatable.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="app-content main-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">

                <!-- PAGE HEADER -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Schools</h1>
                    </div>
                    <div class="ms-auto pageheader-btn">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Schools</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Index</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE HEADER END -->

                <!-- SCHOOL LIST TABLE -->
                <div class="row">
                    <div class="col-12">
                        <div class="product-sales-main">

                            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0">School List</h3>
                                <div>
                                    <select id="statusFilter" class="form-select px-5">
                                        <option value="all">All</option>
                                        <option value="pending">Pending</option>
                                        <option value="approved">Approved</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-nowrap mb-0 table-bordered" id="schoolTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Principal</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Location</th>
                                                <th>Students</th>
                                                <th>Publish Date</th>
                                                <th>Days Left</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- END SCHOOL LIST TABLE -->

            </div>
        </div>
    </div>

    {{-- Loader --}}
    <!-- Loader Overlay -->
    <div id="ajax-loader"
        style="display:none; position:fixed; top:0; left:0;
    width:100%; height:100%; background:rgba(255,255,255,0.7);
    z-index:9999; text-align:center;">
        <img src="{{ asset('default/loader.gif') }}" alt="Loading..." style="margin-top:20%;">
    </div>


    <!-- School Details Modal -->
    <div class="modal fade" id="schoolModal" tabindex="-1" aria-labelledby="schoolModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="schoolModalLabel"><strong>School Details</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- School Information -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0">School Information</h6>
                                </div>
                                <div class="card-body">
                                    <p><strong>Name:</strong> <span id="modal-school-name"></span></p>
                                    <p><strong>Principal:</strong> <span id="modal-school-principal"></span></p>
                                    <p><strong>Email:</strong> <span id="modal-school-email"></span></p>
                                    <p><strong>Phone:</strong> <span id="modal-school-phone"></span></p>
                                    <p><strong>Address:</strong> <span id="modal-school-address"></span></p>
                                    <p><strong>Students:</strong> <span id="modal-school-students"></span></p>
                                    <p><strong>Status:</strong> <span id="modal-school-status" class="badge"></span></p>
                                </div>
                            </div>
                        </div>

                        <!-- Teacher/Contact Information -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    <h6 class="mb-0">Contact Information</h6>
                                </div>
                                <div class="card-body">
                                    <p><strong>Name:</strong> <span id="modal-teacher-name"></span></p>
                                    <p><strong>Email:</strong> <span id="modal-teacher-email"></span></p>
                                    <p><strong>Phone:</strong> <span id="modal-teacher-phone"></span></p>
                                    <p><strong>Role:</strong> <span id="modal-teacher-subject"></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                }
            });

            if (!$.fn.DataTable.isDataTable('#schoolTable')) {
                let table = $('#schoolTable').DataTable({
                    processing: true,
                    serverSide: true,
                    // responsive: true,
                    order: [],
                    lengthMenu: [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "All"]
                    ],
                    language: {
                        processing: `<div class="text-center">
                        <img src="{{ asset('default/loader.gif') }}" alt="Loader" style="width:50px;">
                        </div>`
                    },
                    ajax: {
                        url: "{{ route('schools.list') }}",
                        type: "GET",
                        data: function(d) {
                            d.status = $('#statusFilter').val();
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'principal',
                            name: 'principal'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'phone',
                            name: 'phone'
                        },
                        {
                            data: 'location',
                            name: 'location'
                        },
                        {
                            data: 'students',
                            name: 'students'
                        },
                        {
                            data: 'published_date',
                            name: 'published_date'
                        },
                        {
                            data: 'subscription_days_left',
                            name: 'subscription_days_left'
                        },
                        {
                            data: 'status',
                            name: 'status',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],
                    rawColumns: ['status', 'action']
                });

                // Filter by status
                $('#statusFilter').on('change', function() {
                    table.ajax.reload();
                });
            }

            // Handle view school button click
            $(document).on('click', '.view-school', function() {
                const schoolId = $(this).data('id');

                // Show loading state
                $('#modal-school-name').text('Loading...');
                $('#modal-school-principal').text('Loading...');
                $('#modal-school-email').text('Loading...');
                $('#modal-school-phone').text('Loading...');
                $('#modal-school-address').text('Loading...');
                $('#modal-school-students').text('Loading...');
                $('#modal-school-status').text('Loading...');
                $('#modal-teacher-name').text('Loading...');
                $('#modal-teacher-email').text('Loading...');
                $('#modal-teacher-phone').text('Loading...');
                $('#modal-teacher-subject').text('Loading...');

                // Fetch school details
                $.ajax({
                    url: "{{ route('school.show') }}",
                    type: "GET",
                    data: {
                        id: schoolId
                    },

                    beforeSend: function() {
                        // Loader show
                        $('#ajax-loader').show();
                    },

                    success: function(response) {
                        if (response.success) {
                            // Populate school information
                            $('#modal-school-name').text(response.school.name);
                            $('#modal-school-principal').text(response.school.principal_name);
                            $('#modal-school-email').text(response.school.email || '---');
                            $('#modal-school-phone').text(response.school.phone || '---');
                            $('#modal-school-address').text(
                                response.school.street_address + ', ' +
                                response.school.city + ', ' +
                                response.school.state + ' ' +
                                response.school.zip_code
                            );
                            $('#modal-school-students').text(response.school
                                .approximate_student_count || 'N/A');

                            // Set status with appropriate badge class
                            const status = response.school.status;
                            $('#modal-school-status').text(status);
                            $('#modal-school-status').removeClass(
                                'bg-success bg-warning bg-danger');

                            if (status === 'approved') {
                                $('#modal-school-status').addClass('bg-success');
                            } else if (status === 'pending') {
                                $('#modal-school-status').addClass('bg-warning');
                            } else if (status === 'cancelled') {
                                $('#modal-school-status').addClass('bg-danger');
                            }

                            // Populate teacher/contact information if available
                            if (response.school.contact) {
                                $('#modal-teacher-name').text(response.school.contact.name ||
                                    '---');
                                $('#modal-teacher-email').text(response.school.contact.email ||
                                    '---');
                                $('#modal-teacher-phone').text(response.school.contact.phone ||
                                    '---');
                                $('#modal-teacher-subject').text(response.school.contact.role ||
                                    '---');
                            } else {
                                $('#modal-teacher-name').text(
                                    'No contact information available');
                                $('#modal-teacher-email').text('---');
                                $('#modal-teacher-phone').text('---');
                                $('#modal-teacher-subject').text('---');
                            }

                            // Show the modal
                            $('#schoolModal').modal('show');
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        alert('Error fetching school details');
                        console.error(xhr);
                    },

                    // Loader hide always (success or error)
                    complete: function() {
                        $('#ajax-loader').hide();
                    }
                });
            });


            // Handle school status
            $(document).on('click', '.change-status', function(e) {
                e.preventDefault();

                let id = $(this).data('id');
                let status = $(this).data('status');
                let button = $(this);

                // SweetAlert confirmation
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to change status to '" + status + "'.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, change it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading state on button
                        button.html('<i class="fas fa-spinner fa-spin"></i>');

                        $.ajax({
                            url: '{{ route('school.status', '') }}/' + id,
                            type: 'POST',
                            data: {
                                status: status,
                                _token: '{{ csrf_token() }}'
                            },

                            // Loader show
                            beforeSend: function() {
                                $('#ajax-loader').show();
                            },

                            success: function(res) {
                                if (res.success) {
                                    toastr.success(res.message);
                                    $('#schoolTable').DataTable().ajax.reload(null,
                                        false);
                                } else {
                                    toastr.error(res.message);
                                    button.closest('.dropdown-menu')
                                        .find('.dropdown-toggle')
                                        .dropdown('toggle');
                                }
                            },
                            error: function(xhr) {
                                if (xhr.status === 404) {
                                    toastr.error(
                                        "Route not found. Please check your route configuration."
                                    );
                                } else {
                                    toastr.error("Failed to update status.");
                                }
                                console.error(xhr);
                            },
                            complete: function() {
                                // Reset button text
                                button.html(status.charAt(0).toUpperCase() + status
                                    .slice(1));

                                // Loader hide always (success or error)
                                $('#ajax-loader').hide();
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
