<div class="modal fade" id="WorkRescheduleModal" tabindex="-1" aria-labelledby="WorkRescheduleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="WorkRescheduleForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="workRescheduleID">

                <div class="modal-header">
                    <h5 class="modal-title" id="WorkRescheduleModalLabel">Edit Reschedule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        {{-- Work Details (Read Only) --}}
                        <div class="col-md-12 mb-3">
                            <h6 class="fw-bold mb-3">Work Details</h6>
                            <ul class="list-group shadow-sm rounded-3">
                                <li class="list-group-item d-flex justify-content-start align-items-center py-2">
                                    <strong style="margin-right: 10px">Title:</strong> <span id="work_reschedule_title"
                                        class="text-success fw-semibold"></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-start py-2">
                                    <strong style="margin-right: 10px">Description:</strong> <span
                                        id="work_reschedule_description" class="text-muted"></span>
                                </li>

                                {{-- clickable location --}}
                                <li class="list-group-item d-flex justify-content-start py-2">
                                    <strong style="margin-right: 10px">Location:</strong>
                                    <a href="#" target="_blank" id="work_reschedule_location_link"
                                        class="text-primary fw-semibold text-decoration-underline">
                                        <span id="work_reschedule_location">---</span>
                                    </a>
                                </li>

                                <li class="list-group-item d-flex justify-content-start py-2">
                                    <strong style="margin-right: 10px"> Time:</strong> <span id="work_reschedule_time"
                                        class="badge bg-info text-dark"></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-start py-2">
                                    <strong style="margin-right: 10px">Work Date:</strong> <span
                                        id="work_reschedule_date" class="badge bg-secondary"></span>
                                </li>
                            </ul>
                        </div>

                        <hr class="my-3">

                        {{-- Suggested Time --}}
                        <div class="col-md-6">
                            <label class="form-label">Suggested Time</label>
                            <input type="time" class="form-control" name="time" id="suggested_time">
                            <span class="text-danger error-text time_error"></span>
                        </div>

                        {{-- Suggested Date --}}
                        <div class="col-md-6">
                            <label class="form-label">Suggested Date</label>
                            <input type="date" class="form-control" name="suggested_work_date"
                                id="suggested_work_date">
                            <span class="text-danger error-text suggested_date_error"></span>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="workRescheduleSubmitBtn">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
