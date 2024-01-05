@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')


    <div class="container-fluid flex-grow-1 container-p-y">
        <form id="form-data">
            @csrf


            @foreach ($verifikasi as $key => $x)
                @foreach ($x->perbaikanDetail as $y)
                    <input hidden class="form-control col-md-2" type="text" name="dtlsys" value="{{ $y->dtlsys }}"
                        readonly />
                    <input hidden class="form-control col-md-2" type="text" name="hdrsys" value="{{ $x->hdrsys }}"
                        readonly />
                    <input hidden class="form-control col-md-2" type="text" name="idbilingual"
                        value="{{ $y->id }}" readonly />
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="accordion-body m-3">
                                    <div class="table-responsive text-nowrap pt-3">
                                        <table id="tableContainer"
                                            class="table table-responsive table-bordered table-striped table-hover">
                                            <tr style="text-align:center;">
                                                <th style="width: 50px;" rowspan="3"> <img
                                                        src="{{ asset('img/logo-01042022.png') }}"></th>
                                                <th style="width: 50px;">PT RIAU SAKTI UNITED PLANTATIONS</th>
                                                <th>
                                                    <div class="d-flex align-items-center">
                                                        <span
                                                            style="font-style: italic; display: block; margin-right: 55px;">Dept/Bag</span>
                                                        <input type="text" name="bagian" value="{{ $x->dept }}"
                                                            class="form-control form-control-sm" readonly>
                                                    </div>

                                                </th>
                                            </tr>
                                            <tr style="text-align:center;">
                                                <th style="width: 50px;">
                                                    <span style="display: block;">VERIFIKASI PERBAIKAN</span>

                                                </th>
                                                <th style="width: 50px;">
                                                    <div class="d-flex align-items-center">
                                                        <span
                                                            style="font-style: italic; display: block; margin-right: 55px;">Tanggal</span>
                                                        <input type="date" name="tanggalverifikasi" value=""
                                                            class="form-control form-control-sm">
                                                    </div>


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
                                                            <input type="text" name="namamesin"
                                                                value="{{ $y->perawatan }}"
                                                                class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="d-flex align-items-center">
                                                            <span
                                                                style="font-style: italic; display: block; margin-right: 10px;">Area</span>
                                                            <input type="text" name="area" id="department"
                                                                value="{{ $x->dept }}"
                                                                class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="d-flex align-items-center">
                                                            <span
                                                                style="font-style: italic; display: block; margin-right: 55px;">Jam</span>
                                                            <input type="text" name="jam"
                                                                value="{{ $y->mulai . ' - ' . $y->selesai }}"
                                                                class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </th>
                                                </tr>


                                                <tr>
                                                    <th>
                                                        <div class="d-flex align-items-center">
                                                            <span
                                                                style="font-style: italic; display: block; margin-right: 95px;">Kode</span>
                                                            <input type="text" name="kode" value="{{ $y->code }}"
                                                                class="form-control form-control-sm">
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="d-flex align-items-center">
                                                            <span
                                                                style="font-style: italic; display: block; margin-right: 10px;">Shift</span>
                                                            <input type="text" name="shift" value=""
                                                                class="form-control form-control-sm">
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="d-flex align-items-center">
                                                            <span
                                                                style="font-style: italic; display: block; margin-right: 10px;">Total
                                                                Jam</span>
                                                            <input type="text" name="totaljam"
                                                                value="{{ $y->totaljam }}"
                                                                class="form-control form-control-sm" readonly>
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
                                                            <input type="text" name="kerusakan"
                                                                value="{{ $y->kerusakan }}"
                                                                class="form-control form-control-sm" readonly>
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
                                                            <input type="text" name="tindakan"
                                                                value="{{ $y->tindakan }}"
                                                                class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </th>
                                                </tr>
                                            </tfoot>

                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                @endforeach
            @endforeach
    </div>
    <br>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="accordion-body m-3">
                    <div class="table-responsive text-nowrap pt-3">
                        <table class="table table-responsive table-bordered table-striped table-hover" id="table1">
                            <thead style="text-align:center;">
                                <tr>
                                    <th class="small text-xs">
                                        <button type="button" class="btn btn-primary btn-xs" onclick="tambahbaris(1)">
                                            <i class="ti ti-plus"></i>
                                        </button>
                                    </th>
                                    <th colspan="4"class="tanggal">
                                        <span style="display: block;">Peralatan / Sparepart yang dibawa</span>

                                    </th>

                                </tr>
                                <tr>
                                    <th style="width: 10px;">#</th>
                                    <th style="width: 10px;">No</th>
                                    <th style="width: 100px;">
                                        <span style="display: block;">Nama Peralatan / Sparepart</span>
                                    </th>
                                    <th class="tanggal" style="width: 100px;">
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
                        <table class="table table-responsive table-bordered table-striped table-hover" id="table2">
                            <thead style="text-align:center;">
                                <tr>
                                    <th class="small text-xs">
                                        <button type="button" class="btn btn-primary btn-xs" onclick="tambahbaris2(2)">
                                            <i class="ti ti-plus"></i>
                                        </button>
                                    </th>
                                    <th colspan="5">
                                        <span style="display: block;">Peralatan yang dikembalikan </span>
                                    </th>

                                </tr>
                                <tr>
                                    <th style="width: 50px;">#</th>
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
                        <table class="table table-responsive table-bordered table-striped table-hover" id="table3">
                            <thead style="text-align:center;">
                                <tr>
                                    <th class="small text-xs">
                                        <button type="button" class="btn btn-primary btn-xs" onclick="tambahbaris3(3)">
                                            <i class="ti ti-plus"></i>
                                        </button>
                                    </th>
                                    <th colspan="4"class="tanggal">
                                        <span style="display: block;">Sparepart yang dipasang/dipakai</span>

                                    </th>


                                </tr>
                                <tr>
                                    <th style="width: 50px;">#</th>
                                    <th style="width: 50px;">No</th>
                                    <th style="width: 100px;">
                                        <span style="display: block;">Nama Sparepart*</span>
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
                        <table class="table table-responsive table-bordered table-striped table-hover" id="table4">
                            <thead style="text-align:center;">
                                <tr>
                                    <th class="small text-xs">
                                        <button type="button" class="btn btn-primary btn-xs" onclick="tambahbaris4(4)">
                                            <i class="ti ti-plus"></i>
                                        </button>
                                    </th>
                                    <th colspan="5">
                                        <span style="display: block;">Sparepart yang rusak/sisa
                                            sparepart</span>

                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 50px;">#</th>
                                    <th style="width: 50px;">No</th>
                                    <th style="width: 100px;">
                                        <span style="display: block;">Nama Sparepart*</span>
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
                        <table class="table table-bordered" style="margin-bottom: 0px;">
                            <tfoot>
                                <tr>
                                    <th>
                                        <div class="d-flex align-items-center">
                                            <span
                                                style="font-style: italic; display: block; margin-right: 60px;">Dikerjakan
                                                Oleh</span>
                                            <input type="text" name="tindakan" value=""
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
        <div class="col-12">
            <div class="card">
                <div class="accordion-body m-3">
                    <div class="table-responsive text-nowrap pt-3">
                        <table class="table table-responsive table-bordered table-striped table-hover" id="myTable">
                            <thead style="text-align:center;">
                                <tr>
                                    <th colspan="2"class="tanggal">
                                        <span style="display: block;">Verifikasi QA personil**</span>
                                    </th>
                                    <th class="tanggal">
                                        <span style="display: block;">Yes</span>
                                    </th>
                                    <th class="tanggal">
                                        <span style="display: block;">No</span>
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Apakah setelah perbaikan mesin dan area disekitar perbaikan dibersihkan</td>
                                    <td>
                                        <input class="form-check-input" type="checkbox" name="yes1" id="inlineRadio1"
                                            value="t" />
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="checkbox" name="no1" id="inlineRadio2"
                                            value="f" />
                                    </td>

                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Apakah mesin / alat yang diperbaiki bebas dari bahaya yang bisa menyebabkan
                                        kontaminasi</td>
                                    <td>
                                        <input class="form-check-input" type="checkbox" name="yes2" value="t"
                                            class="form-control form-control-sm">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="checkbox" name="no2" value="f"
                                            class="form-control form-control-sm">
                                    </td>

                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Apakah mesin bisa dijalankan untuk proses produksi</td>
                                    <td>
                                        <input class="form-check-input" type="checkbox" name="yes3" value="t"
                                            class="form-control form-control-sm">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="checkbox" name="no3" value="f"
                                            class="form-control form-control-sm">
                                    </td>


                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Apakah peralatan dan sparepart yang dibawa, dipakai, dipasang dan dikembalikan
                                        sesuai jumlahnya seperti yang tercantum diatas dan tidak ada yang tertinggal</td>
                                    <td>
                                        <input class="form-check-input" type="checkbox" name="yes4" value="t"
                                            class="form-control form-control-sm">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="checkbox" name="no4" value="f"
                                            class="form-control form-control-sm">
                                    </td>


                                </tr>

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
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <label
                                                style="font-style: italic; display: block; margin-right: 10px;">Nama</label>
                                            <select id="namebuat" class="select2 form-select" name="namebuat">
                                                <option value="">Select</option>
                                            </select>
                                        </div>

                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <label
                                                style="font-style: italic; display: block; margin-right: 10px;">Nama</label>
                                            <select id="namecek" class="select2 form-select" name="namecek">
                                                <option value="">Select</option>
                                            </select>
                                        </div>

                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <label
                                                style="font-style: italic; display: block; margin-right: 10px;">Nama</label>
                                            <select id="nameveriv" class="select2 form-select" name="nameveriv">
                                                <option value="">Select</option>
                                            </select>
                                        </div>

                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <label
                                                style="font-style: italic; display: block; margin-right: 10px;">Jabatan</label>
                                            <input class="form-control" type="text" name="jabatanbuat"
                                                id="jabatanbuat" value="" />
                                        </div>

                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <label
                                                style="font-style: italic; display: block; margin-right: 10px;">Jabatan</label>
                                            <input class="form-control" type="text" name="jabatancek" id="jabatancek"
                                                value="" />
                                        </div>

                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <label
                                                style="font-style: italic; display: block; margin-right: 10px;">Jabatan</label>
                                            <input class="form-control" type="text" name="jabatanveriv"
                                                id="jabatanveriv" value="" />
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <label for="getbulan"
                                                style="font-style: italic; display: block; margin-right: 10px;">Tanggal</label>
                                            <input class="form-control" type="date" name="datebuat"
                                                value="2023-06-01" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <label for="getbulan"
                                                style="font-style: italic; display: block; margin-right: 10px;">Tanggal</label>
                                            <input class="form-control" type="date" name="datecek"
                                                value="2023-06-01" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <label for="getbulan"
                                                style="font-style: italic; display: block; margin-right: 10px;">Tanggal</label>
                                            <input class="form-control sm-4" type="date" name="dateveriv"
                                                value="2023-06-01" />
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
    <br>
    <div class="card">
        <div class="accordion-body m-3">
            <div class="row">
                <div class="col-md-12 " id="btnsave" style="display: flex; justify-content: flex-end;">
                    <button type="button" class="btn btn-primary btn-save" onclick="save()"><i
                            class="fa fa-refresh"></i> Save</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-print"></i> Print</button>
                </div> <!-- Kolom kosong untuk menggeser elemen ke kanan -->


            </div>
        </div>
    </div>
    </form>
    </div>


    <!-- Your HTML code here -->

    <script>
        $(document).ready(function() {

            var department = $('#department').val();


            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
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


                    // Menambahkan opsi yang sesuai berdasarkan respons objek
                    if (Array.isArray(data.listTk.Results)) {
                        data.listTk.Results.forEach(function(item) {

                            $('#namebuat').append('<option value="' + item.personalid +
                                '">' +
                                item.nama + '</option>');
                            $('#namecek').append('<option value="' + item.personalid +
                                '">' +
                                item.nama + '</option>');
                            $('#nameveriv').append('<option value="' + item.personalid +
                                '">' +
                                item.nama + '</option>');
                        });


                        $('#namebuat').change(function() {
                            var selectednama = $(this).val();
                            console.log(data.listTk.Results);
                            var selectedItem = data.listTk.Results.find(function(obj) {
                                return obj.personalid == selectednama;
                            });

                            if (selectedItem) {
                                $('#jabatanbuat').val(selectedItem.jabatan_nama);
                                $('#nameofacknowledged').val(selectedItem.nama);
                            } else {
                                $('#jabatanbuat').val('');
                            }

                        });

                        $('#namecek').change(function() {
                            var selectednama = $(this).val();
                            console.log(data.listTk.Results);
                            var selectedItem = data.listTk.Results.find(function(obj) {
                                return obj.personalid == selectednama;
                            });

                            if (selectedItem) {
                                $('#jabatancek').val(selectedItem.jabatan_nama);
                                $('#nameofcheck').val(selectedItem.nama);
                            } else {
                                $('#jabatancek').val('');
                            }

                        });


                        $('#nameveriv').change(function() {
                            var selectednama = $(this).val();
                            console.log(data.listTk.Results);
                            var selectedItem = data.listTk.Results.find(function(obj) {
                                return obj.personalid == selectednama;
                            });

                            if (selectedItem) {
                                $('#jabatanveriv').val(selectedItem.jabatan_nama);
                                $('#nameofcheck').val(selectedItem.nama);
                            } else {
                                $('#jabatanveriv').val('');
                            }

                        });


                    } else {
                        console.log('Invalid response data: listTk is not an array');
                    }

                    // $.each(data.listPeralatan, function(index, item) {

                    //     $("#selectdept").find(":selected").val(item.dept);
                    //     $('#peralatan').val(item.dept);

                    //     var peralatan = item.peralatan;
                    //     // Menambahkan opsi departemen dan mesin
                    //     $('#selectmachine').append('<option value="' + item.mesinperalatan_id +
                    //         '">' + peralatan.machine_name + '</option>');
                    // });

                    swal.close();
                },
                error: function(error) {
                    console.log(error);
                }
            });

        });

        function hapusbaris(button) {
            var row = button.parentNode.parentNode; // Dapatkan baris yang berisi tombol yang ditekan
            row.parentNode.removeChild(row); // Hapus baris dari tbody
        }

        function tambahbaris(param) {
            // Dapatkan referensi tbody
            var tbody = document.getElementById("tbody1");
            // console.log("Parameter: " + param);

            // Buat elemen-elemen baris yang baru
            var newRow = document.createElement("tr");
            // Buat tombol hapus
            var deleteButton = document.createElement("button");

            deleteButton.className = "btn btn-danger btn-xs"; // Menggunakan className untuk menambahkan kelas
            var deleteIcon = document.createElement("i");
            deleteIcon.className = "fa fa-trash"; // Menambahkan kelas ikon
            deleteButton.appendChild(deleteIcon); // Menambahkan ikon ke dalam tombol
            deleteButton.setAttribute("type", "button");
            deleteButton.setAttribute("onclick", "hapusbaris(this)");
            var cellButton = document.createElement("td");

            cellButton.appendChild(deleteButton);
            newRow.appendChild(cellButton);


            // Buat kolom nomor urut
            var cellNo = document.createElement("td");
            cellNo.style.width = "10px";
            cellNo.textContent = tbody.childElementCount + 1;
            newRow.appendChild(cellNo);
            // Buat input untuk nama dengan detail id
            var inputName = document.createElement("input");
            inputName.className = "form-control form-control-sm";
            inputName.setAttribute("type", "text");
            inputName.setAttribute("name", "namaperalantan[" + param + "][" + tbody.childElementCount + "]")
            inputName.setAttribute("id", "name_" + tbody.childElementCount); // Gunakan childElementCount sebagai detail id
            var cellName = document.createElement("td");
            cellName.appendChild(inputName);
            newRow.appendChild(cellName);

            // Buat input untuk qty dengan detail id
            var inputQty = document.createElement("input");
            inputQty.className = "form-control form-control-sm";
            inputQty.setAttribute("type", "text");
            inputQty.setAttribute("name", "qty[" + param + "][" + tbody.childElementCount + "]")

            inputQty.setAttribute("id", "qty_" + tbody.childElementCount); // Gunakan childElementCount sebagai detail id
            var cellQty = document.createElement("td");
            cellQty.appendChild(inputQty);
            newRow.appendChild(cellQty);



            // Tambahkan baris baru ke dalam tbody
            tbody.appendChild(newRow);
        }


        function tambahbaris2(param) {
            var tbody = document.getElementById("tbody2");

            // Buat elemen-elemen baris yang baru
            var newRow = document.createElement("tr");
            // Buat tombol hapus
            var deleteButton = document.createElement("button");

            deleteButton.className = "btn btn-danger btn-xs"; // Menggunakan className untuk menambahkan kelas
            var deleteIcon = document.createElement("i");
            deleteIcon.className = "fa fa-trash"; // Menambahkan kelas ikon
            deleteButton.appendChild(deleteIcon); // Menambahkan ikon ke dalam tombol
            deleteButton.setAttribute("type", "button");
            deleteButton.setAttribute("onclick", "hapusbaris(this)");
            var cellButton = document.createElement("td");

            cellButton.appendChild(deleteButton);
            newRow.appendChild(cellButton);


            // Buat kolom nomor urut
            var cellNo = document.createElement("td");
            cellNo.style.width = "10px";
            cellNo.textContent = tbody.childElementCount + 1;
            newRow.appendChild(cellNo);
            // Buat input untuk nama dengan detail id
            var inputName = document.createElement("input");
            inputName.className = "form-control form-control-sm";
            inputName.setAttribute("type", "text");
            inputName.setAttribute("name", "namaperalantan[" + param + "][" + tbody.childElementCount + "]")
            inputName.setAttribute("id", "name_" + tbody.childElementCount); // Gunakan childElementCount sebagai detail id
            var cellName = document.createElement("td");
            cellName.appendChild(inputName);
            newRow.appendChild(cellName);

            // Buat input untuk qty dengan detail id
            var inputQty = document.createElement("input");
            inputQty.className = "form-control form-control-sm";
            inputQty.setAttribute("type", "text");
            inputQty.setAttribute("name", "qty[" + param + "][" + tbody.childElementCount + "]")
            inputQty.setAttribute("id", "qty_" + tbody.childElementCount); // Gunakan childElementCount sebagai detail id

            var cellQty = document.createElement("td");
            cellQty.appendChild(inputQty);
            newRow.appendChild(cellQty);

            // Buat input untuk qty dengan detail id
            var inputKet = document.createElement("input");
            inputKet.className = "form-control form-control-sm";
            inputKet.setAttribute("type", "text");
            inputKet.setAttribute("name", "keterangan[" + param + "][" + tbody.childElementCount + "]")
            inputKet.setAttribute("id", "keterangan_" + tbody
                .childElementCount); // Gunakan childElementCount sebagai detail id
            inputKet.style.width = "100px";
            var cellKet = document.createElement("td");
            cellKet.appendChild(inputKet);
            newRow.appendChild(cellKet);



            // Tambahkan baris baru ke dalam tbody
            tbody.appendChild(newRow);
        }

        function tambahbaris3(param) {
            var tbody = document.getElementById("tbody3");

            // Buat elemen-elemen baris yang baru
            var newRow = document.createElement("tr");
            // Buat tombol hapus
            var deleteButton = document.createElement("button");

            deleteButton.className = "btn btn-danger btn-xs"; // Menggunakan className untuk menambahkan kelas
            var deleteIcon = document.createElement("i");
            deleteIcon.className = "fa fa-trash"; // Menambahkan kelas ikon
            deleteButton.appendChild(deleteIcon); // Menambahkan ikon ke dalam tombol
            deleteButton.setAttribute("type", "button");
            deleteButton.setAttribute("onclick", "hapusbaris(this)");
            var cellButton = document.createElement("td");

            cellButton.appendChild(deleteButton);
            newRow.appendChild(cellButton);


            // Buat kolom nomor urut
            var cellNo = document.createElement("td");
            cellNo.style.width = "10px";
            cellNo.textContent = tbody.childElementCount + 1;
            newRow.appendChild(cellNo);
            // Buat input untuk nama dengan detail id
            var inputName = document.createElement("input");
            inputName.className = "form-control form-control-sm";
            inputName.setAttribute("type", "text");
            inputName.setAttribute("name", "namaperalantan[" + param + "][" + tbody.childElementCount + "]")
            inputName.setAttribute("id", "name_" + tbody.childElementCount); // Gunakan childElementCount sebagai detail id
            var cellName = document.createElement("td");
            cellName.appendChild(inputName);
            newRow.appendChild(cellName);

            // Buat input untuk qty dengan detail id
            var inputQty = document.createElement("input");
            inputQty.className = "form-control form-control-sm";
            inputQty.setAttribute("type", "text");
            inputQty.setAttribute("name", "qty[" + param + "][" + tbody.childElementCount + "]")
            inputQty.setAttribute("id", "qty_" + tbody.childElementCount); // Gunakan childElementCount sebagai detail id
            var cellQty = document.createElement("td");
            cellQty.appendChild(inputQty);
            newRow.appendChild(cellQty);



            // Tambahkan baris baru ke dalam tbody
            tbody.appendChild(newRow);
        }

        function tambahbaris4(param) {
            var tbody = document.getElementById("tbody4");

            // Buat elemen-elemen baris yang baru
            var newRow = document.createElement("tr");
            // Buat tombol hapus
            var deleteButton = document.createElement("button");

            deleteButton.className = "btn btn-danger btn-xs"; // Menggunakan className untuk menambahkan kelas
            var deleteIcon = document.createElement("i");
            deleteIcon.className = "fa fa-trash"; // Menambahkan kelas ikon
            deleteButton.appendChild(deleteIcon); // Menambahkan ikon ke dalam tombol
            deleteButton.setAttribute("type", "button");
            deleteButton.setAttribute("onclick", "hapusbaris(this)");
            var cellButton = document.createElement("td");

            cellButton.appendChild(deleteButton);
            newRow.appendChild(cellButton);


            // Buat kolom nomor urut
            var cellNo = document.createElement("td");
            cellNo.style.width = "10px";
            cellNo.textContent = tbody.childElementCount + 1;
            newRow.appendChild(cellNo);
            // Buat input untuk nama dengan detail id
            var inputName = document.createElement("input");
            inputName.className = "form-control form-control-sm";
            inputName.setAttribute("type", "text");
            inputName.setAttribute("name", "namaperalantan[" + param + "][" + tbody.childElementCount + "]")
            inputName.setAttribute("id", "name_" + tbody.childElementCount); // Gunakan childElementCount sebagai detail id
            var cellName = document.createElement("td");
            cellName.appendChild(inputName);
            newRow.appendChild(cellName);

            // Buat input untuk qty dengan detail id
            var inputQty = document.createElement("input");
            inputQty.className = "form-control form-control-sm";
            inputQty.setAttribute("type", "text");
            inputQty.setAttribute("name", "qty[" + param + "][" + tbody.childElementCount + "]")
            inputQty.setAttribute("id", "qty_" + tbody.childElementCount); // Gunakan childElementCount sebagai detail id

            var cellQty = document.createElement("td");
            cellQty.appendChild(inputQty);
            newRow.appendChild(cellQty);

            var inputKet = document.createElement("input");
            inputKet.className = "form-control form-control-sm";
            inputKet.setAttribute("type", "text");
            inputKet.setAttribute("name", "keterangan[" + param + "][" + tbody.childElementCount + "]")
            inputKet.setAttribute("id", "keterangagn_" + tbody
                .childElementCount); // Gunakan childElementCount sebagai detail id
            inputKet.style.width = "100px";
            var cellKet = document.createElement("td");
            cellKet.appendChild(inputKet);
            newRow.appendChild(cellKet);

            // Tambahkan baris baru ke dalam tbody
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
                            url: '{{ route('verifikasitahunstore.store') }}',
                            type: "POST",
                            data: formData,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            dataType: "JSON",
                            success: function(response) {
                                console.log(response);

                                if (response.code == 200) {
                                    Swal.fire("Success!",
                                        String(
                                            response.message), 'success');
                                    setTimeout(() => {
                                        // window.location.reload();

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
