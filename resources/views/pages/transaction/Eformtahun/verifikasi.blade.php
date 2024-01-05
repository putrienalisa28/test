@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')


    <div class="container-fluid flex-grow-1 container-p-y">
        <form id="form-data">
            @csrf

            <div class="card ">
                <div class="accordion-body m-3">

                    <input hidden class="form-control col-md-2" type="text" name="idbilingual" value="" readonly />

                    <input hidden class="form-control col-md-2" type="text" name="jenisform" value="2" readonly />
                    <div class="col-md-4" id="btnsave">
                        <button type="button" class="btn btn-primary btn-save" onclick="save()"><i
                                class="fa fa-refresh"></i>
                            Save</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-print"></i> Print</button>
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
                                    <tr style="text-align:center;">
                                        <th style="width: 50px;" rowspan="3"> <img
                                                src="{{ asset('public/img/logo-01042022.png') }}"></th>
                                        <th style="width: 50px;">PT RIAU SAKTI UNITED PLANTATIONS</th>
                                        <th style="width: 50px;" rowspan="" name="nosurat">Dept/Bag
                                        </th>
                                    </tr>
                                    <tr style="text-align:center;">
                                        <th style="width: 50px;">
                                            <span style="display: block;">VERIFIKASI PERBAIKAN</span>

                                        </th>
                                        <th style="width: 50px;" rowspan="">
                                            <span style="display: block;">Tanggal</span>
                                            <span style="display: block;">HAL : 2 DARI 2</span>

                                        </th>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="accordion-body m-3">
                            <div class="table-responsive text-nowrap pt-3">
                                <table class="table table-bordered table-hover table-striped table-responsive">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="d-flex align-items-center">
                                                    <span
                                                        style="font-style: italic; display: block; margin-right: 40px;">Nama
                                                        Mesin</span>
                                                    <input type="text" name="" value=""
                                                        class="form-control form-control-sm">
                                                </div>
                                            </th>
                                            <th>
                                                <div class="d-flex align-items-center">
                                                    <span
                                                        style="font-style: italic; display: block; margin-right: 10px;">Area</span>
                                                    <input type="text" name="" value=""
                                                        class="form-control form-control-sm">
                                                </div>
                                            </th>
                                            <th>
                                                <div class="d-flex align-items-center">
                                                    <span
                                                        style="font-style: italic; display: block; margin-right: 55px;">Jam</span>
                                                    <input type="text" name="" value=""
                                                        class="form-control form-control-sm">
                                                </div>
                                            </th>
                                        </tr>


                                        <tr>
                                            <th>
                                                <div class="d-flex align-items-center">
                                                    <span
                                                        style="font-style: italic; display: block; margin-right: 95px;">Kode</span>
                                                    <input type="text" name="" value=""
                                                        class="form-control form-control-sm">
                                                </div>
                                            </th>
                                            <th>
                                                <div class="d-flex align-items-center">
                                                    <span
                                                        style="font-style: italic; display: block; margin-right: 10px;">Shift</span>
                                                    <input type="text" name="" value=""
                                                        class="form-control form-control-sm">
                                                </div>
                                            </th>
                                            <th>
                                                <div class="d-flex align-items-center">
                                                    <span
                                                        style="font-style: italic; display: block; margin-right: 10px;">Total
                                                        Jam</span>
                                                    <input type="text" name="" value=""
                                                        class="form-control form-control-sm">
                                                </div>
                                            </th>
                                        </tr>



                                </table>
                                <table class="table table-bordered" style="margin-bottom: 0px;">
                                    <tfoot>
                                        <tr>
                                            <th>
                                                <div class="d-flex align-items-center">
                                                    <span
                                                        style="font-style: italic; display: block; margin-right: 10px;">Jenis
                                                        Kerusakan</span>
                                                    <input type="text" name="" value=""
                                                        class="form-control form-control-sm">
                                                </div>
                                            </th>
                                        </tr>

                                    </tfoot>
                                </table>
                                <table class="table table-bordered" style="margin-bottom: 0px;">
                                    <tfoot>
                                        <tr>
                                            <th>
                                                <div class="d-flex align-items-center">
                                                    <span
                                                        style="font-style: italic; display: block; margin-right: 60px;">Tindakan</span>
                                                    <input type="text" name="" value=""
                                                        class="form-control form-control-sm">
                                                </div>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="accordion-body m-3">
                            <div class="table-responsive text-nowrap pt-3">
                                <table class="table table-responsive table-bordered table-striped table-hover"
                                    id="table1">
                                    <thead style="text-align:center;">
                                        <tr>
                                            <th class="small text-xs">
                                                <button type="button" class="btn btn-primary btn-xs"
                                                    onclick="tambahbaris()">
                                                    <i class="ti ti-plus"></i>
                                                </button>
                                            </th>
                                            <th colspan="4"class="tanggal">
                                                <span style="display: block;">Peralatan / Sparepart yang dibawa</span>

                                            </th>

                                        </tr>
                                        <tr>
                                            <th style="width: 50px;">No</th>
                                            <th style="width: 100px;">
                                                <span style="display: block;">Nama Peralatan / Sparepart</span>
                                            </th>
                                            <th class="tanggal">
                                                <span style="display: block;">Qty</span>
                                            </th>

                                        </tr>

                                    </thead>
                                    <tbody id="tbody1">

                                    </tbody>

                                </table>
                            </div>
                        </div>

                    </div>
                </div>



                <div class="col-6">
                    <div class="card">
                        <div class="accordion-body m-3">
                            <div class="table-responsive text-nowrap pt-3">
                                <table class="table table-responsive table-bordered table-striped table-hover"
                                    id="table2">
                                    <thead style="text-align:center;">
                                        <tr>
                                            <th class="small text-xs">
                                                <button type="button" class="btn btn-primary btn-xs"
                                                    onclick="tambahbaris2()">
                                                    <i class="ti ti-plus"></i>
                                                </button>
                                            </th>
                                            <th colspan="5">
                                                <span style="display: block;">Peralatan yang dikembalikan </span>
                                            </th>

                                        </tr>
                                        <tr>
                                            <th style="width: 50px;">No</th>
                                            <th style="width: 100px;">
                                                <span style="display: block;">Nama Peralatan </span>
                                            </th>
                                            <th class="tanggal">
                                                <span style="display: block;">Qty</span>
                                            </th>
                                            <th class="tanggal">
                                                <span style="display: block;">Keterangan</span>
                                            </th>
                                        </tr>

                                    </thead>
                                    <tbody id="tbody2">


                                    </tbody>

                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="accordion-body m-3">
                            <div class="table-responsive text-nowrap pt-3">
                                <table class="table table-responsive table-bordered table-striped table-hover"
                                    id="table3">
                                    <thead style="text-align:center;">
                                        <tr>
                                            <th class="small text-xs">
                                                <button type="button" class="btn btn-primary btn-xs"
                                                    onclick="tambahbaris3()">
                                                    <i class="ti ti-plus"></i>
                                                </button>
                                            </th>
                                            <th colspan="4"class="tanggal">
                                                <span style="display: block;">Sparepart yang dipasang/dipakai</span>

                                            </th>


                                        </tr>
                                        <tr>

                                            <th style="width: 50px;">No</th>
                                            <th style="width: 100px;">
                                                <span style="display: block;">Nama Sparepart</span>
                                            </th>
                                            <th class="tanggal">
                                                <span style="display: block;">Qty</span>
                                            </th>

                                        </tr>

                                    </thead>
                                    <tbody id="tbody3">

                                    </tbody>

                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="accordion-body m-3">
                            <div class="table-responsive text-nowrap pt-3">
                                <table class="table table-responsive table-bordered table-striped table-hover"
                                    id="table4">
                                    <thead style="text-align:center;">
                                        <tr>
                                            <th class="small text-xs">
                                                <button type="button" class="btn btn-primary btn-xs"
                                                    onclick="tambahbaris4()">
                                                    <i class="ti ti-plus"></i>
                                                </button>
                                            </th>
                                            <th colspan="5">
                                                <span style="display: block;">Sparepart yang rusak/sisa
                                                    sparepart</span>

                                            </th>
                                        </tr>
                                        <tr>
                                            <th style="width: 50px;">No</th>
                                            <th style="width: 100px;">
                                                <span style="display: block;">Nama Sparepart</span>
                                            </th>
                                            <th class="tanggal">
                                                <span style="display: block;">Qty</span>
                                            </th>
                                            <th class="tanggal">
                                                <span style="display: block;">Keterangan</span>
                                            </th>
                                        </tr>

                                    </thead>
                                    <tbody id="tbody4">

                                    </tbody>

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
                                <table class="table table-bordered table-hover table-striped table-responsive">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align: middle; text-align: center; width: 33.3%"><span
                                                    style="display: block;">Dibuat Oleh</span>

                                            </th>
                                            <th style="vertical-align: middle; text-align: center; width: 33.3%"><span
                                                    style="display: block;">Dicek Oleh</span>

                                            </th>
                                            <th style="vertical-align: middle; text-align: center; width: 33.3%"><span
                                                    style="display: block;">Diverivikasi Oleh</span>
                                            </th>

                                            </th>

                                        </tr>
                                        <tr>
                                            <th height="100" style="vertical-align: middle; text-align: center">

                                            </th>
                                            <th height="100" style="vertical-align: middle; text-align: center">

                                            </th>
                                            <th height="100" style="vertical-align: middle; text-align: center">

                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><span style="display: block;">Nama</span>

                                            </td>
                                            <td><span style="display: block;">Nama</span>

                                            </td>
                                            <td><span style="display: block;">Nama</span>

                                            </td>

                                        </tr>
                                        <tr>
                                            <td><span style="display: block;">Jabatan</span>

                                            </td>
                                            <td><span style="display: block;">Jabatan</span>

                                            </td>
                                            <td><span style="display: block;">Jabatan</span>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <label for="getbulan"
                                                        style="font-style: italic; display: block; margin-right: 10px;">Tanggal</label>
                                                    <input class="form-control" type="date" name="month"
                                                        value="2023-06-01" id="getbulan" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <label for="getbulan"
                                                        style="font-style: italic; display: block; margin-right: 10px;">Tanggal</label>
                                                    <input class="form-control" type="date" name="month"
                                                        value="2023-06-01" id="getbulan" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <label for="getbulan"
                                                        style="font-style: italic; display: block; margin-right: 10px;">Tanggal</label>
                                                    <input class="form-control sm-4" type="date" name="month"
                                                        value="2023-06-01" id="getbulan" />
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                                <table class="table table-bordered" style="margin-bottom: 0px;">
                                    <tfoot>
                                        <tr>

                                            <td>
                                                <span style="font-style: italic;"><span style="display: block;">Tanggal
                                                        Efektif : 01 April 2023</span>

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
            </div>



        </form>
    </div>

    <!-- Your HTML code here -->

    <script>
        function tambahbaris() {
            // Dapatkan referensi tbody
            var tbody = document.getElementById("tbody1");

            // Buat elemen-elemen baris yang baru
            var newRow = document.createElement("tr");

            // Perulangan untuk membuat 3 sel pada setiap baris
            for (var i = 0; i < 3; i++) {
                var newCell = document.createElement("td");
                var newText = document.createTextNode("Isi Baru");

                // Tambahkan teks ke sel baru
                newCell.appendChild(newText);

                // Tambahkan sel baru ke dalam baris
                newRow.appendChild(newCell);
            }

            // Tambahkan baris baru ke dalam tbody
            tbody.appendChild(newRow);
        }


        function tambahbaris2() {
            // Dapatkan referensi tabel dan tbody
            var table = document.getElementById("table2");
            var tbody = document.getElementById("tbody2");

            // Buat elemen-elemen baris yang baru
            var newRow = document.createElement("tr");
            var newCell = document.createElement("td");
            var newText = document.createTextNode("Isi Baru");

            // Tambahkan teks ke sel baru
            newCell.appendChild(newText);

            // Tambahkan sel baru ke baris baru
            newRow.appendChild(newCell);

            // Tambahkan baris baru ke tbody
            tbody.appendChild(newRow);
        }

        function tambahbaris3() {
            // Dapatkan referensi tabel dan tbody
            var table = document.getElementById("table3");
            var tbody = document.getElementById("tbody3");

            // Buat elemen-elemen baris yang baru
            var newRow = document.createElement("tr");
            var newCell = document.createElement("td");
            var newText = document.createTextNode("Isi Baru");

            // Tambahkan teks ke sel baru
            newCell.appendChild(newText);

            // Tambahkan sel baru ke baris baru
            newRow.appendChild(newCell);

            // Tambahkan baris baru ke tbody
            tbody.appendChild(newRow);
        }

        function tambahbaris4() {
            // Dapatkan referensi tabel dan tbody
            var table = document.getElementById("table4");
            var tbody = document.getElementById("tbody4");

            // Buat elemen-elemen baris yang baru
            var newRow = document.createElement("tr");
            var newCell = document.createElement("td");
            var newText = document.createTextNode("Isi Baru");

            // Tambahkan teks ke sel baru
            newCell.appendChild(newText);

            // Tambahkan sel baru ke baris baru
            newRow.appendChild(newCell);

            // Tambahkan baris baru ke tbody
            tbody.appendChild(newRow);
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
                            url: '{{ route('bilingual.storebill') }}',
                            type: "POST",
                            data: formData,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            dataType: "JSON",
                            success: function(response) {
                                console.log(response);

                            },
                            error: function(xhr, text) {
                                console.log(xhr);
                                Swal.fire('Error : ' + String(xhr.responseJSON
                                        .code),
                                    String(xhr
                                        .responseJSON
                                        .message), 'error');
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
