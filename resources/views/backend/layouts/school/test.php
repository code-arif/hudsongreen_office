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
                        searchable: false,
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'principal',
                        name: 'principal',
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
                        name: 'location',
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
    });
</script>
@endpush
