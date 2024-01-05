@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')

    <div class="container-fluid flex-grow-1 container-p-y">
        <div style="display: flex; justify-content: space-between; align-items: center;" class="mb-3">
            <h4 class="fw-bold py-1 mb-2">
                <span class="text-muted fw-light"> - /</span> Approval
            </h4>

        </div>

        <!-- DataTable with Buttons -->
        <div class="row">
            <div class="col-md-12">
                <div class="card p-4">

                    <div class="table-responsive text-nowrap pt-3" style="height: 700px;">
                        <table class="table table-responsive table-striped table-hover" id="datatable"
                            style="font-size: 11px;">
                            <thead>

                                <tr style="text-align: center;">

                                    <th>#</th>
                                    <th>Sparepart Name</th>
                                    <th>Sparepart No</th>
                                    <th>Last Interval</th>
                                    <th>Next Estimate interval</th>
                                    <th>Last Maintenance</th>
                                    <th>Maintenance Status</th>
                                    <th>Approval</th>
                                </tr>
                            </thead>

                            <tbody id="collapseExample">
                                @foreach ($approval as $item)
                                    @foreach ($item['listmachine'] as $machine)
                                        <td hidden> {{ $machine['machine_id'] }}</td>
                                        <td colspan="9"> {{ $machine['machine_name'] }}</td>

                                        <tr style="text-align: center;">
                                            @foreach ($item['pmd'] as $x)
                                                @if ($machine->machine_id == $x->machine_id)
                                                    @foreach ($x['pmDetail'] as $y)
                                                        @if ($x->id == $y->hdr_id)
                                                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                                                            <td hidden> {{ $x['id'] }}</td>
                                                            <td hidden> {{ $y['id'] }}</td>
                                                            <td hidden> {{ $x['sparepart_id'] }}</td>
                                                            @foreach ($item['sparepart'] as $s)
                                                                @if ($x->sparepart_id == $s->id)
                                                                    <td style="text-align: center;"> {{ $s['item_name'] }}
                                                                    </td>
                                                                    <td style="text-align: center;">
                                                                        {{ $s['spare_part_no'] }}</td>
                                                                @endif
                                                            @endforeach
                                                            <td style="text-align: center;"> {{ $x['last_interval'] }}</td>
                                                            <td style="text-align: center;">
                                                                {{ $x['next_interval_estimate'] }}</td>
                                                            <td style="text-align: center;"> {{ $x['last_maintenance'] }}
                                                            </td>
                                                            <td style="text-align: center;"> {{ $y['maintenance_status'] }}
                                                            </td>

                                                            <td style="text-align: center;">
                                                                <button type="button"
                                                                    class="btn btn-primary btn-xs btn-edit  open-modal"
                                                                    data-machine-id="{{ $machine['machine_id'] }}"
                                                                    data-pm-hdr-id="{{ $x['id'] }}"
                                                                    data-pm-detail-id="{{ $y['id'] }}"
                                                                    data-sparepart-id="{{ $x['sparepart_id'] }}"
                                                                    data-sparepart-no="{{ $s['spare_part_no'] }}"
                                                                    data-sparepart-name="{{ $s['item_name'] }}"
                                                                    data-last-interval="{{ $x['last_interval'] }}"
                                                                    data-last-maintenance="{{ $x['last_maintenance'] }}"
                                                                    data-maintenance-status="{{ $y['maintenance_status'] }}"
                                                                    data-indication="{{ $y['indication'] }}"
                                                                    data-problem="{{ $y['problem_solv'] }}"
                                                                    data-checking="{{ $y['checking_result'] }}"
                                                                    data-remaks="{{ $y['remaks'] }}">

                                                                    <i class="fa fa-edit"></i>
                                                                </button>

                                                            </td>
                                                        @endif


                                        </tr>
                                    @endforeach
                                @endif
                                @endforeach
                                @endforeach
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- Extra Large Modal -->
    <div class="modal fade" id="exLargeModal" tabindex="-1" aria-hidden="true" \>
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">

                <form id="form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel4">Form Approval</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6 class="text-muted">Filled Pills</h6>
                        <div class="nav-align-top mb-4">
                            <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                                <li class="nav-item">
                                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                        data-bs-target="#navs-pills-justified-home"
                                        aria-controls="navs-pills-justified-home" aria-selected="true">
                                        <i class="tf-icons ti ti-home ti-xs me-1"></i> Sparepart Detail
                                        <span
                                            class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger ms-1">3</span>
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                        data-bs-target="#navs-pills-justified-profile"
                                        aria-controls="navs-pills-justified-profile" aria-selected="false">
                                        <i class="tf-icons ti ti-user ti-xs me-1"></i> Maintenance Detail
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                        data-bs-target="#navs-pills-justified-messages"
                                        aria-controls="navs-pills-justified-messages" aria-selected="false">
                                        <i class="tf-icons ti ti-message-dots ti-xs me-1"></i> Documentations
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="row">

                                                <label class="col-sm-4 col-form-label text-sm-end"
                                                    for="collapsible-fullname">ItemID Mysamin</label>
                                                <div class="col-sm-8">

                                                    {{-- <input type="hidden" name="last_interval" id=""
                                                        value="{{ $machine['prkserver']->actualrun_hour }}"> --}}

                                                    {{-- <input type="hidden" name="machine_id" id="machine_id"
                                                        value="{{ $machine['machine_id'] }}"> --}}
                                                    <input type="text" id="item_id" class="form-control"
                                                        placeholder="ID From MySamIn" readonly />
                                                    <input type="hidden" name="machine_id" id="machine_id">
                                                    <input type="hidden" name="hdr_id" id="hdr_id">
                                                    <input type="hidden" name="dtl_id" id="dtl_id">
                                                    <input type="hidden" name="sparepart_id" id="sparepart_id">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <label class="col-sm-4 col-form-label text-sm-end"
                                                    for="collapsible-phone">Sparepart No</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="spare_part_no"
                                                        class="form-control phone-mask" placeholder=""
                                                        aria-label="658 799 8941" readonly />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <label class="col-sm-4 col-form-label text-sm-end"
                                                    for="collapsible-address">Sparepart Name</label>
                                                <div class="col-sm-8">
                                                    <textarea class="form-control" id="item_name" rows="4" placeholder="" readonly></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <div class="row">
                                                    <label class="col-sm-4 col-form-label text-sm-end"
                                                        for="collapsible-pincode">Doc No</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="doc_no" class="form-control"
                                                            placeholder="" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <label class="col-sm-4 col-form-label text-sm-end"
                                                        for="collapsible-landmark">Interval (H)</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="interval" class="form-control"
                                                            placeholder="" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <label class="col-sm-4 col-form-label text-sm-end"
                                                    for="collapsible-city">Last Invterval (H)</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="last_interval" class="form-control"
                                                        placeholder="" readonly />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <label class="col-sm-4 col-form-label text-sm-end"
                                                    for="collapsible-state">Last Maintenance</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="last_maintenance" class="form-control"
                                                        placeholder="" readonly />
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">

                                    <div class="row g-3 ps-4 pe-4">

                                        <div class="col-md-6">
                                            <label class="form-label" for="multicol-first-name">Maintenance
                                                Type</label>
                                            <select id="collapsible-state" class="select2 form-select"
                                                data-allow-clear="true" name="maintenance_status">
                                                <option value="">Select</option>
                                                <option>Change</option>
                                                <option>Check</option>
                                                <option>Delime</option>
                                                <option>Lubricate</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="multicol-first-name">Maintenance
                                                Date</label>
                                            <input type="date" id="maintenance_date" name="maintenance_date"
                                                class="form-control" value="{{ date('Y-m-d H:i:s') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="multicol-first-name">Indication Of
                                                Damage</label>
                                            <textarea name="indication" class="form-control" id="indication" rows="2" placeholder="Indicatio of Damage"></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="multicol-first-name">Problem
                                                Solving</label>
                                            <textarea name="problem_solv" class="form-control" id="problem_solv" rows="2" placeholder="Remarks"></textarea>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label" for="multicol-first-name">Checking
                                                Result</label>
                                            <div class="row">
                                                <div class="col-md mb-md-0 mb-2">
                                                    <div class="form-check custom-option custom-option-icon">
                                                        <label class="form-check-label custom-option-content"
                                                            for="customRadioIcon1">
                                                            <span class="custom-option-body">
                                                                <i class="ti ti-circle-check"></i>
                                                                {{-- <span class="custom-option-title">Ok</span> --}}
                                                                <small>spare parts in good condition</small>
                                                            </span>
                                                            <input name="customRadioIcon" class="form-check-input"
                                                                type="radio" value="" id="customRadioIcon1"
                                                                checked />
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md mb-md-0 mb-2">
                                                    <div class="form-check custom-option custom-option-icon">
                                                        <label class="form-check-label custom-option-content"
                                                            for="customRadioIcon2">
                                                            <span class="custom-option-body">
                                                                <i class="ti ti-circle-x"></i>
                                                                {{-- <span class="custom-option-title">Bad</span> --}}
                                                                <small>spare parts in bad condition</small>
                                                            </span>
                                                            <input name="customRadioIcon" class="form-check-input"
                                                                type="radio" value="" id="customRadioIcon2" />
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="navs-pills-justified-messages" role="tabpanel">
                                    <div class="col-md-8 mb-2">
                                        <div class="row">
                                            <label class="col-sm-4 col-form-label text-sm-end"
                                                for="collapsible-fullname">Upload Image</label>
                                            <div class="col-sm-8">
                                                <input type="file" value="" class="form-control" multiple>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <label class="col-sm-4 col-form-label text-sm-end"
                                                for="collapsible-fullname">Description</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" id="collapsible-address" rows="2" placeholder="Remarks"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary"
                            onclick="performAction('approve')">Approval</button>
                        <button type="button" class="btn btn-primary" onclick="performAction('reject')">Reject</button>
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.open-modal').on('click', function() {

                var machineId = $(this).data('machine-id');
                var pmHdrlId = $(this).data('pm-hdr-id');
                var pmDetailId = $(this).data('pm-detail-id');
                var sparepartId = $(this).data('sparepart-id');
                var sparepartName = $(this).data('sparepart-name');
                var sparepartNo = $(this).data('sparepart-no');
                var lastInterval = $(this).data('last-interval');
                var maintenancelast = $(this).data('last-maintenance');
                var maintenanceStatus = $(this).data('maintenance-status');
                var indication = $(this).data('indication');
                var problem = $(this).data('problem');
                var checking = $(this).data('checking');
                var remaks = $(this).data('remaks');


                // alert(sparepartNo);

                // Populate the modal with the values
                $('#machine_id').val(machineId);
                $('#hdr_id').val(pmHdrlId);
                $('#dtl_id').val(pmDetailId);
                $('#sparepart_id').val(sparepartId);
                $('#spare_part_no').val(sparepartNo);
                $('#item_name').val(sparepartName);
                $('#last_interval').val(lastInterval);

                $('#last_maintenance').val(maintenancelast);
                $('#collapsible-state').val(maintenanceStatus);
                $('#indication').val(indication);
                $('#problem_solv').val(problem);
                $('#checking').val(checking);
                $('#remaks').val(remaks);




                // Open the modal 
                $('#exLargeModal').modal('show');

            });

        });



        function performAction(action) {

            var machineId = $('#machine_id').val();
            var hdrId = $('#hdr_id').val();
            var dtlId = $('#dtl_id').val();
            var sparepartId = $('#sparepart_id').val();


            var formData = {
                machine_id: machineId,
                hdr_id: hdrId,
                dtl_id: dtlId,
                sparepart_id: sparepartId,
                action: action

            }
            console.log(formData);
            swAlertConfirm('{{ route('approval.store') }}', undefined, undefined, formData);
            // Hide the modal
            $('#exLargeModal').modal('hide');
            resetModalData()
        }

        function resetModalData() {
            $('#collapsible-state').val('');
            $('#maintenance_date').val('');
            $('#indication').val('');
            $('#problem_solv').val('');
            $('#checking_result').val('');
            $('#remarks').val('');
        }

        function Reject() {

            var machineId = $('#machine_id').val();
            var hdrId = $('#hdr_id').val();
            var dtlId = $('#dtl_id').val();
            var sparepartId = $('#sparepart_id').val();


            var formData = {
                machine_id: machineId,
                hdr_id: hdrId,
                dtl_id: dtlId,
                sparepart_id: sparepartId
            }
            console.log(formData);
            swAlertConfirm('{{ route('approval.store') }}', undefined, undefined, formData);
            // Hide the modal
            $('#exLargeModal').modal('hide');
        }
    </script>



@endsection
