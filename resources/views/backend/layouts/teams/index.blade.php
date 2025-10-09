{{-- @extends('backend.layouts.app') --}}
@extends('backend.app')

@section('title', 'Teams')

@section('content')
    <!--app-content open-->
    <div class="app-content main-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Teams List</h1>
                    </div>
                    <div class="ms-auto pageheader-btn">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Index</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Teams</li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card box-shadow-0">
                            <div class="card-body">

                                <div
                                    class="card-header border-bottom mb-3 d-flex justify-content-between align-items-center">
                                    <h4 class="mb-0">Team List</h4>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#teamModal" id="addTeamBtn">Add Team</button>
                                </div>


                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap mb-0" id="datatable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Team Name</th>
                                                <th>Description</th>
                                                <th>Users</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- DataTables AJAX data will populate here --}}
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    {{-- User Create Modal --}}
    <div class="modal fade" id="teamModal" tabindex="-1" aria-labelledby="teamModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="teamModalLabel">Add Team</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="teamForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="teamID">
                    <div class="modal-body">

                        <div class="row">
                            <!-- Name -->
                            <div class="col-12 mb-3">
                                <label for="name" class="form-label">Team Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="Enter team name">
                                <span class="text-danger error-text name_error"></span>
                            </div>


                            <!-- Desciption -->
                            <div class="col-12 mb-3">
                                <label for="password" class="form-label">Desciption </label>
                                <textarea name="description" id="description" class="form-control" placeholder="Enter team details"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveTeamBtn">Save Team</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Assign Employee Modal -->
    <div class="modal fade" id="assignEmployeeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="assignEmployeeForm">
                    @csrf
                    <input type="hidden" name="team_id" id="assign_team_id">

                    <div class="modal-header">
                        <h5 class="modal-title">Assign Employees to Team</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <!-- Selected Employees Section -->
                            <div class="col-md-6">
                                <div class="card border-primary">
                                    <div class="card-header bg-primary text-white">
                                        <h6 class="mb-0">
                                            <i class="fas fa-users"></i> Assigned Employees
                                            <span class="badge bg-light text-primary" id="selectedCount">0</span>
                                        </h6>
                                    </div>
                                    <div class="card-body" style="min-height: 350px; max-height: 350px; overflow-y: auto;">
                                        <div id="selectedEmployees">
                                            <p class="text-muted text-center mt-5">
                                                <i class="fas fa-info-circle"></i><br>
                                                No employees assigned yet.<br>
                                                Click on employees from the right to assign.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Available Employees Section -->
                            <div class="col-md-6">
                                <div class="card border-secondary">
                                    <div class="card-header bg-secondary text-white">
                                        <h6 class="mb-0">
                                            <i class="fas fa-user-plus"></i> Available Employees
                                            <span class="badge bg-light text-dark" id="availableCount">0</span>
                                        </h6>
                                    </div>
                                    <div class="card-body"
                                        style="min-height: 350px; max-height: 350px; overflow-y: auto;">
                                        <!-- Search Box -->
                                        <div class="mb-3">
                                            <input type="text" class="form-control form-control-sm"
                                                id="searchEmployee" placeholder="Search employee...">
                                        </div>
                                        <div id="availableEmployees">
                                            <!-- Employees will be loaded here -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-check"></i> Update Assignment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .employee-item {
            padding: 10px;
            margin-bottom: 8px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid #e0e0e0;
            background: #fff;
        }

        .employee-item:hover {
            background: #f8f9fa;
            border-color: #007bff;
            transform: translateX(5px);
        }

        .employee-item.selected {
            background: #e7f3ff;
            border-color: #007bff;
        }

        .selected-employee-item {
            padding: 10px 15px;
            margin-bottom: 8px;
            border-radius: 6px;
            background: #e7f3ff;
            border: 1px solid #007bff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }

        .selected-employee-item:hover {
            background: #d0e8ff;
        }

        .remove-employee {
            color: #dc3545;
            cursor: pointer;
            font-size: 18px;
            transition: all 0.2s ease;
        }

        .remove-employee:hover {
            color: #a71d2a;
            transform: scale(1.2);
        }

        .employee-name {
            font-weight: 500;
            color: #333;
        }

        .employee-id {
            font-size: 12px;
            color: #6c757d;
        }
    </style>
@endpush


@push('scripts')
    {{-- datatable and form submission --}}
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                }
            });

            if (!$.fn.DataTable.isDataTable('#datatable')) {
                let dTable = $('#datatable').DataTable({
                    order: [],
                    lengthMenu: [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "All"]
                    ],
                    processing: true,
                    // responsive: true,
                    serverSide: true,

                    language: {
                        processing: `<div class="text-center">
                        <img src="{{ asset('default/loader.gif') }}" alt="Loader" style="width: 50px;">
                        </div>`
                    },

                    scroller: {
                        loadingIndicator: false
                    },
                    pagingType: "full_numbers",
                    dom: "<'row justify-content-between table-topbar'<'col-md-4 col-sm-3'l><'col-md-5 col-sm-5 px-0'f>>tipr",

                    ajax: {
                        url: "{{ route('team.list') }}",
                        type: "GET",
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
                            data: 'description',
                            name: 'description'
                        },

                        {
                            data: 'users',
                            name: 'users'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                    ],

                });
            }

            // Open modal for new User
            $('#addTeamBtn').click(function() {
                $('#teamModalLabel').text('Create Team');
                $('#teamForm')[0].reset();
                $('#teamID').val('');
                $('.error-text').text('');

                $('#saveTeamBtn').prop('disabled', false).html('Save Team');
                $('#teamModal').modal('show');
            });


            // Handle User form submission (Create + Update)
            $('#teamForm').on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let id = $('#teamID').val();

                let url = id ?
                    "{{ route('team.update', ':id') }}".replace(':id', id) :
                    "{{ route('team.store') }}";

                if (id) {
                    formData.append('_method',
                        'POST');
                }

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('span.error-text').text('');
                        $('#teamSubmitBtn').prop('disabled', true).html('Processing...');
                    },
                    success: function(response) {
                        if (response.status == 0) {
                            $.each(response.errors, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                            });
                        } else {
                            // Success
                            $('#teamModal').modal('hide');
                            $('#teamForm')[0].reset();

                            toastr.success(response.message);
                            $('#datatable').DataTable().ajax.reload();
                        }
                        $('#teamSubmitBtn').prop('disabled', false).html('Save Team');
                    },
                    error: function(xhr) {
                        $('#saveTeamBtn').prop('disabled', false).html('Save Tram');
                        if (xhr.status === 422) {
                            $.each(xhr.responseJSON.errors, function(prefix, val) {
                                prefix = prefix.replace(/\./g, '_');
                                $('span.' + prefix + '_error').text(val[0]);
                            });
                        } else {
                            toastr.error(xhr.responseJSON.message ||
                                'Something went wrong. Please try again.');
                        }
                    }
                });
            });

            // Edit Team - Load existing data
            $(document).on('click', '.editTeam', function() {
                var id = $(this).data('id');
                var url = "{{ route('team.edit', ':id') }}".replace(':id', id);

                $.get(url, function(response) {
                    if (response.success) {
                        $('#teamModalLabel').text('Edit Team');
                        $('#teamID').val(response.data.id);

                        // Fill form fields
                        $('#name').val(response.data.name);
                        $('#description').val(response.data.description);

                        // Show modal
                        $('#teamModal').modal('show');
                    } else {
                        toastr.error('Failed to load user data!');
                    }
                }).fail(function() {
                    toastr.error('Something went wrong while loading team data.');
                });
            });
        });

        // delete Confirm
        function showDeleteConfirm(id) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure you want to delete this team?',
                text: 'If you delete this, it will be gone forever.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteItem(id);
                }
            });
        }

        // Delete Button
        function deleteItem(id) {
            NProgress.start();
            let url = "{{ route('team.delete', ':id') }}";
            let csrfToken = '{{ csrf_token() }}';
            $.ajax({
                type: "DELETE",
                url: url.replace(':id', id),
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(resp) {
                    NProgress.done();
                    toastr.success(resp.message);
                    $('#datatable').DataTable().ajax.reload();
                },
                error: function(error) {
                    NProgress.done();
                    toastr.error(error.message);
                }
            });
        }
    </script>

    {{-- Assing imployee --}}
    <script>
        $(document).ready(function() {
            let selectedEmployees = [];
            let allEmployees = [];
            let assignedEmployees = [];

            // Open Assign Employee modal
            $(document).on('click', '.assignBtn', function() {
                let teamId = $(this).data('id');
                $('#assign_team_id').val(teamId);

                // Reset
                selectedEmployees = [];
                allEmployees = [];
                assignedEmployees = [];
                $('#selectedEmployees').html(
                    '<p class="text-muted text-center mt-5"><i class="fas fa-spinner fa-spin"></i><br>Loading...</p>'
                );
                $('#availableEmployees').html('');

                // Fetch employees
                $.get("{{ route('assing.employee.edit', '') }}/" + teamId, function(res) {
                    if (res.status) {
                        allEmployees = res.all_users;
                        assignedEmployees = res.assigned_users;

                        // Pre-select already assigned employees
                        selectedEmployees = assignedEmployees.map(u => ({
                            id: u.id,
                            name: u.name,
                        }));

                        renderEmployees();
                        renderSelectedEmployees();
                        $('#assignEmployeeModal').modal('show');
                    } else {
                        toastr.error('Failed to load employees');
                    }
                }).fail(function() {
                    toastr.error('Failed to load employees');
                });
            });

            // Render available employees
            function renderEmployees(searchTerm = '') {
                let html = '';
                let availableCount = 0;

                allEmployees.forEach(employee => {
                    // Check if employee is already selected
                    let isSelected = selectedEmployees.some(e => e.id === employee.id);

                    // Check if employee matches search term
                    let matchesSearch = searchTerm === '' ||
                        employee.name.toLowerCase().includes(searchTerm.toLowerCase())

                    if (!isSelected && matchesSearch) {
                        availableCount++;
                        html += `
                    <div class="employee-item" data-id="${employee.id}" data-name="${employee.name}">
                        <div class="employee-name">${employee.name}</div>
                    </div>
                `;
                    }
                });

                if (availableCount === 0) {
                    html =
                        '<p class="text-muted text-center mt-5"><i class="fas fa-inbox"></i><br>No available employees</p>';
                }

                $('#availableEmployees').html(html);
                $('#availableCount').text(availableCount);
            }

            // Render selected employees
            function renderSelectedEmployees() {
                let html = '';

                if (selectedEmployees.length === 0) {
                    html = `
                <p class="text-muted text-center mt-5">
                    <i class="fas fa-info-circle"></i><br>
                    No employees assigned yet.<br>
                    Click on employees from the right to assign.
                </p>
            `;
                } else {
                    selectedEmployees.forEach(employee => {
                        html += `
                    <div class="selected-employee-item">
                        <div>
                            <div class="employee-name">${employee.name}</div>
                        </div>
                        <span class="remove-employee" data-id="${employee.id}" title="Remove">
                            <i class="fas fa-times-circle"></i>
                        </span>
                    </div>
                `;
                    });
                }

                $('#selectedEmployees').html(html);
                $('#selectedCount').text(selectedEmployees.length);
            }

            // Add employee to selection
            $(document).on('click', '.employee-item', function() {
                let id = $(this).data('id');
                let name = $(this).data('name');

                // Add to selected
                selectedEmployees.push({
                    id: id,
                    name: name,
                });

                // Re-render both lists
                renderEmployees($('#searchEmployee').val());
                renderSelectedEmployees();
            });

            // Remove employee from selection
            $(document).on('click', '.remove-employee', function() {
                let id = $(this).data('id');

                // Remove from selected
                selectedEmployees = selectedEmployees.filter(e => e.id !== id);

                // Re-render both lists
                renderEmployees($('#searchEmployee').val());
                renderSelectedEmployees();
            });

            // Search functionality
            $('#searchEmployee').on('keyup', function() {
                let searchTerm = $(this).val();
                renderEmployees(searchTerm);
            });

            // Submit form
            $('#assignEmployeeForm').on('submit', function(e) {
                e.preventDefault();

                if (selectedEmployees.length === 0) {
                    toastr.warning('Please select at least one employee');
                    return;
                }

                let teamId = $('#assign_team_id').val();
                let userIds = selectedEmployees.map(e => e.id);

                $.ajax({
                    url: "{{ route('assing.employee.store') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        team_id: teamId,
                        user_ids: userIds
                    },
                    success: function(res) {
                        if (res.status) {
                            toastr.success(res.message);
                            $('#assignEmployeeModal').modal('hide');
                            $('#datatable').DataTable().ajax.reload();
                        } else {
                            toastr.error(res.message || 'Something went wrong');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 409) {
                            toastr.error(xhr.responseJSON.message);
                        } else if (xhr.status === 422) {
                            toastr.error('Validation failed. Please check your selection.');
                        } else {
                            toastr.error('Something went wrong. Try again.');
                        }
                    }
                });
            });

            // Reset search when modal closes
            $('#assignEmployeeModal').on('hidden.bs.modal', function() {
                $('#searchEmployee').val('');
            });
        });
    </script>
@endpush
