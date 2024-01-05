@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')
    <style>
        .btn-xs {
            /* padding: 0.15rem 0.1rem;
            line-height: 0.1;
        }

        .no-outline {
            outline: none;
        }
    </style>

    <div class="container-fluid flex-grow-1 container-p-y">
        <form id="form-data">
            @csrf


            <div class="row">
                <div class="col-12 col-xl-12 col-md-12">
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
                                            <h6 class="mb-0">Date</h6>
                                        </div>
                                        <div class="col-md-10" id="bulanContainer">
                                            <input class="form-control" type="date" name="month" value="2023-06-01"
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

                                            <button type="button" class="btn btn-success" onclick="print()"><i
                                                    class="fa fa-print"></i>
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
                                                src="{{ asset('img/logo-01042022.png') }}">
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
                                                PENGGANTIAN</span>
                                            <span><em>(MAINTENANCE CHECKLIST AND REPAIR/REPLACEMENT
                                                    RECORD)</em></span>
                                        </th>
                                        <th style="width: 100px;" rowspan="">
                                            <span style="display: block;">HAL : 1 DARI 2</span>
                                            <span><em>(Pages) 1 of 2</em></span>
                                        </th>
                                    </tr>
                                </table>

                                <table class="table table-responsive table-bordered table-striped table-hover">
                                    <tr>
                                        <th style="width: 50px;"> <span style="display: block;">
                                                Nama Peralatan/Mesin
                                            </span>
                                            <div class="d-flex align-items-center">
                                                <span><em>(Name of Equipment/ Machine)</em></span>

                                                <input type="text" name="peralatan" id="peralatan"value=""
                                                    class="form-control  form-control-sm" readonly>
                                            </div>
                                        </th>
                                        <th style="width: 50px;"> <span style="display: block;">Kode (Code) :
                                                <input type="text" name="kode" value="" id="code"
                                                    class="form-control form-control-sm" required>
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
                                            <th class="tanggal">Tanggal (Date)</th>
                                            <th> <span style="display: block;">KETERANGAN</span>
                                                <span><em>(Remarks)</em></span>
                                            </th>
                                        </tr>
                                        <tr id="tanggalkalender">

                                        </tr>
                                    </thead>
                                    <tbody id="tableBody">
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
                                                    style="display: block;">Diketahui Oleh</span>
                                                <span><em>(Acknowledged by)</em></span>
                                            </th>

                                        </tr>
                                        <tr>
                                            <th height="100" style="vertical-align: middle; text-align: left"
                                                rowspan="2">
                                                <img src="{{ asset('img/rmk.png') }}">
                                            </th>
                                            <th height="100" style="vertical-align: middle; text-align: center">
                                            </th>

                                        </tr>

                                    </thead>
                                    <tbody>


                                        <tr>
                                            <td><span style="display: block;">
                                            </td>
                                            <th colspan="2">
                                                <div class="d-flex align-items-center ">
                                                    <span
                                                        style="font-style: italic; display: block; margin-right: 10px;">Nama</span>
                                                    <select id="selectnama" class="select2 form-select col-md-10"
                                                        name="acknowledged_id">
                                                        <option value="">Select</option>
                                                    </select>
                                                    <input hidden id="acknowname" class="form-control" type="text"
                                                        name="acknowledged_name" value="" readonly />
                                                </div>
                                                <span><em>(Name)</em></span>
                                            </th>

                                        </tr>
                                        <tr>
                                            <td><span style="display: block;">
                                            </td>
                                            <th>
                                                <div class="d-flex align-items-center"><span
                                                        style="font-style: italic; display: block; margin-right: 10px;">Jabatan</span>
                                                    <input id="jabatan" class="form-control" type="text"
                                                        name="jabatan" value="" readonly />
                                                </div>
                                                <span><em>(Position)</em>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td><span style="display: block;"></span></td>
                                            <th>
                                                <div class="d-flex align-items-center">
                                                    <label for="getbulan"
                                                        style="font-style: italic; display: block; margin-right: 10px;">Tanggal</label>
                                                    <input class="form-control" type="date" name="acknowledged_date"
                                                        value="2023-06-01" />


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
                                                <span style="font-style: italic;" class="pull-right">FRM-SYS-015a-02
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

            //  $('#footer').hide();
            $('#btnsave button').prop('disabled', true);
            $('#getbulan').prop('disabled', true);
            $('#selectmachine').prop('disabled', true);
            // // Fungsi untuk menangani perubahan bulan

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
                title: 'Loading',
                text: 'Please wait...',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });
            $.ajax({
                url: "{{ route('getdepttomesin.index') }}",
                type: 'post',
                data: {
                    department: department
                },
                dataType: 'JSON',
                success: function(data) {
                    console.log(data);

                    // Menghapus opsi yang ada
                    $('#peralatan').val("");
                    $('#selectnama').empty();
                    // $('#selectmachine').empty();
                    $('#jabatan').val("");



                    // Menambahkan opsi yang sesuai berdasarkan respons objek
                    if (Array.isArray(data.listTk.Results)) {
                        data.listTk.Results.forEach(function(item) {
                            $('#selectnama').append('<option value="' + item.personalid + '">' +
                                item.nama + '</option>');
                        });


                        $('#selectnama').change(function() {
                            var selectednama = $(this).val();

                            console.log(data.listTk.Results);
                            var selectedItem = data.listTk.Results.find(function(obj) {
                                return obj.personalid == selectednama;
                            });

                            if (selectedItem) {
                                $('#jabatan').val(selectedItem.jabatan_nama);
                                $('#acknowname').val(selectedItem.nama);
                            } else {
                                $('#jabatan').val('');
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
            const month = date.getMonth() + 1;
            const daysInMonth = new Date(year, month, 0).getDate();


            let dateRange = '';
            for (let day = 1; day <= daysInMonth; day++) {
                const dateObj = new Date(year, month - 1, day);
                const dayOfWeek = dateObj.getDay();
                const isSunday = dayOfWeek === 0;

                if (isSunday) {
                    dateRange += `<th class="small-cell" style="color: red;">${day}</th>`;
                } else {
                    dateRange += `<th class="small-cell">${day}</th>`;
                }
            }

            const colspanValue = daysInMonth > 0 ? daysInMonth : 1;
            const tableRow = `<tr>${dateRange}</tr>`;
            tanggalkalender.innerHTML = tableRow;
            $('.tanggal').attr('colspan', daysInMonth);

            var selectedValues = $('#selectmachine').find(':selected').val();
            var department = $("#selectdept").find(":selected").val();



            if (selectedValues != '') {
                generateTable(selectedValues, daysInMonth, department, month, year)
                checkSelectedRow(department, month, year, selectedValues)
            }


            //untuk mangambil no surat
            const romanNumeralMap = {
                1: 'I',
                2: 'II',
                3: 'III',
                4: 'IV',
                5: 'V',
                6: 'VI',
                7: 'VII',
                8: 'VIII',
                9: 'IX',
                10: 'X',
                11: 'XI',
                12: 'XII',
                // Add more mappings for the remaining months if needed
            };
            const romanNumeral = romanNumeralMap[month] || 'Unknown';


            var inputElement = document.getElementById("nosurat");
            inputElement.value = "NO : PR/" + department + "/" + romanNumeral + "/" + year;


            return daysInMonth;

        }

        function generateTable(selectedValues, daysInMonth, department, month, year) {
            var tableBody = $('#tableBody');
            tableBody.empty();

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            // var department = $("#selectdept").find(":selected").val();

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
                url: "{{ route('getmasterEform.index') }}",
                dataType: "json",
                success: function(data) {
                    console.log(data);

                    swal.close(); // Tutup swal loading


                    // Hapus isi dari tableBody
                    // tableBody.empty();

                    // Loop melalui data untuk mencocokkan dengan selectedValues
                    $.each(data, function(index, item) {
                        if (selectedValues.includes(item.machine_id)) {
                            checkSelectedRow(department, month, year, item.machine_id)

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
                                    subIndex, subcategory) {
                                    var subcategoryRow = $('<tr>');
                                    subcategoryRow.append($('<td>'));
                                    subcategoryRow.append($('<td hidden>')
                                        .append(
                                            $('<input>', {
                                                type: 'hidden',
                                                value: subcategory
                                                    .subcategory_id,
                                                name: 'subcategory_id[]'
                                            })
                                        ));

                                    subcategoryRow.append($('<td>').text(
                                        subcategory.subcategory_name
                                    ));


                                    for (let day = 1; day <=
                                        daysInMonth; day++) {


                                        var btnGroup = $('<div>').addClass(
                                            'btn-group').attr({
                                            role: 'group',
                                            'aria-label': 'Basic radio toggle button group'
                                        });

                                        var radioInput1 = $('<input>')
                                            .attr({
                                                type: 'radio',
                                                class: 'btn-check',
                                                name: `status[${subcategory.subcategory_id}][${day}]`,
                                                id: `btnradio-${subcategory.subcategory_id}-${day}`,
                                                autocomplete: 'off',
                                                // value: `t[${subcategory.subcategory_id}][${day}]`,
                                                value: `t`,
                                            });

                                        var label1 = $('<label>').addClass(
                                                'btn btn-outline-info btn-xs '
                                            ).attr('for',
                                                `btnradio-${subcategory.subcategory_id}-${day}`
                                            )
                                            .append($('<i>').addClass(
                                                'ti ti-check'));


                                        var radioInput2 = $('<input>')
                                            .attr({
                                                type: 'radio',
                                                class: 'btn-check',
                                                name: `status[${subcategory.subcategory_id}][${day}]`,
                                                id: `btnradio-${subcategory.subcategory_id}-${day + daysInMonth}`,
                                                autocomplete: 'off',
                                                // value: `f[${subcategory.subcategory_id}][${day}]`,
                                                value: `f`,
                                            });


                                        var label2 = $('<label>').addClass(
                                                'btn btn-outline-danger btn-xs'
                                            ).attr('for',
                                                `btnradio-${subcategory.subcategory_id}-${day + daysInMonth}`
                                            )
                                            .append($('<i>').addClass(
                                                'ti ti-x'));

                                        label1.on('click', function() {
                                            $(this).toggleClass(
                                                'btn-info btn-outline-info'
                                            );
                                            $(this).css('outline',
                                                'none');

                                            // Nonaktifkan label 2
                                            label2.off('click');
                                        });

                                        label2.on('click', function() {
                                            $(this).toggleClass(
                                                'btn-danger btn-outline-danger'
                                            );
                                            $(this).css('outline',
                                                'none');

                                            // Nonaktifkan label 1
                                            label1.off('click');
                                        });
                                        btnGroup.append(radioInput1, label1,
                                            radioInput2, label2);
                                        subcategoryRow.append($('<td>')
                                            .append(btnGroup));



                                    }

                                    var additionalTextarea = $(
                                            '<textarea>')
                                        .addClass(
                                            'form-control form-control-plaintext form-control-sm'
                                        )
                                        .attr(
                                            'name', 'remaks[]');
                                    subcategoryRow.append($('<td>')
                                        .append(
                                            additionalTextarea));


                                    tableBody.append(subcategoryRow);
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

        function totalDays() {
            const inputBulan = document.getElementById('getbulan');
            const selectedMonth = inputBulan.value;
            const date = new Date(selectedMonth);
            const year = date.getFullYear();
            const month = date.getMonth() + 1;
            const daysInMonth = new Date(year, month, 0).getDate();

            return {
                year,
                month,
                daysInMonth
            };


        }

        function checkSelectedRow(department, month, year, machine_id) {

            $.ajax({
                url: "{{ route('ceklisharian.index') }}",
                type: 'post',
                data: {
                    department: department,
                    month: month,
                    year: year,
                    machine_id: machine_id
                },


                success: function(data) {
                    console.log('Response Data:', data);

                    // Loop through the data and select radio buttons based on the status value
                    $.each(data, function(index, item) {

                        const subcategoryId = item.sub_category_id;
                        const days = item.days;
                        const status = item.status;

                        // Select the radio button based on status value
                        if (status === true) {
                            $(`input[name="status[${subcategoryId}][${days}]"][value="t"]`)
                                .attr(
                                    'checked',
                                    true);
                        } else {
                            $(`input[name="status[${subcategoryId}][${days}]"][value="f"]`)
                                .attr(
                                    'checked',
                                    true);

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

            var codeValue = $('#code').val().trim();
            if (codeValue === '') {
                alert('Code cannot be null.');
                return; // Stop further execution
            }

            var department = $("#selectdept").find(":selected").val();
            console.log('department:', department);
            var selectedValues = $('#selectmachine').find(':selected').val();
            console.log('selectedValues:', selectedValues);
            var {
                year,
                month,
                daysInMonth
            } = totalDays();
            console.log('year:', year);
            console.log('month:', month);
            console.log('daysInMonth:', daysInMonth);

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
                            url: '{{ route('formsys.store') }}',
                            type: "POST",
                            data: formData,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            dataType: "JSON",
                            success: function(response) {
                                console.log(response);

                                // var selectedValues = $('#selectmachine').find(
                                //         ':selected')
                                //     .val();



                                if (response.code == 200) {
                                    Swal.fire("Success!",
                                        String(
                                            response
                                            .message), 'success');
                                    setTimeout(() => {

                                        generateTable(department, month,
                                            year,
                                            selectedValues
                                        )
                                        // generateTable(selectedValues,
                                        //     department, month, year)

                                    }, 2000);
                                } else {
                                    Swal.fire('Error : ' + String(response.code),
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
