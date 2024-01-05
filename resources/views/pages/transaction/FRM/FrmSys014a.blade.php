@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')
    <style>
        .custom-swal-container {
            margin: 5px;
        }

        .custom-swal-popup {
            margin: 1px;
        }

        .custom-swal-button {
            margin: 5px;
        }

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
                                                <select id="selectdept" class="select2 form-select" name="department"
                                                    onchange="getDept()">
                                                    <option value=""></option>
                                                    @foreach ($department as $dt)
                                                        <option value="{{ $dt->DeptName }}">{{ $dt->DeptName }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="d-flex gap-2 align-items-center">
                                                <div class="badge rounded bg-label-danger mb-1 p-1">
                                                    <i class="ti ti-calendar-time ti-sm"></i>
                                                </div>
                                                <h6 class="mb-0">Nama Bagian</h6>
                                            </div>
                                            <div class="col-md-10" id="test3">
                                                <input type="text" id="namabagian" class="form-control" name="namabagian" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4" id="select2">
                                            <div class="d-flex gap-2 align-items-center">
                                                <div class="badge rounded bg-label-success mb-1 p-1">
                                                    <i class="ti ti-settings ti-sm"></i>
                                                </div>
                                                <h6 class="mb-0">Area</h6>
                                            </div>
                                            <div class="col-md-10">
                                                <select id="selectarea" class="select2 form-select" name="area" onchange="getMachine()" required>
                                                    <option value=""></option>
                                                    <option value="1">FILLING</option>
                                                    <option value="2">PROCESSING</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4 mt-3">
                                            <div class="col-md-12" id="btnsave">
                                                <button type="button" class="btn btn-primary btn-save" onclick="save()"><i
                                                        class="fa fa-refresh"></i>
                                                    Save</button>
                                                <div class="col-md-1">
                                                    <div id="btnkomplit">
                                                    </div>
                                                </div>
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
                    <div class="col-md-12">
                        <div class="card p-4">
                            {{-- <div class="row m-1 mt-4">
                                <div class="col-md-2">
                                    <select id="selectdept" class="select2 form-select" name="department"
                                        onchange="getDept()">
                                        <option value=""></option>
                                        @foreach ($department as $dt)
                                            <option data-name="{{ $dt->DeptName }}" value="{{ $dt->DeptID }}">{{ $dt->DeptName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2" id="test3">
                                    <input type="text" id="namabagian" class="form-control" name="namabagian"  readonly>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" id='btn-tes' class="btn btn-primary me-sm-3 me-1 btn-save"
                                        onclick="save()">Save</button>
                                </div>
                                <div class="col-md-1">
                                    <div id="btnkomplit">
                                    </div>
                                </div>
                            </div>
                            <br> --}}
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:120px;" rowspan="3"
                                            style="vertical-align: middle; text-align: center"><img
                                                src="{{ asset('public/img/logo-01042022.png') }}" style="width: 100px;">
                                        </th>
                                        <th style="vertical-align: middle; text-align: center;">PT RIAU SAKTI UNITED
                                            PLANTATION</th>
                                        <th rowspan="3" style="vertical-align: middle; width: 200px;">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>No : </label>
                                                        <input id="nomor" class="form-control" type="text"
                                                            name="nomor" readonly>
                                                        <span class="text-danger no_ref_error validation"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Periode </label>
                                                        <input id="tanggal" class="form-control" type="date"
                                                            name="tanggal" onchange="getNameMonth(this.value)" required>
                                                        <input id="headerid" class="form-control" type="hidden"
                                                            name="headerid" required>
                                                        <input id="kode_periode" type="hidden" name="kode_periode">
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th scope="col" style="vertical-align:middle; text-align: center;">
                                            <p class="fonthead"></p>{{ $forminput['form_judul'] }}
                                            <br>{{ $forminput['form_bilingual'] }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="3" style="vertical-align: middle; text-align: left">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <label for="exampleFormControlInput1"
                                                            class="col-sm-4 col-form-label text-sm-end">Nama Peralatan/Mesin
                                                            :</label>
                                                        <div class="col-sm-6"  id="mesin_">
                                                            <input type="text" id="id_peralatan" class="form-control" name="id_peralatan" readonly>
                                                            {{-- <select id="id_peralatan" class="select2 form-select"
                                                                name="id_peralatan" onchange="ambildata();">
                                                                <option value=""></option>
                                                                @foreach ($peralatan as $item)
                                                                    <option value="{{ $item['machine_id'] }}">
                                                                        {{ $item['machine_name'] }}</option>
                                                                @endforeach
                                                            </select> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <label for="exampleFormControlInput1"
                                                            class="col-sm-4 col-form-label text-sm-end">Kode (Code)
                                                            :</label>
                                                        <div class="col-sm-4">
                                                            <input type="input" x-model="kode" name="kode"
                                                                id="kode" placeholder="Enter Code"
                                                                class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <label for="exampleFormControlInput1"
                                                            class="col-sm-4 col-form-label text-sm-end">(Name of Equipment/
                                                            Machine) </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br><br>
                            <div class="card-datatable table-responsive pt-3">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th rowspan="2"
                                                style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px; background-color: white; z-index: 50">
                                                NO</th>
                                            <th rowspan="2"
                                                style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px; background-color: white; z-index: 50">
                                                NAMA PERALATAN</th>
                                            <th rowspan="2"
                                                style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px; background-color: white; z-index: 50">
                                                FREKUENSI<br>(Frequency)</th>
                                            <th rowspan="2"
                                                style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px; background-color: white; z-index: 50">
                                                P/ R/ S</th>
                                            <th colspan="5"
                                                style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px; background-color: white; z-index: 50">
                                                MINGGU KE-</th>
                                        </tr>
                                        <th
                                            style="vertical-align:middle; text-align: center; position: sticky; top: 38px; left: 300px; background-color: white; z-index: 101">
                                            I</th>
                                        <th
                                            style="vertical-align:middle; text-align: center; position: sticky; top: 38px; left: 300px; background-color: white; z-index: 101">
                                            II</th>
                                        <th
                                            style="vertical-align:middle; text-align: center; position: sticky; top: 38px; left: 300px; background-color: white; z-index: 101">
                                            III</th>
                                        <th
                                            style="vertical-align:middle; text-align: center; position: sticky; top: 38px; left: 300px; background-color: white; z-index: 101">
                                            IV</th>
                                        <th
                                            style="vertical-align:middle; text-align: center; position: sticky; top: 38px; left: 300px; background-color: white; z-index: 101">
                                            V</th>
                                        <tr>
                                        </tr>
                                    </thead>
                                    <tbody id="data-table-body">
                                    </tbody>
                                </table>
                            </div>
                            <table class="table table-bordered table-hover table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <th height="300" style="vertical-align: middle; text-align: center; width: 33.3%">
                                            <div class="row">
                                                <div class="col-md-6"
                                                    style="vertical-align: middle; text-align: left; text-transform: capitalize;">
                                                    <label> Keterangan :</label><br>
                                                    <label>P = Plan/ Rencana diisi tinta hitam/bold warna hitam tiap awal
                                                        tahun</label>
                                                    <label><span
                                                            style="font-style: italic;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(plan
                                                            is filled by black ink /black bold every beginning of the
                                                            year)</span></label>
                                                    <label>R = Realization/ Realisasi diisi dengan tanggal setiap selesai
                                                        pelaksanaan</label>
                                                    <label><span
                                                            style="font-style: italic;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(realization
                                                            is filled by date after the implementation)</span></label><br>
                                                    <label>S = Status ok = √ , no ok = x</label>
                                                    <label><span
                                                            style="font-style: italic;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(status
                                                            ok/no ok merujuk ke prosedur/panduan kerja masing-masing
                                                            dept/bagian)</span></label>
                                                </div>



                                                <div class="col-md-6">
                                                    <table class="table table-bordered table-hover table-striped"
                                                        style="vertical-align: middle; text-align: left; text-transform: capitalize;">
                                                        <thead>
                                                            <tr>
                                                                <th style="vertical-align: middle; text-align: center;">
                                                                    DIBUAT OLEH</th>
                                                                <th style="vertical-align: middle; text-align: center;">
                                                                    DISETUJUI OLEH</th>
                                                            </tr>
                                                            <tr>
                                                                <th height="100"
                                                                    style="vertical-align: middle; text-align: center">
                                                                </th>
                                                                <th height="100"
                                                                    style="vertical-align: middle; text-align: center">
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td style="vertical-align: middle; text-align: left;">Nama
                                                                    (Name) &nbsp;&nbsp;&nbsp;:  
                                                                    <select id="app1_by" class="select2 form-select"
                                                                    name="app1_by" onchange="getjabatan()">
                                                                    <option value=""></option>
                                                                    @foreach ($jabatan as $nama)
                                                                            <option data-jabatan="{{ $nama->JabatanName }}" data-regno="{{ $nama->RegNo }}" data-idjabatan="{{ $nama->JabatanID }}"
                                                                                value="{{ $nama->NAMA }}">{{ $nama->NAMA }}</option>
                                                                        @endforeach
                                                                </select>
                                                                </td>
                                                                <td style="vertical-align: middle; text-align: left;">Nama
                                                                    &nbsp;&nbsp;&nbsp;: 
                                                                    <select id="app2_by" class="select2 form-select"
                                                                    name="app2_by" onchange="getjabatan2()">
                                                                    <option value=""></option>
                                                                    @foreach ($jabatan2 as $nama2)
                                                                            <option data-jabatan2="{{ $nama2->JabatanName }}" data-regno2="{{ $nama2->RegNo }}" data-idjabatan2="{{ $nama2->JabatanID }}"
                                                                                value="{{ $nama2->NAMA }}">{{ $nama2->NAMA }}</option>
                                                                        @endforeach
                                                                </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="vertical-align: middle; text-align: left;">
                                                                    Jabatan (position):
                                                                    <input type="text" id="app1_jabatan" class="form-control" name="app1_jabatan"  readonly>
                                                                    <input type="hidden" id="regno" class="form-control" name="regno">
                                                                    <input type="hidden" id="idjabatan" class="form-control" name="idjabatan">
                                                                </td>
                                                                <td style="vertical-align: middle; text-align: left;">
                                                                    Jabatan (position):
                                                                    <input type="text" id="app2_jabatan" class="form-control" name="app2_jabatan"  readonly>
                                                                    <input type="hidden" id="regno2" class="form-control" name="regno2">
                                                                    <input type="hidden" id="idjabatan2" class="form-control" name="idjabatan2">
                                                                </td>                                                                
                                                            </tr>
                                                            <tr>
                                                                <td style="vertical-align: middle; text-align: left;">
                                                                    Tanggal (date) :</td>
                                                                <td style="vertical-align: middle; text-align: left;">
                                                                    Tanggal :</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
         </form>
    </div>
    <script>
        $('.btn-update').click(function(event) {
            $('#modal-form').modal('show');
        });
        function Select2On()
        {
            $(".select2").select2();
        }

        function getDataHeader(data) {
            console.log(data)
            $('#kode_periode_edit').val(data.substring(0, 4) + data.substring(5, 7));
        }

        function save() {
            var formData = $('#form-data').serialize();
            swAlertConfirm('{{ route('frm.store') }}', undefined, undefined, formData);
        }

        function komplit() {
            var formData = $('#form-data').serialize();
            swAlertConfirm('{{ route('frm.komplit') }}', undefined, undefined, formData);
        }

        function getDept() {
            $("#nomor").val("");
            $("#kode_periode").val("");
            $("#tanggal").val("");

                var dept_id = $('#selectdept').val();
                var modalData = $('#mdl_table').serialize();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                // Set the CSRF token as a default request header
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                // Kosongkan data tabel sebelum melakukan permintaan Ajax
                $("#data-table-body").empty();

                // Tampilkan modal search
                $('#modal_search').modal("show");

                $.ajax({
                    url: "{{ route('frm.getDeptPayroll') }}/",
                    type: "post",
                    data: {
                        dept_id: dept_id
                    },
                    success: function(data) {

                        $("#test3").html('<select class="form-select select2" id="namabagian" name="namabagian" required></select>');
                        var opt = '<option value="">--Pilih Bagian--</option>';
                        for(var i=0;i<data.result.length;i++){
                            if(data.result.length == 1)
                            {
                                opt = '<option value="'+data.result[i].NamaBagian+'">'+data.result[i].NamaBagian+'</option>'
                            }else{
                                opt = opt+'<option value="'+data.result[i].NamaBagian+'">'+data.result[i].NamaBagian+'</option>'
                            }
                        }
                        $("#namabagian").html(opt);
                        Select2On();
                      
                    },
                    error: function(xhr, text) {

                        // Menghapus elemen loading jika terjadi kesalahan pada permintaan Ajax
                        // $("#loading-row").remove();
                        $("#modal_search").modal('hide')
                        // swAlert('error', String(xhr.responseJSON.message), xhr.responseJSON
                        // .code);
                        Swal.fire(String(xhr.responseJSON.code), String(xhr.responseJSON
                                .message),
                            'error')


                        console.log((xhr)); // Tampilkan pesan error dalam konsol
                        console.log(text); // Tampilkan pesan error dalam konsol
                    }
                });
        }

        function getMachine(){
            $("#id_peralatan").empty();
            var nama_bagian = $('#namabagian').val();
            var area = $('#selectarea').val();
            var modalData = $('#mdl_table').serialize();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            // Set the CSRF token as a default request header
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            // Kosongkan data tabel sebelum melakukan permintaan Ajax
            $("#data-table-body").empty();

            // Tampilkan modal search
            $('#modal_search').modal("show");

            $.ajax({
                url: "{{ route('frm.getMachineByMaster') }}/",
                type: "post",
                data: {
                    nama_bagian: nama_bagian,
                    area: area
                },
                success: function(data) {
                    console.log(data);

                    $("#mesin_").html('<select class="form-select select2" id="id_peralatan" name="id_peralatan" onchange="ambildata();" required></select>');
                    var opt = '<option value="">--Pilih Mesin--</option>';
                    for(var i=0;i<data.result.length;i++){
                        if(data.result.length == 1)
                        {
                            opt = '<option value="'+data.result[i].machine_id+'">'+data.result[i].machine_name+'</option>'
                        }else{
                            opt = opt+'<option value="'+data.result[i].machine_id+'">'+data.result[i].machine_name+'</option>'
                        }
                    }
                    $("#id_peralatan").html(opt);
                    Select2On();
                    
                },
                error: function(xhr, text) {

                    // Menghapus elemen loading jika terjadi kesalahan pada permintaan Ajax
                    // $("#loading-row").remove();
                    $("#modal_search").modal('hide')
                    // swAlert('error', String(xhr.responseJSON.message), xhr.responseJSON
                    // .code);
                    Swal.fire(String(xhr.responseJSON.code), String(xhr.responseJSON
                            .message),
                        'error')


                    console.log((xhr)); // Tampilkan pesan error dalam konsol
                    console.log(text); // Tampilkan pesan error dalam konsol
                }
            });
        }

        function getNameMonth(data) {
            var Bln;
            var Month;
            var Year = data.substring(0, 4);
            var dept = $('#selectdept').val();
            console.log(data.substring(5, 7))
            $('#kode_periode').val(data.substring(0, 4) + data.substring(5, 7));
            switch (data.substring(5, 7)) {
                case '01':
                    Month = 'Januari';
                    Bln = '1';
                    Bln_romawi = 'I';
                    break;
                case '02':
                    Month = 'Februari';
                    Bln = '2';
                    Bln_romawi = 'II';
                    break;
                case '03':
                    Month = 'Maret';
                    Bln = '3';
                    Bln_romawi = 'III';
                    break;
                case '04':
                    Month = 'April';
                    Bln = '4';
                    Bln_romawi = 'IV';
                    break;
                case '05':
                    Month = 'Mei';
                    Bln = '5';
                    Bln_romawi = 'V';
                    break;
                case '06':
                    Month = 'Juni';
                    Bln = '6';
                    Bln_romawi = 'VI';
                    break;
                case '07':
                    Month = 'Juli';
                    Bln = '7';
                    Bln_romawi = 'VII';
                    break;
                case '08':
                    Month = 'Agustus';
                    Bln = '8';
                    Bln_romawi = 'VIII';
                    break;
                case '09':
                    Month = 'September';
                    Bln = '9';
                    Bln_romawi = 'IX';
                    break;
                case '10':
                    Month = 'Oktober';
                    Bln = '10';
                    Bln_romawi = 'X';
                    break;
                case '11':
                    Month = 'November';
                    Bln = '11';
                    Bln_romawi = 'XI';
                    break;
                case '12':
                    Month = 'Desember';
                    Bln = '12';
                    Bln_romawi = 'XII';
                    break;
            }
            $("#txtbulan").val(Bln)
            $("#periodeaudit").val(Month + " " + Year)
            $("#nomor").val('PBR/' + dept + '/' + Bln_romawi + '/' + Year)
        }

        function ambildata() {
            var tableBody = $('#data-table-body');
            tableBody.empty();
            var id_peralatan = document.getElementById("id_peralatan").value;
            var dept = document.getElementById("selectdept").value;
            var periode = document.getElementById("kode_periode").value;
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            // Set the CSRF token as a default request header
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            $.ajax({
                url: "{{ route('frm.getDataMaster') }}/",
                type: "post",
                data: {
                    id_peralatan: id_peralatan
                },
                beforeSend: function() {
                    // Menampilkan elemen loading sebelum permintaan Ajax dimulai
                    var loadingRow = $(
                        "<tr class='text-center' id='loading-row'><td colspan='4'>Loading...</td></tr>"
                    );
                    $("#data-table-body").append(loadingRow);
                },
                success: function(data) {
                    // Menghapus elemen loading setelah permintaan Ajax berhasil
                    $("#loading-row").remove();

                    // Kode lainnya untuk menampilkan data yang diterima
                    $.each(data.result, function(index, item) {
                        // console.log(item)
                        if (id_peralatan.includes(item.machine_id)) {
                            checkSelectedRow(dept, periode, item.machine_id);

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
                                var alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                var categoryRow = $('<tr>');
                                categoryRow.append($('<td>').text(alphabet[(categoryIndex + 1) -
                                    1]));
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

                                $.each(category.form015asubcategory, function(subIndex,
                                    subcategory) {
                                    var subcategoryRow = $('<tr>');

                                    var hiddenInput = $('<input>', {
                                        type: 'hidden',
                                        value: subcategory.subcategory_id,
                                        name: 'subcategory_id[]'
                                    }).attr('hidden', true);

                                    var hiddenCell = $('<td>').append(hiddenInput);

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
                                    subcategoryRow.append(subcategoryNameTD);
                                    tableBody.append(subcategoryRow);


                                    var subcategoryNameInput = $('<input>')
                                        .addClass(
                                            'form-control form-control-sm'
                                        )
                                        .attr('type', 'text')
                                        .attr('name',
                                            `frekuensi[${subcategory.subcategory_id}]`);

                                    var subcategoryNameTD = $('<td>')
                                        .attr('rowspan', 5)
                                        .append(subcategoryNameInput);


                                    subcategoryRow.append(subcategoryNameTD);
                                    tableBody.append(subcategoryRow);

                                    // Realisasi
                                    var planRow = $('<tr>');
                                    var planHeader = $('<th>').text('Plan');
                                    planRow.append(planHeader);

                                    var realisasiRow = $('<tr>');
                                    var realisasiHeader = $('<th>').text('Realisasi');
                                    realisasiRow.append(realisasiHeader);

                                    var statusRow = $('<tr>');
                                    var statusHeader = $('<th>').text('Status');
                                    statusRow.append(statusHeader);

                                    var remaksRow = $('<tr>');
                                    var remaksHeader = $('<th>').text('Nama & Paraf');
                                    remaksRow.append(remaksHeader);

                                    for (var i = 1; i <= 5; i++) {
                                        // Plan
                                        var additionalRealisasiInput = $('<input>')
                                            .addClass(
                                                'form-control form-control-plaintext form-control-sm'
                                            )
                                            .attr('type', 'hidden')
                                            .attr('name',
                                                `plan[${subcategory.subcategory_id}][${i}]`
                                            );

                                        var additionalCell = $('<td>')
                                            .addClass('checkbox-cell')
                                            .click(function() {
                                                $(this).toggleClass('selected');
                                                if ($(this).hasClass('selected')) {
                                                    $(this).find('input').val('1');
                                                } else {
                                                    $(this).find('input').val('');
                                                }
                                            });

                                        additionalCell.append(additionalRealisasiInput);
                                        planRow.append(additionalCell);

                                        // Realisasi
                                        var additionalRealisasiInput = $('<input>')
                                            .addClass(
                                                'form-control form-control-plaintext form-control-sm'
                                            )
                                            .attr('type', 'date')
                                            .attr('name',
                                                `realisasi[${subcategory.subcategory_id}][${i}]`
                                            )
                                            .attr('placeholder', 'R');

                                        var additionalRealisasiInputCell = $('<td>')
                                            .append(additionalRealisasiInput);
                                        realisasiRow.append(
                                            additionalRealisasiInputCell);

                                        // Status
                                        var additionalStatusInput = $('<input>')
                                            .addClass(
                                                'form-control form-control form-control-sm mb-1'
                                            )
                                            .attr('type', 'text')
                                            .attr('name',
                                                `status[${subcategory.subcategory_id}][${i}]`
                                            )
                                            .attr('placeholder', '');

                                        var additionalStatusConditionInput = $(
                                                '<input>')
                                            .addClass(
                                                'form-control form-control form-control-sm mb-1'
                                            )
                                            .attr('type', 'hidden')
                                            .attr('name',
                                                `s_condition[${subcategory.subcategory_id}][${i}]`
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
                                                name: `s_condition[${subcategory.subcategory_id}][${i}]`,
                                                id: `btnradio-${subcategory.subcategory_id}-${i}-1`,
                                                autocomplete: 'off',
                                                value: 't'
                                            });

                                        var label1 = $('<label>')
                                            .addClass('btn btn-outline-info btn-xs')
                                            .attr('for',
                                                `btnradio-${subcategory.subcategory_id}-${i}-1`
                                            )
                                            .append($('<i>').addClass('ti ti-check'));

                                        var radioInput2 = $('<input>')
                                            .attr({
                                                type: 'radio',
                                                class: 'btn-check',
                                                name: `s_condition[${subcategory.subcategory_id}][${i}]`,
                                                id: `btnradio-${subcategory.subcategory_id}-${i}-2`,
                                                autocomplete: 'off',
                                                value: 'f'
                                            });

                                        var label2 = $('<label>')
                                            .addClass('btn btn-outline-danger btn-xs')
                                            .attr('for',
                                                `btnradio-${subcategory.subcategory_id}-${i}-2`
                                            )
                                            .append($('<i>').addClass('ti ti-x'));

                                        btnGroup.append(radioInput1, label1,
                                            radioInput2, label2);

                                        // Minggu ke
                                        var additionalMingguKeInput = $('<input>')
                                            .addClass(
                                                'form-control form-control form-control-sm mb-1'
                                            )
                                            .attr('type', 'hidden')
                                            .attr('name',
                                                `minggu_ke[${subcategory.subcategory_id}][${i}]`
                                            )
                                            .val(i);

                                        var combinedCellContent = [
                                            additionalStatusInput,
                                            additionalStatusConditionInput,
                                            additionalMingguKeInput,
                                            btnGroup
                                        ];

                                        var statusCell = $('<td>').append(
                                            combinedCellContent);
                                        statusRow.append(statusCell);


                                        // Remaks
                                        // var additionalRemaksInput = $('<input>')
                                        //     .addClass(
                                        //         'form-control form-control-plaintext form-control-sm'
                                        //     )
                                        //     .attr('type', 'text')
                                        //     .attr('name',
                                        //         `remaks[${subcategory.subcategory_id}][${i}]`
                                        //     )
                                        //     .attr('placeholder', 'Nama & Paraf');
                                        var additionalRemaksInput = $('<select>')
                                            .addClass('select2 form-select')
                                            .attr('name', `remaks[${subcategory.subcategory_id}][${i}]`)
                                            .append($('<option>').attr('value', ''));

                                        @foreach ($jabatan3 as $nama3)
                                            additionalRemaksInput.append($('<option>')
                                                .attr('value', '{{ $nama3->RegNo }}')
                                                .text('{{ $nama3->NAMA }}'));
                                        @endforeach

                                        var additionalRemaksInputCell = $('<td>')
                                            .append(additionalRemaksInput);
                                        remaksRow.append(additionalRemaksInputCell);
                                    }

                                    tableBody.append(planRow, realisasiRow, statusRow,
                                        remaksRow);
                                });

                            });

                        }

                    });

                },
                error: function(xhr, text) {
                    $("#modal_search").modal('hide')
                    Swal.fire(String(xhr.responseJSON.code), String(xhr.responseJSON
                            .message),
                        'error')

                    console.log((xhr)); // Tampilkan pesan error dalam konsol
                    console.log(text); // Tampilkan pesan error dalam konsol
                }
            });
        }

        function checkSelectedRow(cari_dept, kode_periode, id_mesin) {
            $.ajax({
                url: "{{ route('frm.getDataDetail') }}/",
                type: "post",
                data: {
                    cari_dept: cari_dept,
                    kode_periode: kode_periode,
                    id_mesin: id_mesin
                },
                success: function(data) {
                    console.log(data)
                    $("#kode").val(data.result[0].kode);
                    $("#headerid").val(data.result[0].headerid);
                    $("#app1_jabatan").val(data.result[0].app1_jabatan);
                    $("#app2_jabatan").val(data.result[0].app2_jabatan);
                    $("#app1_regno").val(data.result[0].app1_regno);
                    $("#app2_regno").val(data.result[0].app2_regno);
                    $("#app1_by").val(data.result[0].app1_by).trigger("change");
                    $("#app2_by").val(data.result[0].app2_by).trigger("change");
                    $(".btn-save").html("Update")
                    $("#btnkomplit").after(
                        '<button type="button" class="btn btn-success me-sm-3 me-1" onclick="komplit();">Komplit</button>'
                    );
                    // Loop through the data and select radio buttons based on the status value           
                    $.each(data.result, function(index, item) {
                        const subcategoryId = item.subcategory_id;
                        const minggu_ke = item.minggu_ke;
                        const status_con = item.s_condition;
                        const plan = item.plan;
                        const realisasi = item.realisasi;
                        const status = item.status;
                        const remaks = item.remaks;
                        const frekuensi = item.frekuensi;
                        // Frekuensi
                        $(`input[name="frekuensi[${subcategoryId}]`).val(frekuensi);

                        // Plan
                        if (plan === '1') {
                            var tdElement = $(`input[name="plan[${subcategoryId}][${minggu_ke}]"]`)
                                .closest('td');
                            tdElement.addClass('selected');
                            $(`input[name="plan[${subcategoryId}][${minggu_ke}]"]`).val(plan);
                        }

                        // Realisasi
                        if (realisasi != null) {
                            $(`input[name="realisasi[${subcategoryId}][${minggu_ke}]"]`).prop('type',
                                'date').val(realisasi);
                        }

                        // Status
                        if (status != null) {
                            $(`input[name="status[${subcategoryId}][${minggu_ke}]"]`).val(status);
                        }

                        // status condition
                        if (status_con === 't') {
                            $(`input[name="s_condition[${subcategoryId}][${minggu_ke}]"][value="t"]`)
                                .prop('checked', true);
                        } else if (status_con === 'f') {
                            $(`input[name="s_condition[${subcategoryId}][${minggu_ke}]"][value="f"]`)
                                .prop('checked', true);
                        }

                        // Remaks
                        if (remaks != null) {
                            $(`input[name="remaks[${subcategoryId}][${minggu_ke}]"]`).val(remaks);
                        }
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function getjabatan(){
            var jabatan = $('#app1_by').find(':selected').data('jabatan');
            var regno = $('#app1_by').find(':selected').data('regno');
            var idjabatan = $('#app1_by').find(':selected').data('idjabatan');
             $("#app1_jabatan").val(jabatan);
             $("#regno").val(regno);
             $("#idjabatan").val(idjabatan);
        }

        function getjabatan2(){
            var jabatan = $('#app2_by').find(':selected').data('jabatan2');
            var regno2 = $('#app2_by').find(':selected').data('regno2');
            var idjabatan2 = $('#app2_by').find(':selected').data('idjabatan2');
             $("#app2_jabatan").val(jabatan);
             $("#regno2").val(regno2);
             $("#idjabatan2").val(idjabatan2);
        }
    </script>

@endsection
