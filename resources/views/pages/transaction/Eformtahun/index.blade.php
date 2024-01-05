@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')
    <style>
        .checkbox-cell {
            width: 20px;
            height: 20px;
            border: 1px solid black;
            background-color: white;
            cursor: pointer;
        }

        .checkbox-cell.selected {
            background-color: black;
        }
    </style>

    <div class="container-fluid flex-grow-1 container-p-y">
        <form id="form-data">
            @csrf


            <div class="row">
                <div class="col-12 col-xl-12 col-md-6">
                    <div class="card h-100">
                        <div class="card-header pb-0 d-flex justify-content-between mb-lg-n4">
                            <div class="card-title mb-4">
                                <div class="d-flex gap-2 align-items-center">
                                    <div class="badge rounded bg-label-info p-1">
                                        <i class="ti ti-alert-octagon ti-sm"></i>
                                    </div>
                                    <h5 class="mb-0">Please enter your input here</h5>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="border rounded p-3 mt-2">
                                <div class="row gap-4 gap-sm-0">
                                    <div class="col-12 col-sm-4">
                                        <div class="d-flex gap-2 align-items-center">
                                            <div class="badge rounded bg-label-primary mb-1 p-1">
                                                <i class="ti ti-home ti-sm"></i>
                                            </div>
                                            <h6 class="mb-0">Deparment</h6>

                                        </div>
                                        <div class="col-md-10">
                                            <select id="selectdept" class="select2 form-select" name="department">
                                                <option value="">Select</option>
                                                @foreach ($Dept as $item)
                                                    <option value="{{ $item['department'] }}">{{ $item['department'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="d-flex gap-2 align-items-center">
                                            <div class="badge rounded bg-label-danger mb-1 p-1">
                                                <i class="ti ti-calendar-time ti-sm"></i>
                                            </div>
                                            <h6 class="mb-0">Tahun</h6>
                                        </div>
                                        <div class="col-md-10" id="bulanContainer">
                                            <input class="form-control" type="date" name="tahun" value="2023-06-01"
                                                id="getbulan" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4" id="select2">
                                        <div class="d-flex gap-2 align-items-center">
                                            <div class="badge rounded bg-label-success mb-1 p-1">
                                                <i class="ti ti-settings ti-sm"></i>
                                            </div>
                                            <h6 class="mb-0">Peralatan/machine</h6>
                                        </div>
                                        <div class="col-md-10">
                                            <select id="selectmachine" class="select2 form-select" name="mesinid">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4 mt-3">
                                        <div class="col-md-12" id="btnsave">
                                            <button type="button" class="btn btn-primary btn-save" onclick="save()"><i
                                                    class="fa fa-refresh"></i>
                                                Save</button>
                                            <button type="submit" class="btn btn-success"><i class="fa fa-print"></i>
                                                Print</button>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
            <br>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <input hidden class="form-control col-md-2" type="text" name="jenisform" value="1"
                            readonly />
                        <input hidden class="form-control col-md-2" type="text" name="id" value="" readonly />

                        <div class="accordion-body m-3">
                            <div class="table-responsive text-nowrap pt-3">
                                <table class="table table-responsive table-bordered table-striped table-hover">
                                    <tr style="text-align:center;">
                                        <th style="width: 50px;" rowspan="3"><img
                                                src="{{ asset('public/img/logo-01042022.png') }}">
                                        </th>
                                        <th style="width: 50px;">PT RIAU SAKTI UNITED PLANTATIONS</th>
                                        <th style="width: 100px;" rowspan="">
                                            <input type="text" name="nosurat" value="" id="nosurat"
                                                class="form-control form-control-plaintext form-control-sm"
                                                style="text-align:center; display: block; font-weight: bold;" readonly>
                                        </th>
                                    </tr>
                                    <tr style="text-align:center;">
                                        <th style="width: 50px;">

                                            <span style="display: block;">DAFTAR CEK PERAWATAN DAN CATATAN PERBAIKAN/
                                                PENGGANTIAN TAHUNAN</span>
                                            <span><em>(Maintenance Checklist And Annual Repair/Replacement
                                                    Records)</em></span>
                                        </th>
                                        <th style="width: 100px;" rowspan="">
                                            <span style="display: block;">HAL : 1 DARI 2</span>
                                            <span><em>(Pages) 1 of 2</em></span>
                                        </th>
                                    </tr>
                                </table>

                                <table class="table table-responsive table-bordered table-striped table-hover">
                                    <tr>
                                        <th style="width: 50px;"> <span style="display: block;">Nama Peralatan/Mesin
                                            </span>
                                            <span><em>(Name of Equipment/ Machine)</em></span>
                                            <input type="text" name="peralatan" id="peralatan"value=""
                                                clas="form-control  form-control-sm" readonly>
                                        </th>
                                        <th style="width: 50px;"> <span style="display: block;">Kode (Code) :
                                                <input type="text" name="code" value="" id="code"
                                                    class="form-control  form-control-sm">
                                        </th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="accordion-body m-3">
                            <div class="table-responsive text-nowrap pt-3">
                                <table id="tableContainer"
                                    class="table table-responsive table-bordered table-striped table-hover">
                                    <thead style="text-align:center;">
                                        <tr>
                                            <th rowspan="2" style="width: 50px;">No</th>

                                            <th rowspan="2" style="width: 100px;"> <span
                                                    style="display: block;">Bagian
                                                    yang
                                                    diperiksa </span>
                                                <span><em>(Part to Check)</em></span>
                                            </th>
                                            <th rowspan="2"> <span style="display: block;">FREKUENSI</span>
                                                <span><em>(Frequency)</em></span>
                                            </th>
                                            <th rowspan="2"> <span style="display: block;">P/R/S</span>
                                            </th>
                                            <th class="tanggal">bulan (Month)</th>

                                        </tr>
                                        <tr id="tanggalkalender">

                                        </tr>
                                    </thead>
                                    <tbody id="tableBody">
                                        <td></td>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row" id="footer">
                <div class="col-12">
                    <div class="card">
                        <div class="accordion-body m-3">
                            <div class="table-responsive text-nowrap pt-3">
                                <table class="table table-bordered table-hover table-striped table-responsive">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align: middle; text-align: center; width: 33.3%"><span
                                                    style="display: block;">Keterangan :</span>
                                                <span><em>(Remarks)</em></span>
                                            </th>
                                            <th style="vertical-align: middle; text-align: center; width: 33.3%"><span
                                                    style="display: block;">Dibuat Oleh</span>
                                                <span><em>(Created by)</em></span>
                                            </th>
                                            <th style="vertical-align: middle; text-align: center; width: 33.3%"><span
                                                    style="display: block;">Disetujui Oleh</span>
                                                <span><em>(Approved by)</em></span>
                                            </th>

                                        </tr>
                                        <tr>
                                            <th style="vertical-align: middle; text-align: left">
                                                <img style="width: 90%;" src="{{ asset('img/tahunan.png') }}">
                                            </th>


                                        </tr>

                                    </thead>
                                    <tbody>


                                        <tr>
                                            <td><span style="display: block;">
                                            </td>
                                            <th><span style="display: block;">Nama</span>
                                                <select id="namadibuat" class="select2 form-select col-md-10"
                                                    name="dibuat_id">
                                                    <option value="">Select</option>

                                                </select>
                                                <input hidden id="dibuat_oleh" class="form-control" type="text"
                                                    name="dibuat_oleh" value="" readonly />
                                                <span><em>(Name)</em></span>
                                            </th>
                                            <th><span style="display: block;">Nama</span>
                                                <select id="namaaproved" class="select2 form-select col-md-10"
                                                    name="approved_id">
                                                    <option value="">Select</option>

                                                </select>
                                                <input hidden id="approved_by" class="form-control" type="text"
                                                    name="approved_by" value="" readonly />

                                                <span><em>(Name)</em></span>
                                            </th>


                                        </tr>
                                        <tr>
                                            <td><span style="display: block;">
                                            </td>
                                            <th><span style="display: block;">Jabatan</span>
                                                <input id="jabatan_buat" class="form-control" type="text"
                                                    name="jabatan_buat" value="" readonly />
                                                <span><em>(Position)</em>
                                            </th>
                                            <th><span style="display: block;">Jabatan</span>
                                                <input id="jabatan_approved" class="form-control" type="text"
                                                    name="jabatan_approved" value="" readonly />
                                                <span><em>(Position)</em>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td><span style="display: block;"></span></td>
                                            <th>
                                                <div class="d-flex align-items-center">
                                                    <label for="getbulan"
                                                        style="font-style: italic; display: block; margin-right: 10px;">Tanggal</label>

                                                    <input class="form-control" type="date" name="month"
                                                        value="2023-06-01" id="getbulan" />


                                                </div>
                                                <span><em>(Date)</em></span>
                                            </th>
                                            <th>
                                                <div class="d-flex align-items-center">
                                                    <label for="getbulan"
                                                        style="font-style: italic; display: block; margin-right: 10px;">Tanggal</label>

                                                    <input class="form-control" type="date" name="month"
                                                        value="2023-06-01" id="getbulan" />


                                                </div>
                                                <span><em>(Date)</em></span>
                                            </th>
                                        </tr>

                                    </tbody>
                                </table>
                                <table class="table table-bordered" style="margin-bottom: 0px;">
                                    <tfoot>
                                        <tr>

                                            <td>
                                                <span style="font-style: italic;"><span style="display: block;">Tanggal
                                                        Efektif : 01 April 2022</span>
                                                    <span><em>(Effective Date: 01 April 2022)</em></span>
                                                    <span style="font-style: italic" class="pull-right"></span>
                                            </td>

                                            <td>
                                                <span style="font-style: italic;" class="pull-right">FRM-SYS-013a-02
                                                </span>

                                            </td>

                                        </tr>
                                    </tfoot>
                                </table>
                                <br>


                            </div>
                        </div>
                    </div>
                </div>



        </form>
    </div>

    <!-- Your HTML code here -->

    <script>
        $(document).ready(function() {


            // $('#btnsave button').prop('disabled', true);
            $('#getbulan').prop('disabled', true);
            $('#selectmachine').prop('disabled', true);


        });

        $('#selectdept').change(function() {
            var department = $(this).val();


            if (selectdept.length > 0) {
                $('#getbulan').prop('disabled', false);
                $('#selectmachine').prop('disabled', true);
            }

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            // Mengirim permintaan AJAX untuk mendapatkan opsi yang sesuai berdasarkan id departemen
            Swal.fire({
                title: 'Loading...',
                text: 'Sedang memuat data karyawan dan master mesin / peralatan',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });
            $.ajax({
                url: "{{ route('getdepttomesintahun.index') }}",
                type: 'post',
                data: {
                    department: department
                },
                dataType: 'JSON',
                success: function(data) {
                    console.log(data);

                    $('#peralatan').val("");
                    $('#selectnama').empty();
                    // $('#selectmachine').empty();
                    $('#jabatan').val("");


                    // Menambahkan opsi yang sesuai berdasarkan respons objek
                    if (Array.isArray(data.listTk.Results)) {
                        data.listTk.Results.forEach(function(item) {
                            $('#namadibuat').append('<option value="' + item.personalid + '">' +
                                item.nama + '</option>');
                            $('#namaaproved').append('<option value="' + item.personalid +
                                '">' +
                                item.nama + '</option>');
                        });


                        $('#namadibuat').change(function() {
                            var selectednama = $(this).val();

                            console.log(data.listTk.Results);
                            var selectedItem = data.listTk.Results.find(function(obj) {
                                return obj.personalid == selectednama;
                            });

                            if (selectedItem) {
                                $('#jabatan_buat').val(selectedItem.jabatan_nama);
                                $('#dibuat_oleh').val(selectedItem.nama);
                            } else {
                                $('#jabatan_buat').val('');
                                $('#dibuat_oleh').val('');
                            }
                        });

                        $('#namaaproved').change(function() {
                            var selectednama = $(this).val();

                            console.log(data.listTk.Results);
                            var selectedItem = data.listTk.Results.find(function(
                                obj) {
                                return obj.personalid == selectednama;
                            });

                            if (selectedItem) {
                                $('#jabatan_approved').val(selectedItem
                                    .jabatan_nama);
                                $('#approved_by').val(selectedItem.nama);
                            } else {
                                $('#jabatan_approved').val('');
                                $('#approved_by').val('');
                            }



                        });

                    } else {
                        console.log('Invalid response data: listTk is not an array');
                    }

                    $.each(data.listPeralatan, function(index, item) {

                        $("#selectdept").find(":selected").val(item.dept);
                        $('#peralatan').val(item.dept);

                        var peralatan = item.peralatan;
                        // Menambahkan opsi departemen dan mesin

                        $('#selectmachine').append('<option value="' + item.mesinperalatan_id +
                            '">' + peralatan.machine_name + '</option>');

                    });

                    swal.close();
                },
                error: function(error) {
                    console.log(error);
                }
            });

        });




        $('#getbulan').change(function() {
            // Mendapatkan nilai bulan yang dipilih
            var selectedMonth = $(this).val();
            console.log(selectedMonth);

            if (selectedMonth.length > 0) {
                $('#selectmachine').prop('disabled', false);

            }
            var daysInMonth = handleBulanChange();

        });

        $('#selectmachine').change(function() {
            $('#footer').show();

            var selectedValues = $(this).val();
            console.log(selectedValues);

            if (selectmachine.length > 0) {
                $('#btnsave button').prop('disabled', false);

            }


            var daysInMonth = handleBulanChange();


        });

        function handleBulanChange() {
            const tanggalkalender = document.getElementById('tanggalkalender');
            const inputBulan = document.getElementById('getbulan');

            tanggalkalender.innerHTML = '';

            const selectedMonth = inputBulan.value;
            const date = new Date(selectedMonth);
            const year = date.getFullYear();

            let dateRange = '';
            for (let month = 0; month < 12; month++) {
                const monthIndex = month + 1;
                const dateObj = new Date(year, month, 1);
                const monthName = dateObj.toLocaleString('default', {
                    month: 'long'
                });
                dateRange += `<th class="small-cell">${monthName}</th>`;
            }

            const tableRow = `<tr>${dateRange}</tr>`;
            tanggalkalender.innerHTML = tableRow;
            $('.tanggal').attr('colspan', 12);

            var selectedValues = $('#selectmachine').find(':selected').val();
            var department = $("#selectdept").find(":selected").val();
            if (selectedValues != '') {
                generateTable(selectedValues, 31); // Assuming all months have 31 days
                checkSelectedRow(department, year, selectedValues)
            }

            // Update the department and no surat

            var inputElement = document.getElementById("nosurat");
            inputElement.value = "NO : PRT/" + department + "/" + year;

            return 12; // Return the number of months
        }



        function generateTable(selectedValues, daysInMonth) {
            var tableBody = $('#tableBody');
            tableBody.empty();

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            // Tampilkan swal loading
            swal({
                title: "Loading",
                text: "Please wait...",
                icon: "info",
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 2000
            });

            $.ajax({
                type: 'GET',
                url: "{{ route('getmasterEformtahunan.index') }}",
                dataType: "json",
                success: function(data) {
                    // console.log(data);

                    swal.close(); // Tutup swal loading

                    // Hapus isi dari tableBody
                    // tableBody.empty();

                    // Loop melalui data untuk mencocokkan dengan selectedValues
                    $.each(data, function(index, item) {
                        if (selectedValues.includes(item.machine_id)) {
                            // checkSelectedRow(item.machine_id)

                            tableBody.empty();
                            var row = $('<tr>');
                            row.append($('<td hidden>').append(
                                $('<input hidden>', {
                                    type: '',
                                    value: item.machine_id,
                                    name: 'bagian[]'
                                })
                            ));
                            row.append($('<td hidden>').text(item.machine_name));
                            tableBody.append(row);

                            $.each(item.fm015category, function(categoryIndex, category) {
                                var categoryRow = $('<tr>');
                                categoryRow.append($('<td>').text(categoryIndex +
                                    1));
                                categoryRow.append($('<td hidden>').append(
                                    $('<input>', {
                                        type: 'hidden',
                                        value: category.category_id,
                                        name: 'category_id[]'
                                    })
                                ));
                                categoryRow.append($('<td>').text(category
                                    .category_name));
                                tableBody.append(categoryRow);

                                $.each(category.form015asubcategory, function(
                                    subIndex,
                                    subcategory) {
                                    var subcategoryRow = $('<tr>');


                                    var hiddenInput = $('<input>', {
                                        type: 'hidden',
                                        value: subcategory
                                            .subcategory_id,
                                        name: 'subcategory_id[]'
                                    }).attr('hidden', true);

                                    var hiddenCell = $('<td>').append(
                                        hiddenInput);

                                    categoryRow.append(hiddenCell);
                                    var idsubcategory = $('<td >')
                                        .attr('rowspan', 5)
                                        .text(subIndex + 1);
                                    subcategoryRow.append(idsubcategory);

                                    tableBody.append(subcategoryRow);


                                    // Text TD with rowspan
                                    var subcategoryNameTD = $('<td>')
                                        .attr('rowspan', 5)
                                        .text(subcategory.subcategory_name);
                                    subcategoryRow.append(
                                        subcategoryNameTD);
                                    tableBody.append(subcategoryRow);

                                    //Frequency
                                    var frequency = $('<input>')
                                        .addClass(
                                            'form-control form-control-sm')
                                        .attr('type', 'text')
                                        .attr('name',
                                            `frequency[${subcategory.subcategory_id}]`
                                        )
                                        .val("");

                                    var subfrequency = $('<td>')
                                        .attr('rowspan', 5)
                                        .append(frequency);

                                    subcategoryRow.append(subfrequency);
                                    tableBody.append(subcategoryRow);



                                    // Realisasi
                                    var planRow = $('<tr>');
                                    var planHeader = $('<th>').text(
                                        'Plan');
                                    planRow.append(planHeader);

                                    var realisasiRow = $('<tr>');
                                    var realisasiHeader = $('<th>').text(
                                        'Realisasi');
                                    realisasiRow.append(
                                        realisasiHeader);

                                    var statusRow = $('<tr>');
                                    var statusHeader = $('<th>').text(
                                        'Status');
                                    statusRow.append(
                                        statusHeader);

                                    var remaksRow = $('<tr>');
                                    var remaksHeader = $('<th>').text(
                                        'Nama & Paraf');
                                    remaksRow.append(
                                        remaksHeader);

                                    for (var i = 1; i <= 12; i++) {
                                        // Plan

                                        var additionalPlanInput = $(
                                                '<input>')
                                            .addClass(
                                                'form-control form-control-plaintext form-control-sm'
                                            )
                                            .attr('type', 'hidden')
                                            .attr('name',
                                                `plan[${subcategory.subcategory_id}][${i}]`
                                            )
                                            .attr('id',
                                                `plan-${subcategory.subcategory_id}-${i}`
                                            );

                                        var additionalCell = $('<td>')
                                            .addClass('')
                                            .click(function() {
                                                $(this).toggleClass(
                                                    'selected');
                                                if ($(this).hasClass(
                                                        'selected')) {
                                                    $(this).find(
                                                            'input')
                                                        .val('1');
                                                    $(this).css(
                                                        'background-color',
                                                        'black');
                                                } else {
                                                    $(this).find(
                                                            'input')
                                                        .val('');
                                                    $(this).css(
                                                        'background-color',
                                                        '');
                                                }
                                            });

                                        additionalCell.append(
                                            additionalPlanInput
                                        ); // Append the input element directly to the cell
                                        planRow.append(additionalCell);


                                        //Realisasi
                                        var additionalRealisasiInput = $(
                                                '<input>')
                                            .addClass(
                                                'form-control form-control-plaintext form-control-sm'
                                            )
                                            .attr('type', 'date')
                                            .attr('name',
                                                `realisasi[${subcategory.subcategory_id}][${i}]`
                                            )
                                            .attr('placeholder', 'R');

                                        var additionalRealisasiInputCell =
                                            $('<td>')
                                            .append(
                                                additionalRealisasiInput);
                                        realisasiRow.append(
                                            additionalRealisasiInputCell
                                        );

                                        // Status
                                        var additionalStatusInput = $(
                                                '<input>')
                                            .addClass(
                                                'form-control form-control form-control-sm mb-1'
                                            )
                                            .attr('type', 'text')
                                            .attr('name',
                                                `statustpm[${subcategory.subcategory_id}][${i}]`
                                            )
                                            .attr('placeholder', '');

                                        var btnGroup = $('<div>').addClass(
                                                'btn-group p-3')
                                            .attr({
                                                role: 'group',
                                                'aria-label': 'Basic radio toggle button group'
                                            });

                                        var radioInput1 = $('<input>')
                                            .attr({
                                                type: 'radio',
                                                class: 'btn-check',
                                                name: `status[${subcategory.subcategory_id}][${i}]`,
                                                id: `status-${subcategory.subcategory_id}-${i}-1`,
                                                autocomplete: 'off',
                                                value: 't'
                                            });

                                        var label1 = $('<label>')
                                            .addClass(
                                                'btn btn-outline-info btn-xs'
                                            )
                                            .attr('for',
                                                `status-${subcategory.subcategory_id}-${i}-1`
                                            )
                                            .append($('<i>').addClass(
                                                'ti ti-check'));

                                        var radioInput2 = $('<input>')
                                            .attr({
                                                type: 'radio',
                                                class: 'btn-check',
                                                name: `status[${subcategory.subcategory_id}][${i}]`,
                                                id: `status-${subcategory.subcategory_id}-${i}-2`,
                                                autocomplete: 'off',
                                                value: 'f'
                                            });

                                        var label2 = $('<label>')
                                            .addClass(
                                                'btn btn-outline-danger btn-xs'
                                            )
                                            .attr('for',
                                                `status-${subcategory.subcategory_id}-${i}-2`
                                            )
                                            .append($('<i>').addClass(
                                                'ti ti-x'));

                                        label1.on('click', function() {
                                            $(this).removeClass(
                                                    'btn-outline-info'
                                                )
                                                .addClass(
                                                    'btn-info').css(
                                                    'outline',
                                                    'none');
                                            label2.removeClass(
                                                    'btn-danger')
                                                .addClass(
                                                    'btn-outline-danger'
                                                )
                                                .css('outline', '');
                                        });

                                        label2.on('click', function() {
                                            $(this).removeClass(
                                                    'btn-outline-danger'
                                                )
                                                .addClass(
                                                    'btn-danger')
                                                .css(
                                                    'outline',
                                                    'none');
                                            label1.removeClass(
                                                    'btn-info')
                                                .addClass(
                                                    'btn-outline-info'
                                                )
                                                .css('outline', '');
                                        });


                                        btnGroup.append(radioInput1, label1,
                                            radioInput2, label2);

                                        var statusCell = $('<td>').append(
                                            additionalStatusInput,
                                            btnGroup);
                                        statusRow.append(statusCell);


                                        // Remaks
                                        var additionalRemaksInput = $(
                                                '<input>')
                                            .addClass(
                                                'form-control form-control-plaintext form-control-sm'
                                            )
                                            .attr('type', 'text')
                                            .attr('name',
                                                `namaparaf[${subcategory.subcategory_id}][${i}]`
                                            )
                                            .attr('placeholder',
                                                'Nama & Paraf')
                                            .prop('', true);

                                        var additionalRemaksInputCell = $(
                                                '<td>')
                                            .append(additionalRemaksInput);
                                        remaksRow.append(
                                            additionalRemaksInputCell);
                                    }


                                    tableBody.append(planRow, realisasiRow,
                                        statusRow,
                                        remaksRow);





                                });






                            });


                        }

                    });


                },
                error: function(error) {
                    console.log(error);

                    swal.close(); // Tutup swal loading

                    // Tampilkan swal error
                    swal({
                        title: "Error",
                        text: "An error occurred while retrieving data.",
                        icon: "error"
                    });
                }
            });
        }



        function checkSelectedRow(department, year, machine_id) {
            console.log('department:', department);
            console.log('year:', year);
            console.log('machine_id:', machine_id);

            $.ajax({
                type: 'post',
                url: "{{ route('ceklistahunan.index') }}",
                success: function(data) {
                    console.log('Response Data:', data);

                    // Loop through the data and select radio buttons based on the status value
                    $.each(data, function(index, item) {
                        const subcategoryId = item.subcategory_id;
                        const plan = item.plan;
                        const realisasi = item.realisasi;
                        const status = item.status;
                        const statustpm = item.statustpm;
                        const bulan = item.bulan;
                        const nama = item.nama;

                        if (plan === '1') {
                            var tdElement = $(
                                    `input[name="plan[${subcategoryId}][${bulan}]"]`)
                                .closest('td');
                            tdElement.addClass('selected');
                        }

                        if (realisasi !== null) {
                            $(`input[name="realisasi[${subcategoryId}][${bulan}]"]`)
                                .val(realisasi);

                        } else {
                            $(`input[name="realisasi[${subcategoryId}][${bulan}]"][value=""]`)
                                .val(
                                    '');

                        }


                        if (statustpm !== null) {
                            $(`input[name="statustpm[${subcategoryId}][${bulan}]"]`)
                                .val(statustpm);

                        } else {
                            $(`input[name="statustpm[${subcategoryId}][${bulan}]"][value=""]`)
                                .val(
                                    statustpm);

                        }

                        // Select the radio button based on the status value
                        if (status === true) {
                            $(`input[name="status[${subcategoryId}][${bulan}]"][value="t"]`)
                                .prop('checked', true);
                        } else {
                            $(`input[name="status[${subcategoryId}][${bulan}]"][value="f"]`)
                                .prop('checked', true);
                        }
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }


        function save() {


            var formData = $('#form-data').serialize();
            console.log(formData)

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
                            url: "{{ route('getmasterEform.index') }}",
                            type: "get",
                            data: formData,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            dataType: "JSON",
                            success: function(response) {
                                console.log(response);

                                var selectedValues = $('#selectmachine').find(
                                        ':selected')
                                    .val();
                                // var statusData = response.data.status;

                                if (response.code == 200) {
                                    Swal.fire("Success!",
                                        String(
                                            response
                                            .message), 'success');
                                    setTimeout(() => {
                                        generateTable(selectedValues,
                                            totalDays());

                                    }, 2000);
                                } else {
                                    Swal.fire('Error : ' + String(response
                                            .code),
                                        String(
                                            response
                                            .message), 'warning');

                                }



                            },
                            error: function(xhr, text) {
                                console.log(xhr);
                                // Swal.fire('Error : ' + String(xhr.responseJSON
                                //         .code),
                                //     String(xhr
                                //         .responseJSON
                                //         .message), 'error');
                                // $(".btn-save").attr('disabled', false);
                                // $(".btn-save").html('Save');
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
