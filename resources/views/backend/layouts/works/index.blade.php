@extends('backend.app')

@section('title', 'Work List')

@section('content')
    <!--app-content open-->
    <div class="app-content main-content mt-0">
        <div class="side-app">

            <div class="main-container container-fluid">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Work List</h1>
                    </div>
                    <div class="ms-auto pageheader-btn">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Employee</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Work</li>
                        </ol>
                    </div>
                </div>

                {{-- Alert message --}}
                @if (!empty($scheduleRequest) && $scheduleRequest > 0)
                    <div class="alert alert-success alert-dismissible d-flex justify-content-between align-items-center fade show"
                        role="alert">
                        <div class="d-flex align-items-center gap-2">
                            <strong>Reschedule Request</strong>
                            <span class="badge rounded-circle bg-primary text-white"
                                style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">
                                {{ $scheduleRequest }}
                            </span>
                            works have reschedule request
                            <a class="btn btn-sm btn-primary ms-2" href="{{ route('reschedule.work.list') }}">Check It
                                Out</a>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">&times;</button>
                    </div>
                @endif


                <div class="row">
                    {{-- work table section --}}
                    <div class="col-12 col-md-12 col-sm-12">
                        <div class="card box-shadow-0">
                            <div class="card-body">

                                <div class="card-header border-bottom mb-3">
                                    <div class="card-options ms-auto d-flex align-items-center gap-2">

                                        <!-- Completed Filter -->
                                        <select id="filter_completed" class="form-select form-select-sm"
                                            style="width: 180px;">
                                            <option value="">-- Completed Filter --</option>
                                            <option value="1">Completed</option>
                                            <option value="0">Not Completed</option>
                                        </select>

                                        <!-- Rescheduled Filter -->
                                        <select id="filter_rescheduled" class="form-select form-select-sm"
                                            style="width: 180px;">
                                            <option value="">-- Rescheduled Filter --</option>
                                            <option value="1">Rescheduled</option>
                                            <option value="0">Not Rescheduled</option>
                                        </select>

                                        <!-- Add Button -->
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#workModal" id="addworkBtn">
                                            Add Work
                                        </button>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table text-nowrap mb-0 table-bordered" id="datatable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>ID</th>
                                                <th>Category</th>
                                                <th>Team</th>
                                                <th>Location</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Work Date</th>
                                                <th>Completed</th>
                                                <th>Rescheduled</th>
                                                <th>Status</th>
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

    {{-- Add/Edit work Modal --}}
    <div class="modal fade" id="workModal" tabindex="-1" aria-labelledby="workModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form id="workForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="workID">

                    <div class="modal-header">
                        <h5 class="modal-title" id="workModalLabel">Create Work</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            {{-- Title --}}
                            <div class="col-md-4">
                                <div class="p-3 rounded-2 bg-light equal-box">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" name="title" id="work_title"
                                        placeholder="Enter Work Title">
                                    <span class="text-danger error-text title_error"></span>
                                </div>
                            </div>

                            {{-- Team select --}}
                            <div class="col-md-4">
                                <div class="p-3 rounded-2 bg-light equal-box">
                                    <label for="team_id">Select Team</label>
                                    <select name="team_id" id="team_id" class="form-control">
                                        <option value="">-- Select Team --</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Category --}}
                            <div class="col-md-4 mb-3">
                                <div class="p-3 rounded-2 bg-light equal-box">
                                    <label class="form-label">Select Category</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">-- Select Category --</option>
                                    </select>
                                    <input type="text" name="category_name" class="form-control mt-2"
                                        placeholder="Or create new category">
                                </div>
                            </div>


                            {{-- Description --}}
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control summernote" name="description" id="work_description" rows="4"
                                    placeholder="Enter Description"></textarea>
                                <span class="text-danger error-text description_error"></span>
                            </div>


                            {{-- Map Picker --}}
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Pick Location on Map</label>
                                <div id="map" style="height: 250px; width: 100%;"></div>
                            </div>

                            {{-- Location --}}
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Location</label>
                                <input type="text" class="form-control" name="location" id="work_location"
                                    placeholder="Work Location" readonly>
                                <span class="text-danger error-text location_error"></span>
                            </div>

                            {{-- Latitude --}}
                            <div class="col-md-3 mt-3">
                                <label class="form-label">Latitude</label>
                                <input type="text" class="form-control" name="latitude" id="work_latitude"
                                    placeholder="Latitude" readonly>
                                <span class="text-danger error-text latitude_error"></span>
                            </div>

                            {{-- Longitude --}}
                            <div class="col-md-3 mt-3">
                                <label class="form-label">Longitude</label>
                                <input type="text" class="form-control" name="longitude" id="work_longitude"
                                    placeholder="Longitude" readonly>
                                <span class="text-danger error-text longitude_error"></span>
                            </div>

                            {{-- Start Time --}}
                            <div class="col-md-4">
                                <label class="form-label">Start Time <span class="text-muted"> (24 hour format)</span>
                                </label>
                                <input type="time" class="form-control" name="start_time" id="start_time">
                                <span class="text-danger error-text start_time_error"></span>
                            </div>

                            {{-- End Time --}}
                            <div class="col-md-4">
                                <label class="form-label">End Time <span class="text-muted"> (24 hour format)</span>
                                </label>
                                <input type="time" class="form-control" name="end_time" id="end_time">
                                <span class="text-danger error-text end_time_error"></span>
                            </div>

                            {{-- End Time --}}
                            <div class="col-md-4">
                                <label class="form-label">Work Date</label>
                                <input type="date" class="form-control" name="work_date" id="work_date">
                                <span class="text-danger error-text work_date_error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="workSubmitBtn">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <style>
        #map {
            height: 250px;
        }

        .leaflet-control-geocoder-form input {
            width: 200px;
        }
    </style>

    <style>
        .equal-box {
            min-height: 110px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <script>
        // Global variables
        let map, marker, geocoder;

        // Function to initialize the map
        function initializeMap() {
            // Default to Dhaka coordinates
            const defaultLocation = [23.8103, 90.4125];

            // Initialize map
            map = L.map('map').setView(defaultLocation, 13);

            // Add OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Add marker
            marker = L.marker(defaultLocation, {
                draggable: true
            }).addTo(map);

            // Initialize geocoder
            geocoder = L.Control.Geocoder.nominatim();

            // Add search control
            L.Control.geocoder({
                defaultMarkGeocode: false,
                geocoder: geocoder,
                position: 'topright',
                placeholder: 'Search location...',
                errorMessage: 'Location not found.'
            }).on('markgeocode', function(e) {
                const {
                    center,
                    name
                } = e.geocode;
                updateLocation(center.lat, center.lng, name);
            }).addTo(map);

            // Handle marker drag
            marker.on('dragend', function() {
                const position = marker.getLatLng();
                reverseGeocode(position.lat, position.lng);
            });

            // Handle click on map
            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                reverseGeocode(e.latlng.lat, e.latlng.lng);
            });

            // Handle search box
            $('#search-button').click(function() {
                const query = $('#search-box').val();
                if (query) {
                    geocoder.geocode(query, function(results) {
                        if (results && results.length > 0) {
                            const {
                                center,
                                name
                            } = results[0];
                            updateLocation(center.lat, center.lng, name);
                        } else {
                            toastr.error('Location not found');
                        }
                    });
                }
            });

            // Also trigger search on Enter key
            $('#search-box').keypress(function(e) {
                if (e.which === 13) {
                    $('#search-button').click();
                }
            });
        }

        // Update location fields
        function updateLocation(lat, lng, address) {
            $('#work_latitude').val(lat);
            $('#work_longitude').val(lng);
            $('#work_location').val(address || '');

            // Move marker and center map
            marker.setLatLng([lat, lng]);
            map.setView([lat, lng], 15);
        }

        // Reverse geocode coordinates to get address
        function reverseGeocode(lat, lng) {
            geocoder.reverse({
                    lat: lat,
                    lng: lng
                },
                map.getZoom(),
                function(results) {
                    if (results && results.length > 0) {
                        updateLocation(lat, lng, results[0].name);
                    } else {
                        updateLocation(lat, lng, '');
                    }
                }
            );
        }

        // When modal opens
        $('#workModal').on('shown.bs.modal', function() {
            // Initialize map if not already done
            if (!map) {
                initializeMap();
            } else {
                // Reset map view if already initialized
                setTimeout(function() {
                    map.invalidateSize();
                    if (marker) {
                        map.setView(marker.getLatLng(), map.getZoom());
                    }
                }, 300);
            }
        });


        //document ready functionq
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
                    url: "{{ route('work.list') }}",
                    type: "GET",
                    data: function(d) {
                        d.is_completed = $('#filter_completed').val();
                        d.is_rescheduled = $('#filter_rescheduled').val();
                    }
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
                        data: 'category'
                    },
                    {
                        data: 'team'
                    },
                    {
                        data: 'location'
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
                        data: 'is_completed'
                    },
                    {
                        data: 'is_rescheduled'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // reload table on filter change
            $('#filter_completed, #filter_rescheduled').change(function() {
                dTable.ajax.reload();
            });



            // Open modal for new work
            $('#addworkBtn').click(function() {
                $('#workModalLabel').text('Create work');
                $('#workForm')[0].reset();
                $('#workSubmitBtn').prop('disabled', false).html('Save changes');
                $('#workID').val('');
                $('.error-text').text('');

                // reset summernote
                $('#work_description').summernote('code', '');

                // Load teams dynamically
                $.get("{{ route('team.list.work') }}", function(response) {
                    if (response.status) {
                        let options = '<option value="">-- Select Team --</option>';
                        response.data.forEach(function(team) {
                            options +=
                                `<option value="${team.id}">${team.name} (${team.unique_id})</option>`;
                        });
                        $('#team_id').html(options);
                    }
                });

                // Load category dynamically
                $.get("{{ route('work.categroy') }}", function(response) {
                    if (response.status) {
                        let options = '<option value="">-- Select Category--</option>';
                        response.data.forEach(function(category) {
                            options +=
                                `<option value="${category.id}">${category.name}</option>`;
                        });
                        $('#category_id').html(options);
                    }
                });

                $('#workModal').modal('show');
            });


            // Handle form submission
            $('#workForm').on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let id = $('#workID').val();
                let url = id ?
                    "{{ route('work.update', ':id') }}".replace(':id', id) :
                    "{{ route('work.store') }}";

                if (id) {
                    formData.append('_method', 'POST');
                }

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('span.error-text').text('');
                        $('#workSubmitBtn').prop('disabled', true).html('Processing...');
                    },
                    success: function(response) {
                        if (response.status == 0) {
                            $.each(response.errors, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                            });

                        } else {
                            $('#workModal').modal('hide');
                            $('#workForm')[0].reset();

                            toastr.success(response.message);
                            $('#datatable').DataTable().ajax.reload();
                        }
                        $('#workSubmitBtn').prop('disabled', false).html('Save changes');
                    },


                    error: function(xhr) {
                        $('#workSubmitBtn').prop('disabled', false).html('Save changes');
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

            // Edit work - Load existing data
            $(document).on('click', '.editwork', function() {
                var id = $(this).data('id');
                var url = "{{ route('work.edit', ':id') }}".replace(':id', id);

                $.get(url, function(response) {
                    $('#workModalLabel').text('Edit work');
                    $('#workID').val(response.data.id);

                    // Fill simple fields
                    $('#work_title').val(response.data.title);
                    $('#work_description').val(response.data.description);
                    $('#work_location').val(response.data.location);
                    $('#work_latitude').val(response.data.latitude);
                    $('#work_longitude').val(response.data.longitude);
                    $('#start_time').val(response.data.start_time);
                    $('#end_time').val(response.data.end_time);
                    $('#work_date').val(response.data.work_date);

                    // Set Summernote content
                    $('#work_description').summernote('reset'); // clear old content
                    $('#work_description').summernote('code', response.data.description || '');

                    // First load teams, then set selected value
                    $.get("{{ route('team.list.work') }}", function(teamResponse) {
                        if (teamResponse.status) {
                            let options = '<option value="">-- Select Team --</option>';
                            teamResponse.data.forEach(function(team) {
                                options +=
                                    `<option value="${team.id}">${team.name} (${team.unique_id})</option>`;
                            });
                            $('#team_id').html(options);

                            // Set selected team AFTER dropdown populated
                            if (response.data.team_id) {
                                $('#team_id').val(response.data.team_id);
                            }
                        }

                        // Show modal and set map if coordinates exist
                        if (response.data.latitude && response.data.longitude) {
                            const lat = parseFloat(response.data.latitude);
                            const lng = parseFloat(response.data.longitude);

                            $('#workModal').modal('show').on('shown.bs.modal', function() {
                                updateLocation(lat, lng, response.data.location);
                            });
                        } else {
                            $('#workModal').modal('show');
                        }
                    });
                });
            });
        });


        function showStatusChangeAlert(id) {
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to update the status?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    statusChange(id);
                }
            });
        }

        // Status Change
        function statusChange(id) {
            NProgress.start();
            let url = "{{ route('work.status', ':id') }}";
            $.ajax({
                type: "POST",
                url: url.replace(':id', id),
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

        // delete Confirm
        function showDeleteConfirm(id) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure you want to delete this work?',
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
            let url = "{{ route('work.delete', ':id') }}";
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
@endpush
