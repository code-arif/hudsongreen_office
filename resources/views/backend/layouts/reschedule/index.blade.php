@extends('backend.app')

@section('title', 'Reschedule Reschedule List')

@section('content')
    <!--app-content open-->
    <div class="app-content main-content mt-0">
        <div class="side-app">

            <div class="main-container container-fluid">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Reschedule Reschedule List</h1>
                    </div>
                    <div class="ms-auto pageheader-btn">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Reschedule</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    {{-- reschedule table section --}}
                    <div class="col-12 col-md-12 col-sm-12">
                        <div class="card box-shadow-0">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-nowrap mb-0 table-bordered" id="datatable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>ID</th>
                                                <th>Team</th>
                                                <th>Note</th>
                                                <th>Want Start Time</th>
                                                <th>Want End Time</th>
                                                <th>Want reschedule Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
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
    <!-- CONTAINER CLOSED -->


    {{-- Add/Edit reschedule Modal --}}
    <div class="modal fade" id="rescheduleModal" tabindex="-1" aria-labelledby="rescheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form id="rescheduleForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="rescheduleID">

                    <div class="modal-header">
                        <h5 class="modal-title" id="rescheduleModalLabel">Edit Reschedule</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            {{-- Work Details (Read Only) --}}
                            <div class="col-md-12 mb-3">
                                <h6 class="fw-bold mb-3">Work Details</h6>
                                <ul class="list-group shadow-sm rounded-3">
                                    <li class="list-group-item d-flex justify-content-start align-items-center py-2">
                                        <strong style="margin-right: 10px">Title:</strong> <span id="work_title"
                                            class="text-success fw-semibold"></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-start py-2">
                                        <strong style="margin-right: 10px">Description:</strong> <span id="work_description"
                                            class="text-muted"></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-start py-2">
                                        <strong style="margin-right: 10px">Location:</strong> <span id="work_location"
                                            class="text-muted fw-semibold"></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-start py-2">
                                        <strong style="margin-right: 10px"> Start Time:</strong> <span id="work_start_time"
                                            class="badge bg-info text-dark"></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-start py-2">
                                        <strong style="margin-right: 10px">End Time:</strong> <span id="work_end_time"
                                            class="badge bg-warning text-dark"></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-start py-2">
                                        <strong style="margin-right: 10px">Work Date:</strong> <span id="work_date"
                                            class="badge bg-secondary"></span>
                                    </li>
                                </ul>
                            </div>

                            <hr class="my-3">

                            {{-- Suggested Start Time --}}
                            <div class="col-md-4">
                                <label class="form-label">Suggested Start Time</label>
                                <input type="time" class="form-control" name="suggested_start_time"
                                    id="suggested_start_time">
                                <span class="text-danger error-text suggested_start_time_error"></span>
                            </div>

                            {{-- Suggested End Time --}}
                            <div class="col-md-4">
                                <label class="form-label">Suggested End Time</label>
                                <input type="time" class="form-control" name="suggested_end_time"
                                    id="suggested_end_time">
                                <span class="text-danger error-text suggested_end_time_error"></span>
                            </div>

                            {{-- Suggested Date --}}
                            <div class="col-md-4">
                                <label class="form-label">Suggested Date</label>
                                <input type="date" class="form-control" name="suggested_work_date"
                                    id="suggested_work_date">
                                <span class="text-danger error-text suggested_work_date_error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="rescheduleSubmitBtn">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@push('scripts')
    <script>
        //document ready function
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                }
            });

            let dTable = $('#datatable').DataTable({
                order: [],
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                processing: true,
                serverSide: true,
                language: {
                    processing: `<div class="text-center">
                        <img src="{{ asset('default/loader.gif') }}" alt="Loader" style="width: 50px;">
                    </div>`
                },
                ajax: {
                    url: "{{ route('reschedule.work.list') }}",
                    type: "GET",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'id'
                    },
                    {
                        data: 'team'
                    },
                    {
                        data: 'note'
                    },
                    {
                        data: 'start_time'
                    },
                    {
                        data: 'end_time'
                    },
                    {
                        data: 'work_date'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // Handle form submission
            $('#rescheduleForm').on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let id = $('#rescheduleID').val();
                let url = "{{ route('reschedule.work.update', ':id') }}".replace(':id', id);

                formData.append('_method', 'POST');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('span.error-text').text('');
                        $('#rescheduleSubmitBtn').prop('disabled', true).html('Processing...');
                    },
                    success: function(response) {
                        if (!response.status) {
                            $.each(response.errors, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                            });
                        } else {
                            $('#rescheduleModal').modal('hide');
                            $('#rescheduleForm')[0].reset();
                            toastr.success(response.message);
                            $('#datatable').DataTable().ajax.reload();
                        }
                        $('#rescheduleSubmitBtn').prop('disabled', false).html('Save changes');
                    },
                    error: function(xhr) {
                        $('#rescheduleSubmitBtn').prop('disabled', false).html('Save changes');
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


            // Edit reschedule - Load existing data
            $(document).on('click', '.rescheduleBtn', function() {
                var id = $(this).data('id');
                var url = "{{ route('reschedule.work.edit', ':id') }}".replace(':id', id);

                $.get(url, function(response) {
                    if (response.success) {
                        $('#rescheduleModalLabel').text('Edit Reschedule');
                        // $('#rescheduleID').val(response.data.id);
                        $('#rescheduleID').val(response.data.work.id); // reschedule.id এর বদলে work.id


                        // Work details (read-only)
                        $('#work_title').text(response.data.work.title ?? '---');
                        $('#work_description').text(response.data.work.description ?? '---');
                        $('#work_location').text(response.data.work.location ?? '---');
                        $('#work_start_time').text(response.data.work.start_time ?? '---');
                        $('#work_end_time').text(response.data.work.end_time ?? '---');
                        $('#work_date').text(response.data.work.work_date ?? '---');

                        // Editable reschedule fields
                        $('#suggested_start_time').val(response.data.suggested_start_time);
                        $('#suggested_end_time').val(response.data.suggested_end_time);
                        $('#suggested_work_date').val(response.data.suggested_work_date);

                        $('#rescheduleModal').modal('show');
                    } else {
                        alert(response.message || 'Failed to load reschedule data');
                    }
                });
            });
        });
    </script>
@endpush
