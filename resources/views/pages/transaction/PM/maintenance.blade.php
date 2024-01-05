@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')

    <div class="container-fluid flex-grow-1 container-p-y">
        <div style="display: flex; justify-content: space-between; align-items: center;" class="mb-3">
            <h4 class="fw-bold py-1 mb-2">
                <span class="text-muted fw-light">Maintenance /</span> Preventive Maintenance
            </h4>
        </div>

        @php
            $runHours = $prkserver->actualrun_hour;
            $sparepartNotReady = $sparepartNotReady ?? [];
        @endphp

        @php $totalWarning = 0; @endphp

        @foreach ($listSparepart as $key => $item)
            @if (isset($item->pmHeader['pmIntervalDetail']))
                @foreach ($item->pmHeader['pmIntervalDetail'] as $detailKey => $detail)
                    @php
                        $last_interval = $detail->last_interval ?? 0;
                        $next_interval = $detail->last_interval + $detail->interval;
                        $remaining_time = $prkserver->actualrun_hour - $next_interval;
                        $is_warning = $remaining_time > 0 ? true : false;
                        
                        if ($is_warning) {
                            $warning = 'warning';
                            $totalWarning++;
                        }
                    @endphp
                @endforeach
            @endif
        @endforeach

        {!! showAlert('danger', $totalWarning . ' Sparepart Jatuh Tempo Interval') !!}

        <div class="row mb-4">
            <div class="col-12 col-xl-7 col-md-6">
                <div class="card h-100">
                    <div class="card-header pb-0 d-flex justify-content-between mb-lg-n4">
                        <div class="card-title mb-4">
                            <h5 class="mb-0">Maintenance Detail</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="border rounded p-3 mt-2">
                            <div class="row gap-4 gap-sm-0">
                                <div class="col-12 col-sm-4">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="badge rounded bg-label-primary p-1">
                                            <i class="ti ti-alert-octagon ti-sm"></i>
                                        </div>
                                        <h6 class="mb-0">Machine Name</h6>
                                    </div>
                                    <h4 class="my-2 pt-1">{{ $machine_name }}</h4>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="badge rounded bg-label-info p-1"><i
                                                class="ti ti-adjustments-alt ti-sm"></i>
                                        </div>
                                        <h6 class="mb-0">Serial Number</h6>
                                    </div>
                                    <h4 class="my-2 pt-1">{{ $serial_number }}</h4>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="badge rounded bg-label-danger p-1">
                                            <i class="ti ti-calendar-time ti-sm"></i>
                                        </div>
                                        <h6 class="mb-0">Date</h6>
                                    </div>
                                    <h4 class="my-2 pt-1">
                                        <input type="date" name="maintenance_date"
                                            class="form-control form-control-plaintext text-bold maintenance_date"
                                            value="{{ date('Y-m-d') }}" />
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Earning Reports -->

            </div>
            <div class="col-xl-5 col-lg-7 col-12">
                <div class="card h-100">
                    <div class="card-header">
                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="card-title mb-0">Machine Information Details</h5>
                            <small class="text-muted">Last update machine :
                                {{ dateFormater($prkserver->srvtimestamp, 'd F Y H:i:s') }}</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row gy-6">
                            <div class="col-md-6 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="badge rounded-pill bg-label-primary me-3 p-2">
                                        <i class="ti ti-chart-pie-2 ti-sm"></i>
                                    </div>
                                    <div class="card-info">
                                        <h5 class="mb-0">{{ number_format($last_interval_maintenance) }} Hours
                                        </h5>
                                        <small>Last Interval</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="badge rounded-pill bg-label-info me-3 p-2">
                                        <i class="ti ti-users ti-sm"></i>
                                    </div>
                                    <div class="card-info">
                                        <h5 class="mb-0">{{ number_format($prkserver->actualrun_hour) }} Hours
                                        </h5>
                                        <small>Total Running Hours</small>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="card card-action">
            <div class="card-header">
                <div class="card-action-title h5">
                    Maintenance & Setting Interval Sparepart
                </div>
                <div class="card-action-element">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="javascript:void(0);" onclick="showAllSparepart()"
                                class="card-collapsible btn-showAll"><i
                                    class="tf-icons ti ti-eye scaleX-n1-rtl ti-sm btn-show-hide"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="javascript:void(0);" onclick="window.location.reload()" class="card-reload"><i
                                    class="tf-icons ti ti-rotate-clockwise-2 scaleX-n1-rtl ti-sm"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="javascript:void(0);" class="card-expand"><i
                                    class="tf-icons ti ti-arrows-maximize ti-sm"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="javascript:void(0);" class="card-close"><i class="tf-icons ti ti-x ti-sm"></i></a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card-body">
                <div class="row">

                    <!-- Custom content with heading -->
                    <div class="col-md-12 mb-4 mb-xl-12">
                        <small class="text-light fw-semibold">List Sparepart</small>
                        <div class="mt-3">
                            <form class="form-tpm">

                                <div class="row">
                                    <div class="col-md-4 col-12 mb-3 mb-md-0">
                                        <div class="list-group table-responsive" style="height: 500px;">
                                            @foreach ($listSparepart as $key => $item)
                                                @php
                                                    $total_row = 0;
                                                    $count_is_warning = 0;
                                                @endphp
                                                @if (isset($item->pmHeader['pmIntervalDetail']))
                                                    @foreach ($item->pmHeader['pmIntervalDetail'] as $det)
                                                        <input type="hidden" value="{{ $det->id }}"
                                                            name="interval_id[{{ $item->pmHeader['id'] }}][]">

                                                        @php
                                                            $last_interval = $det->last_interval ?? 0;
                                                            $next_interval = $det->last_interval + $det->interval;
                                                            $remaining_time = $runHours - $next_interval;
                                                            $is_warning = $remaining_time > 0 ? true : false;
                                                            
                                                            if ($is_warning) {
                                                                $count_is_warning++;
                                                            }
                                                            $total_row++;
                                                        @endphp
                                                    @endforeach
                                                @endif


                                                <a class="list-group-item list-group-item-action  {{ $count_is_warning > 0 ? 'text-danger' : '' }}"
                                                    href="#tab{{ $key }}" data-id="tab{{ $key }}"
                                                    id="btn{{ $key }}" onclick="openTab({{ $key }})"
                                                    style="font-size: 11px;"><strong>{{ $key + 1 . '. ' . $item->sparepart['item_name'] }}
                                                        {{ $item->sparepart['spare_part_no'] ?? '' }}
                                                        ( {{ $total_row }} Interval )</strong></a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <div class="table-responsive mb-2" style="height: 500px; overflow-y: scroll;">
                                            <div class="tab-content p-0" id="tab-content">
                                                @foreach ($listSparepart as $key => $item)
                                                    <div class="tab-pane fade tabpane-sparepart show mb-4"
                                                        id="tab{{ $key }}">
                                                        <div class="table-responsive text-nowrap">
                                                            <h6 class="text-left">
                                                                <strong>{{ $key + 1 . '. ' . $item->sparepart['item_name'] }}
                                                                    {{ $item->sparepart['spare_part_no'] ?? '' }}</strong>
                                                            </h6>
                                                            <div class="card-header-elements ms-auto mb-2">
                                                                <button type="button"
                                                                    class="btn btn-sm btn-primary open-modal-interval"
                                                                    data-id="{{ $item->id_sparepart }}">
                                                                    <span
                                                                        class="tf-icon ti ti-plus ti-xs me-1"></span>Interval
                                                                    Detail
                                                                </button>
                                                            </div>

                                                            <table
                                                                class="table table-responsive table-bordered table-hover">
                                                                <thead>
                                                                    <tr style="text-align: center; line-height: 1px;">
                                                                        <th style="width: 1px;">#</th>
                                                                        {{-- <th>No</th> --}}
                                                                        <th class="text-left">Lable</th>
                                                                        <th>Interval</th>
                                                                        <th>Last Interval</th>
                                                                        <th>Keterangan</th>
                                                                        <th>Condition</th>
                                                                        <th>Remarks</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="collapseExample">
                                                                    @if (isset($item->pmHeader['pmIntervalDetail']))
                                                                        @foreach ($item->pmHeader['pmIntervalDetail'] as $key => $detail)
                                                                            <input type="hidden"
                                                                                value="{{ $detail->id }}"
                                                                                name="interval_id[{{ $item->pmHeader['id'] }}][]">
                                                                            @php
                                                                                $last_interval = $detail->last_interval ?? 0;
                                                                                $next_interval = $detail->last_interval + $detail->interval;
                                                                                $remaining_time = $prkserver->actualrun_hour - $next_interval;
                                                                                $is_warning = $remaining_time > 0 ? true : false;
                                                                            @endphp

                                                                            <tr class="{{ $is_warning == true ? 'text-danger ' : '' }} "
                                                                                style="line-height: -10px;">
                                                                                <td>
                                                                                    <button type="button"
                                                                                        class="btn btn-xs btn-primary me-1 open-modal-interval"
                                                                                        data-id="{{ $item->id_sparepart }}"
                                                                                        data-type='update'><span
                                                                                            class="fa
                                                                                fa-edit"></span>
                                                                                    </button>
                                                                                    <button type="button"
                                                                                        class="btn btn-xs btn-danger"><span
                                                                                            class="fa fa-trash ti-small"></span>
                                                                                    </button>
                                                                                </td>
                                                                                <td class="text-center lable">
                                                                                    {{ $detail->lable }}
                                                                                </td>
                                                                                <td class="text-center">
                                                                                    {{ number_format($detail->interval) . ' ' . $detail->action_lable }}
                                                                                </td>
                                                                                <td class="text-center">
                                                                                    {{ number_format($detail->last_interval) }}
                                                                                    <span
                                                                                        class="text-danger font-italic">Estimasi
                                                                                        interval
                                                                                        selanjutnya =>
                                                                                        <b>{{ number_format($next_interval) }}</span></b>
                                                                                </td>
                                                                                <td class="text-center">
                                                                                    {{ $is_warning ? 'Lewat Interval : ' : 'Interval Tersisa : ' }}
                                                                                    {{ number_format($remaining_time) }}
                                                                                    Hours
                                                                                </td>
                                                                                <td class="text-center m-0 p-0 bg-white"
                                                                                    style="vertical-align: middle">
                                                                                    @if ($is_warning == true)
                                                                                        @php $stokStatus = in_array($item->pmHeader->sparepart_id, $sparepartNotReady) ?  true : false; @endphp
                                                                                        @if ($stokStatus == true)
                                                                                            <span
                                                                                                class="badge bg-danger">Stok
                                                                                                Tidak
                                                                                                Tersedia</span>
                                                                                        @else
                                                                                            <div class="btn-group"
                                                                                                role="group">
                                                                                                <input type="radio"
                                                                                                    name="radio-Btn-Group "
                                                                                                    class="btn-check good-condition"
                                                                                                    id="radioBtn1{{ $detail->id }}">
                                                                                                <label
                                                                                                    class="btn btn-outline-success btn-xs"
                                                                                                    for="radioBtn1{{ $detail->id }}">OK</label>

                                                                                                <input type="radio"
                                                                                                    name="radio-Btn-Group"
                                                                                                    class="btn-check bad-condition"
                                                                                                    id="radioBtn2{{ $detail->id }}">
                                                                                                <label
                                                                                                    class="btn btn-outline-danger btn-xs"
                                                                                                    for="radioBtn2{{ $detail->id }}">Bad
                                                                                                    Condition</label>
                                                                                            </div>
                                                                                            <span class="status-condition">

                                                                                            </span>
                                                                                            <input type="hidden"
                                                                                                class="condition"
                                                                                                name="condition[{{ $detail->id }}]">
                                                                                        @endif
                                                                                    @endif


                                                                                </td>
                                                                                <td class="bg-white m-0 p-0">
                                                                                    @if ($is_warning == true)
                                                                                        <textarea class="txt" rows="1" name="remarksTpm[{{ $detail->id }}]"></textarea>
                                                                                    @endif
                                                                                </td>
                                                                                <td hidden class="interval"><input
                                                                                        id="interval"
                                                                                        value="{{ $detail->interval }}">
                                                                                </td>
                                                                                <td hidden class="last_interval"><input
                                                                                        id="last_interval"
                                                                                        value="{{ $detail->last_interval }}">
                                                                                </td>
                                                                                <td hidden class="interval_id"><input
                                                                                        id="interval_id"
                                                                                        value="{{ $detail->id }}">
                                                                                </td>
                                                                                <td hidden class="action_lable"><input
                                                                                        id="action_lable"
                                                                                        value="{{ $detail->action_lable }}">
                                                                                </td>
                                                                                <td hidden class="lable"><input
                                                                                        id="lable"
                                                                                        value="{{ $detail->lable }}"></td>
                                                                            </tr>
                                                                        @endforeach
                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="row mb-3 mt-2">
                                            <label class="col-sm-1 col-form-label" for="last-interval">Remarks</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" id="remarks" rows="3" name="remarks"></textarea>
                                                <button class="btn btn-primary mt-2 col-2" type="button"
                                                    onclick="saveTPM()"><span
                                                        class="fa fa-save"></span>&nbsp;Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!--/ Custom content with heading -->
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalIntervalDetail" tabindex="-1" aria-hidden="true" \>
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="lable">Create New Interval Detail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form class="form-interval">
                        <div class="modal-body">

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="lable">Lable</label>
                                <div class="col-sm-9">
                                    <input type="hidden" class="form-control" id="lable" name="interval_id" />
                                    <input type="hidden" class="form-control" id="lable" name="sparepart_id" />
                                    <input type="" class="form-control" id="lable" name="lable" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="inteval">Inveval</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="inteval" name="interval" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="last-interval">Last Inveval</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="last-interval"
                                        name="last_interval" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="action">Action</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="action_lable">
                                        <option>Check</option>
                                        <option>Change</option>
                                        <option>Clean</option>
                                        <option>Calibrate</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary btn-save-interval"
                                onclick="updateInterval()">Save
                                changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Activity Timeline -->


    <script>
        $('.good-condition, .bad-condition').click(function() {
            var closestRow = $(this).closest('tr');
            var statusClass = $(this).hasClass('good-condition') ? 'ti ti-circle-check text-success' :
                'ti ti-circle-x text-danger';
            var codition = $(this).hasClass('good-condition') ? 1 : 0;
            closestRow.find('.status-condition').html('<div class="' + statusClass +
                ' ms-2" style="font-size: 24px;"></div>');
            closestRow.find('.condition').val(codition);
        });
        $(document).ready(function() {
            var fragment = window.location.hash;
            var fragment = fragment.substring(4);
            openTab(fragment)


            $('.open-modal-interval').click(function() {
                var sparepartId = $(this).data('id');

                $('.form-interval').find('input[name="sparepart_id"]').val(sparepartId);

                var form_type = $(this).data('type');

                if (form_type == 'update') {
                    $("#modalIntervalDetail").find('#lable').html("Update Interval Detail")
                } else {
                    $("#modalIntervalDetail").find('#lable').html("Create New Interval Detail")
                }

                var row = $(this).closest('tr');
                var action_lable = row.find('#action_lable').val();
                var lable = row.find('#lable').val();
                var interval = row.find('#interval').val();
                var last_interval = row.find('#last_interval').val();
                var interval_id = row.find('#interval_id').val();


                $(".form-interval").find('input[name="interval"]').val(interval);
                $(".form-interval").find(
                    'input[name="last_interval"]').val(last_interval);
                $(".form-interval").find(
                    'input[name="interval_id"]').val(interval_id);
                $(".form-interval").find(
                    'input[name="lable"]').val(lable);
                $('select[name="action_lable"]').val(action_lable);

                $('#modalIntervalDetail').modal('show');
            });
            // let timerInterval
            // Swal.fire({
            //     title: 'Silahkan Tunggu !',
            //     html: 'Sedang melakukan sinkronisasi data',
            //     timer: 3000,
            //     timerProgressBar: true,
            //     didOpen: () => {
            //         Swal.showLoading()
            //         const b = Swal.getHtmlContainer().querySelector('b')
            //         timerInterval = setInterval(() => {
            //             b.textContent = Swal.getTimerLeft()
            //         }, 100)
            //     },
            //     willClose: () => {
            //         clearInterval(timerInterval)
            //     }
            // }).then((result) => {
            //     /* Read more about handling dismissals below */
            //     var sparepartId = [];
            //     $('.sparepart_id').each(function() {
            //         var value = $(this).val();
            //         sparepartId.push(value);
            //     });
            //     var categoryMaintenance = [];
            //     $('.category_maintenance').each(function() {
            //         var value = $(this).val();
            //         categoryMaintenance.push(value);
            //     });
            //     var machineId = "{{ $machine_id }}";

            //     $.ajax({
            //         type: "post",
            //         url: "{{ route('pmHeader.store') }}",
            //         data: {
            //             '_token': "{{ csrf_token() }}",
            //             'sparepart_id': sparepartId,
            //             'category_maintenance': categoryMaintenance,
            //             'machine_id': machineId
            //         },
            //         dataType: "json",
            //         success: function(response) {

            //             // if (response.code == 200) {
            //             //     setTimeout(() => {
            //             //         Swal.fire('Success!',
            //             //             'Sinkronisasi data berhasil dilakukan',
            //             //             'success');

            //             //     }, 2000);
            //             // } else {
            //             //     Swal.fire('Error : ' + String(response.code),
            //             //         String(
            //             //             response
            //             //             .message), 'warning');
            //             //     setTimeout(() => {
            //             //         window.location.reload();
            //             //     }, 2000);
            //             // }
            //         },
            //         error: function(xhr, status) {
            //             console.log(xhr);
            //             Swal.fire('Error : ' + String(xhr.responseJSON.code),
            //                 String(xhr
            //                     .responseJSON
            //                     .message), 'error');
            //         }
            //     });



            //     if (result.dismiss === Swal.DismissReason.timer) {
            //         console.log('I was closed by the timer')
            //     }
            // })

        });
        $('#loading-container').hide();
        $('.image-content').show();
        $('.open-modal').attr('disabled', true);

        $('.open-modal').on('click', function() {
            $('#exLargeModal').modal('show');
        });

        $('.interval-detail').on('click', function() {
            // var id = $(this).closest('tr').find('.id').text();
            var sparepartId = $(this).closest('tr').find('.sparepart_idx').text();
            var categoryMaintenance = $(this).closest('tr').find('.machine_category_idx').text();


            getIntervalDetail(sparepartId, categoryMaintenance);

            $('#formIntervalDetail [name="machine_id"]').val({{ $machine_id }});
            $('#formIntervalDetail [name="sparepart_id"]').val(sparepartId);
            $('#formIntervalDetail [name="category_maintenance"]').val(categoryMaintenance);



            $('#intervalDetailModal').modal('show');
        });

        function openTab(tabId) {
            $('.tabpane-sparepart').removeClass('active');
            $(`#tab${tabId}`).addClass('active');

            $('.list-group-item').removeClass('active');
            $(`#btn${tabId}`).addClass('active');
            $('#tab-content').addClass('tab-content');


            // Simpan posisi scroll saat ini
            var scrollPosition = window.pageYOffset;
            sessionStorage.setItem('scrollPosition', scrollPosition);

            // Atur ulang posisi scroll setelah selesai mengubah tab
            $(window).on('shown.bs.tab', function() {
                var savedScrollPosition = sessionStorage.getItem('scrollPosition');
                if (savedScrollPosition) {
                    window.scrollTo(0, savedScrollPosition);
                    sessionStorage.removeItem('scrollPosition');
                }
            });
        }

        function showAllSparepart(is_show_all = true) {
            if (is_show_all) {
                $('#tab-content').removeClass('tab-content');
                $('.btn-show-hide').removeClass('ti-eye');
                $('.btn-show-hide').addClass('ti-eye-off');
                $('.btn-showAll').attr('onclick', 'showAllSparepart(false)');
            } else {
                $('#tab-content').addClass('tab-content');
                $('.btn-show-hide').addClass('ti-eye');
                $('.btn-show-hide').removeClass('ti-eye-off');
                $('.btn-showAll').attr('onclick', 'showAllSparepart(true)');
            }

        }



        function handleButtonClick(button) {

            var tableRow = $(button).closest('tr');

            var machineId = $(button).closest('tr').find('td:eq(0)').text();
            var sparepartId = $(button).closest('tr').find('td:eq(8)').text();

            getTimelineMaintenance(machineId, sparepartId)
            $(".loadData").empty();
            resetModalData()

        }

        function getTimelineMaintenance(machineId, sparepartId) {
            $.ajax({
                type: "post",
                url: "{{ route('pmgetByParam.post') }}",
                data: {
                    machineId: machineId,
                    sparepartId: sparepartId,
                },
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                dataType: "json",
                beforeSend: function() {
                    $('#loading-container').show();
                    $('.image-content').hide();
                    $('.loadData').empty();

                },
                success: function(response) {

                    console.log(response);

                    setTimeout(() => {

                        $('.open-modal').attr('disabled', false);

                        var result = response.result;

                        $('#loading-container').hide();

                        var key = result.pm_detail.length - 1;

                        var $li = $('<li>').addClass(
                                'timeline-item timeline-item-transparent ps-4 mb-4')
                            .append($('<span>').addClass('timeline-point timeline-point-primary'))
                            .append($('<div>').addClass('timeline-event')
                                .append($('<div>').addClass('timeline-header mb-3')
                                    .append($('<h6>').addClass('mb-0').text('Checking Sparepart'))
                                    .append($('<small>').addClass('text-muted').text('12/02/2022')))
                                .append($('<p>').addClass('mb-0').attr('id',
                                    'collapseExample1_content'))
                                .append($('<div>').addClass(
                                        'alert alert-warning alert-dismissible mt-2').attr('role',
                                        'alert')
                                    .append($('<div>').addClass('divider text-center')
                                        .append($('<div>').addClass('divider-text').text(
                                            'Indication of Damage')))
                                    .append($('<p>').addClass('text-muted mb-0').text(result.pm_detail[
                                        key].indication))
                                    .append($('<div>').addClass('divider text-center')
                                        .append($('<div>').addClass('divider-text').text(
                                            'Problem Solving')))
                                    .append($('<p>').addClass('text-muted mb-0').text(result.pm_detail[
                                        key].problem_solv))
                                    .append($('<div>').addClass('divider text-center')
                                        .append($('<div>').addClass('divider-text').text(
                                            'Checking Result')))
                                    .append($('<p>').addClass('text-muted mb-0').text(result.pm_detail[
                                        key].checking_result))
                                    .append($('<hr>'))
                                    .append($('<div>').addClass('divider-text').text('Documentation'))
                                    .append($('<a>').attr('href', 'javascript:void(0)')
                                        .append($('<i>').addClass('ti ti-link'))
                                        .append('bookingCard.pdf'))
                                    .append($('<a>').attr('href', 'javascript:void(0)')
                                        .append($('<i>').addClass('ti ti-link'))
                                        .append('bookingCard.pdf')))
                                .append($('<button>').addClass('btn btn-info btn-sm').text('Load More'))
                            );

                        // Append the created element to the desired location in the DOM
                        $('.loadData').append($li);


                        $('#sparepart_id').val(result.sparepart.id);
                        $('#item_id').val(result.sparepart.item_id);
                        $('#item_id').val(result.sparepart.item_id);
                        $('#item_name').val(result.sparepart.item_name);
                        $('#doc_no').val(result.sparepart.doc_no);
                        $('#spare_part_no').val(result.sparepart.spare_part_no);
                        $('#interval').val(result.sparepart.interval);
                        $('#last_interval').val(result.pm_detail[key].last_interval);
                        $('#last_maintenance').val(result.pm_detail[key].maintenance_date);
                    }, 1500);
                },
                error: function(xhr, response, thrownError) {
                    console.log(xhr);
                    setTimeout(() => {
                        if (xhr.responseJSON.code != 404) {
                            Swal.fire('Error : ' + String(xhr.status),
                                String(xhr
                                    .responseJSON
                                    .message), 'error');
                        }

                        $('.open-modal').attr('disabled', false);
                        $('#loading-container').hide();
                        $('.image-content').show();

                        $('#sparepart_id').val(xhr.responseJSON.result.id);
                        $('#item_id').val(xhr.responseJSON.result.item_id);
                        $('#item_name').val(xhr.responseJSON.result.item_name);
                        $('#doc_no').val(xhr.responseJSON.result.doc_no);
                        $('#spare_part_no').val(xhr.responseJSON.result.spare_part_no);
                        $('#interval').val(xhr.responseJSON.result.interval);
                        $('#last_interval').val("");
                        $('#last_maintenance').val("");


                    }, 1500);
                }
            });
        }

        function selectMaintenanceType() {
            var maintenanceStatus = $('select[name="maintenance_status"]').find(':selected').val();
            if (maintenanceStatus == 'Check') {
                $('.checking-result').removeAttr('disabled', true);
            } else {
                $('.checking-result').attr('disabled', true);
            }

        }

        function updateInterval() {
            var formData = $('.form-interval').serialize();

            // Membuat objek data tambahan
            var additionalData = {
                machine_id: {{ $machine_id }},
            };
            var formData = formData + '&' + $.param(additionalData);
            $.ajax({
                url: '{{ route('intervalDetail.post') }}',
                type: "POST",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $(".btn-save-interval").attr('disabled', true);
                    $(".btn-save-interval").html(
                        '<span class="spinner-border me-1" role="status" aria-hidden="true"></span>Loading...'
                    );
                },
                dataType: "JSON",
                success: function(response) {
                    console.log(response);

                    setTimeout(() => {
                        $('#modalIntervalDetail').modal('hide');
                        $(".btn-save-interval").attr('disabled', false);
                        $(".btn-save-interval").html(
                            '<span class="fa fa-save"></span>&nbspSave Change'
                        );
                        Swal.fire("Success!",
                            String(
                                response
                                .message), 'success');
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);

                    }, 1500);

                    // console.log(response);

                },
                error: function(xhr, text) {
                    console.log(xhr);
                    Swal.fire('Error : ' + String(xhr.responseJSON.code),
                        String(xhr
                            .responseJSON
                            .message), 'error');
                    $(".btn-save-interval").attr('disabled', false);
                    $(".btn-save-interval").html(
                        '<span class="fa fa-save"></span>&nbspSave Change'
                    );
                }
            });

        }


        function getIntervalDetail(sparepartId, categoryMaintenance) {
            // alert(sparepartId)
            // alert(categoryMaintenance)
            $.ajax({
                type: "post",
                url: '{{ route('getIntervalDetail.post') }}',
                data: {
                    sparepartId: sparepartId,
                    categoryMaintenance: categoryMaintenance,
                    machineId: "{{ $machine_id }}"
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    var table = $('.table-interval-detail');
                    var tbody = table.find('tbody');

                    // Menghapus semua baris yang ada sebelum menambahkan baris yang baru
                    tbody.empty();

                    // Loop melalui data interval detail dan tambahkan baris ke dalam tabel
                    $.each(response.result.pm_interval_detail, function(index, item) {
                        var $row = $('<tr>').css('line-height', '0px');
                        $('<td>').addClass('text-center m-0 p-0').text(index + 1).appendTo($row);
                        $('<td>').addClass('text-center m-0 p-0').append($('<input>').addClass(
                            'form-control-plaintext form-control-sm text-center').attr(
                            'type',
                            'text').val(item.interval).attr('name', 'interval[]')).appendTo(
                            $row);
                        $('<td>').addClass('text-center m-0 p-0').append($('<input>').addClass(
                                'form-control-plaintext form-control-sm text-center').attr(
                                'type',
                                'text').attr('name', 'action_lable[]').val(item.action_lable))
                            .appendTo(
                                $row);

                        // Tambahkan baris ke dalam tbody
                        tbody.append($row);
                    });



                    // Tambahkan baris terakhir dengan input dan select
                    var $lastRow = $('<tr>').css('line-height', '0px');
                    $('<td>').addClass('text-center p-0 m-0').appendTo($lastRow);
                    $('<td>').addClass('text-center p-0 m-0').append($('<input>').addClass(
                            'form-control-plaintext form-control-sm text-center').attr('type', 'text')
                        .attr(
                            'name', 'interval[]')).appendTo($lastRow);
                    var $select = $('<select>').attr('name', 'action_lable[]').addClass(
                            'form-control-plaintext form-control-sm text-center')
                        .appendTo($('<td>').addClass('text-center p-0 m-0').appendTo($lastRow));
                    $('<option>').val('Check').text('Check').appendTo($select);
                    $('<option>').val('Change').text('Change').appendTo($select);
                    $('<option>').val('Clean').text('Clean').appendTo($select);
                    $('<option>').val('Calibrate').text('Calibrate').appendTo(
                        $select);


                    // Tambahkan baris terakhir ke dalam tbody
                    tbody.append($lastRow);
                },
                error: function(xhr, text) {
                    console.log(xhr);
                    if (xhr.status != 404) {
                        Swal.fire('Error : ' + String(xhr.status),
                            String(xhr
                                .responseJSON
                                .message), 'error');
                    }

                    var table = $('.table-interval-detail');
                    var tbody = table.find('tbody');
                    tbody.empty();

                    var $lastRow = $('<tr>').css('line-height', '0px');
                    $('<td>').addClass('text-center p-0 m-0').appendTo($lastRow);
                    $('<td>').addClass('text-center p-0 m-0').append($('<input>').addClass(
                            'form-control-plaintext form-control-sm text-center').attr('type', 'text')
                        .attr(
                            'name', 'interval[]')).appendTo($lastRow);
                    var $select = $('<select>').attr('name', 'action_lable[]').addClass(
                            'form-control-plaintext form-control-sm text-center')
                        .appendTo($('<td>').addClass('text-center p-0 m-0').appendTo($lastRow));
                    $('<option>').val('Check').text('Check').appendTo($select);
                    $('<option>').val('Change').text('Change').appendTo($select);
                    $('<option>').val('Clean').text('Clean').appendTo($select);
                    $('<option>').val('Calibrate').text('Calibrate').appendTo(
                        $select);


                    // Tambahkan baris terakhir ke dalam tbody
                    tbody.append($lastRow);
                }
            });

        }


        function resetModalData() {
            $('#collapsible-state').val('');
            // $('#maintenance_date').val('');
            $('#indication').val('');
            $('#problem_solv').val('');
            $('#checking_result').val('');
            $('#remarks').val('');
        }


        function saveTPM() {
            $('#exLargeModal').modal('hide');
            var formData = $('.form-tpm').serialize();

            // Membuat objek data tambahan
            var additionalData = {
                maintenance_date: $('input[name="maintenance_date"]').val(),
                machine_id: {{ $machine_id }},
                last_interval: {{ $prkserver->actualrun_hour }}
            };

            // Menggabungkan data tambahan dengan formData
            var formData = formData + '&' + $.param(additionalData);

            Swal.fire({
                title: 'Are you sure?',
                text: "It will be saved!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, save it!',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return new Promise((resolve) => {
                        $.ajax({
                            url: '{{ route('tpm.store') }}',
                            type: "POST",
                            data: formData,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType: "JSON",
                            success: function(response) {
                                console.log(response);
                                // Swal.fire('Success!', String(response.message),
                                //     'success');
                                // if (response.code == 200) {
                                //     Swal.fire("Success!",
                                //         String(
                                //             response
                                //             .message), 'success');
                                //     setTimeout(() => {
                                //         window.location.reload();
                                //     }, 2000);
                                // } else {
                                //     Swal.fire('Error : ' + String(response.code),
                                //         String(
                                //             response
                                //             .message), 'warning');
                                //     setTimeout(() => {
                                //         window.location.reload();
                                //     }, 2000);
                                // }
                                // $(".btn-save").attr('disabled', false);
                                // $(".btn-save").html('Save');
                            },
                            error: function(xhr, text) {
                                console.log(xhr);
                                Swal.fire('Error : ' + String(xhr.status),
                                    String(xhr
                                        .responseJSON
                                        .message), 'error');
                                $(".btn-save").attr('disabled', false);
                                $(".btn-save").html('Save');
                            }
                        });
                    });
                },
            }).then((result) => {
                if (!result.isConfirmed) {
                    $(".btn-save").attr('disabled', false);
                    $(".btn-save").html('Save');
                }
            });
        }
    </script>

@endsection
