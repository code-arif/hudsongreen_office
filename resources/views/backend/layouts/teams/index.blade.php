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
                                                <th>ID</th>
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
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="assignEmployeeForm">
                    @csrf
                    <input type="hidden" name="team_id" id="assign_team_id">

                    <div class="modal-header">
                        <h5 class="modal-title">Assign Employees</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="user_ids">Select Employees</label>
                            <select name="user_ids[]" id="user_ids" class="form-control" multiple required
                                style="height: 300px">
                                <!-- Employees will be loaded dynamically -->
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Assign</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


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
                            data: 'unique_id',
                            name: 'unique_id'
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


    <script>
        $(document).ready(function() {

            // Open Assign Employee modal
            $(document).on('click', '.assignBtn', function() {
                let teamId = $(this).data('id');
                $('#assign_team_id').val(teamId);
                $('#user_ids').html(''); // clear previous options

                // Fetch all employees + already assigned for this team
                $.get("{{ route('assing.employee.edit', '') }}/" + teamId, function(res) {
                    if (res.status) {
                        let allUsers = res.all_users; // all employees
                        let assignedUsers = res.assigned_users.map(u => u.id); // already assigned

                        allUsers.forEach(user => {
                            let selected = assignedUsers.includes(user.id) ? 'selected' :
                                '';
                            $('#user_ids').append('<option value="' + user.id + '" ' +
                                selected + '>' + user.name + ' (' + user.unique_id +
                                ')</option>');
                        });

                        $('#assignEmployeeModal').modal('show');
                    } else {
                        toastr.error('Failed to load employees');
                    }
                });
            });

            // Submit Assign Employee form
            $('#assignEmployeeForm').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();

                $.post("{{ route('assing.employee.store') }}", formData, function(res) {
                    if (res.status) {
                        toastr.success(res.message);
                        $('#assignEmployeeModal').modal('hide');
                        $('#datatable').DataTable().ajax.reload();
                    } else {
                        toastr.error(res.message || 'Something went wrong');
                    }
                }).fail(function(xhr) {
                    if (xhr.status === 409) {
                        toastr.error(xhr.responseJSON.message);
                    } else {
                        toastr.error('Something went wrong. Try again.');
                    }
                });
            });
        });
    </script>
@endpush
