@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')

    <div class="container-fluid flex-grow-1 container-p-y">
        <div style="display: flex; justify-content: space-between; align-items: center;" class="mb-3">
            <h4 class="fw-bold py-1 mb-2">
                <span class="text-muted fw-light">Monitoring /</span> Total Productive Maintenance
            </h4>
        </div>

        <!-- DataTable with Buttons -->
        <div class="row">
            <div class="col-md ">
                <div class="card card-action">
                    <div class="card-header">
                        <div class="card-action-title"><strong>Filter Data</strong></div>
                        <div class="card-action-element">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <a href="javascript:void(0);" class="card-collapsible"><i
                                            class="tf-icons ti ti-chevron-right scaleX-n1-rtl ti-sm"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <hr style="padding: 0px; margin:0px;">
                    <div class="collapse show">
                        <div class="card-body">
                            <form action="">
                                <div class="row ms-1">
                                    <div class="col-5">
                                        <label for="machine" class="form-label mb-2">Pilih Machine</label>
                                        <div class="input-group">
                                            <select class="form-select form-select-md form-input select w-25" id="machine"
                                                name="machine">
                                                <option value="0">Pilih Machine</option>

                                            </select>
                                            <select class="form-select form-select-md form-input select w-25" id="sparepart"
                                                name="dept">
                                                <option value="0">Pilih Sparepart</option>

                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="col-2">
                                        <div class="input-group">
                                            <select class="form-select form-select-md form-input select w-25" id="pemborong"
                                                name="pemborong">
                                                <option value="0">Pilih</option>

                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class="col-4">
                                        <label for="pemborong" class="form-label mb-2">Pilih Tanggal Maintenance</label>
                                        <div class="input-group">
                                            <input type="text" id="bs-rangepicker-range" name="tanggal_pm"
                                                class="form-control" />
                                            {{-- <input type="text" class="form-control pencarian-tk w-20" id="valPencarian"
                                                name="value_pencarian" placeholder="Silahkan masukkan kata kunci"
                                                aria-describedby="btnPencarian" autofocus /> --}}
                                            <button class="btn btn-success" id="btnPencarian" type="submit"><i
                                                    data-feather="search" class="me-25"></i>Cari</button>
                                        </div>
                                        {{-- <input name="status_tk" type="hidden" id="valListTk" value="1"> --}}
                                        <!-- 1.karyawan, 2. harian/borongan -->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-4">
                <div class="card pe-4 ps-4">
                    <div class="">
                        <div class="text-nowrap pt-3">
                            <div class="col-xl-12 col-md-12 col-12">
                                <h4 class="text-center"><strong>Monitoring Kegiatan Total Productive
                                        Maintenance</strong></h4>
                                <hr>
                                <div class="table-responsive text-nowrap pt-3" style="height: 500px;">
                                    <table class="table table-responsive table-hover table-bordered tpm-monitoring"
                                        id="datatable" style="font-size: 11px;">
                                        <thead>
                                            <tr>
                                                <th hidden>No</th>
                                                <th>Tanggal Maintenance</th>
                                                <th>Lable</th>
                                                <th>Interval</th>
                                                <th>Last Interval</th>
                                                <th>Condition</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- <tr style="line-height: 10px;">
                                                <td colspan="7" class="bg-success text-white" style="padding-left: 50px">
                                                    <strong>O-ring 6-4302 0260
                                                        02</strong>
                                                </td>
                                            </tr>
                                            <tr style="line-height: 5px;">
                                                <td style="padding-left: 100px">12/09/2023</td>
                                                <td>V-001</td>
                                                <td>290.000</td>
                                                <td>290.000</td>
                                                <td>
                                                    <div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0">
                                                        <span class="badge badge-dot bg-primary me-1"></span> OK Condition
                                                    </div>
                                                </td>
                                                <td>Ganti Bearing</td>
                                            </tr>
                                            <tr style="line-height: 5px;">
                                                <td style="padding-left: 100px">12/09/2023</td>
                                                <td>V-001</td>

                                                <td>290.000</td>
                                                <td>290.000</td>
                                                <td>
                                                    <div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0">
                                                        <span class="badge badge-dot bg-primary me-1"></span> OK Condition
                                                    </div>
                                                </td>
                                                <td>Ganti Bearing</td>
                                            </tr>
                                            <tr style="line-height: 5px;">
                                                <td style="padding-left: 100px">12/09/2023</td>
                                                <td>V-001</td>

                                                <td>290.000</td>
                                                <td>290.000</td>
                                                <td>
                                                    <div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0">
                                                        <span class="badge badge-dot bg-primary me-1"></span> OK Condition
                                                    </div>
                                                </td>
                                                <td>Ganti Bearing</td>
                                            </tr>
                                            <tr style="line-height: 10px;">
                                                <td colspan="7" class="bg-success text-white" style="padding-left: 50px">
                                                    <strong>O-ring 6-4302 0260
                                                        02</strong>
                                                </td>
                                            </tr>
                                            <tr style="line-height: 5px;">
                                                <td style="padding-left: 100px">12/09/2023</td>
                                                <td>V-001</td>

                                                <td>290.000</td>
                                                <td>290.000</td>
                                                <td>
                                                    <div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0">
                                                        <span class="badge badge-dot bg-danger me-1"></span> Bad Condition
                                                    </div>
                                                </td>
                                                <td>Ganti Bearing</td>
                                            </tr>
                                            <tr style="line-height: 5px;">
                                                <td style="padding-left: 100px">12/09/2023</td>
                                                <td>V-001</td>

                                                <td>290.000</td>
                                                <td>290.000</td>
                                                <td>
                                                    <div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0">
                                                        <span class="badge badge-dot bg-primary me-1"></span> OK Condition
                                                    </div>
                                                </td>
                                                <td>Ganti Bearing</td>
                                            </tr>
                                            <tr style="line-height: 5px;">
                                                <td style="padding-left: 100px">12/09/2023</td>
                                                <td>V-001</td>

                                                <td>290.000</td>
                                                <td>290.000</td>
                                                <td>
                                                    <div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0">
                                                        <span class="badge badge-dot bg-primary me-1"></span> OK Condition
                                                    </div>
                                                </td>
                                                <td>Ganti Bearing</td>
                                            </tr> --}}


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary mt-4 mb-4"><i
                                class="fa-regular fa-file-pdf me-1"></i>Export
                            Pdf</button>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            getTpmByParam(1);

            var selectMachine = $("#machine");

            $.get("{{ route('getAllMachine.get') }}")
                .done(function(response) {
                    // console.log(response);
                    $.each(response, function(index, val) {
                        selectMachine.append($('<option>', {
                            value: val.machine_id,
                            text: val.machine_name
                        }));
                    });
                })

            $('#machine').change(function(e) {
                e.preventDefault();
                console.log(e.target.value);

                $.get("{{ route('getAllMachine.get') }}/" + e.target.value)
                    .done(function(response) {
                        selectSparepart = $("#sparepart");
                        selectSparepart.empty();

                        // Mengurutkan berdasarkan nama item (item_name)
                        response[0].sparepart_dtl.sort(function(a, b) {
                            var itemA = a.sparepart.item_name.toUpperCase();
                            var itemB = b.sparepart.item_name.toUpperCase();
                            if (itemA < itemB) {
                                return -1;
                            }
                            if (itemA > itemB) {
                                return 1;
                            }
                            return 0;
                        });

                        selectSparepart.append($('<option>', {
                            text: "Pilih Sparepart",
                        }));
                        $.each(response[0].sparepart_dtl, function(index, val) {
                            selectSparepart.append($('<option>', {
                                text: val.sparepart.item_name + " " + val.sparepart
                                    .spare_part_no,
                                value: val.id
                            }));
                        });
                    });
            });
        });

        function getTpmByParam(machine_id) {
            $.ajax({
                type: "POST",
                url: "{{ route('getTpmByParam.post') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    machine_id: machine_id,
                },
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    var table = $(".tpm-monitoring");

                    response.result.sort(function(a, b) {
                        var itemA = a.sparepart.item_name.toUpperCase();
                        var itemB = b.sparepart.item_name.toUpperCase();
                        if (itemA < itemB) {
                            return -1;
                        }
                        if (itemA > itemB) {
                            return 1;
                        }
                        return 0;
                    });

                    $.each(response.result, function(key, item) {
                        var totalDetail = item.pm_header?.pm_detail?.length;

                        var parent = $("<tr>").css('line-height', '5px')
                            .addClass('bg-success text-white')
                            .append($("<td>").attr('colspan', '7').css('padding-left', '50px').css(
                                    'font-size', '11px')
                                .append($("<strong>").text(item.sparepart.item_name + " " + item
                                    .sparepart.spare_part_no)));


                        if (totalDetail > 0) {
                            $.each(item.pm_header.pm_detail, function(i, val) {
                                var child = $("<tr>").css('line-height', '0px').css(
                                    'font-size', '11px');
                                console.log(val);
                                child.append($("<td>").css('padding-left', '100px').text(val
                                        .hdr_id))
                                    .append($("<td>").text(
                                        'LOCK NUT M6M TRI-LOC 16 DIN 6925 PN : 6-472'))
                                    .append($("<td>").text(val.hdr_id))
                                    .append($("<td>").text(val.hdr_id))
                                    .append($("<td>").append(
                                        $("<div>").addClass(
                                            'd-flex align-items-center lh-1 me-3 mb-sm-0 p-0 m-0'
                                        )
                                        .append($("<span>").addClass(
                                            'badge badge-dot bg-primary me-1'))
                                        .append("OK Condition")
                                    ));
                                console.log(child);
                                table.append(child);
                            });
                        }

                        table.append(parent);
                    });




                }
            });
        }
    </script>

@endsection
