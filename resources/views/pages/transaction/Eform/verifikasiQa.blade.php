@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')


    <div class="container-fluid flex-grow-1 container-p-y">
        <form id="form-data">
            @csrf



            <input hidden class="form-control col-md-2" type="text" name="dtlsys" value="" readonly />
            <input hidden class="form-control col-md-2" type="text" name="hdrsys" value="" readonly />
            <input hidden class="form-control col-md-2" type="text" name="idbilingual" value="" readonly />
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
                                        <th>
                                            <div class="d-flex align-items-center">
                                                <span
                                                    style="font-style: italic; display: block; margin-right: 55px;">Dept/Bag</span>
                                                <input type="text" name="bagian" value=""
                                                    class="form-control form-control-sm">
                                            </div>

                                        </th>
                                    </tr>
                                    <tr style="text-align:center;">
                                        <th style="width: 50px;">
                                            <span style="display: block;">VERIFIKASI PERBAIKAN MESIN</span>

                                        </th>
                                        <th style="width: 50px;">
                                            <div class="d-flex align-items-center">
                                                <span
                                                    style="font-style: italic; display: block; margin-right: 55px;">Tanggal</span>
                                                <input type="date" name="tanggalverifikasi" value=""
                                                    class="form-control form-control-sm">
                                                {{-- <input type="date" name="" value=""
                                                            class="form-control form-control-sm" readonly> --}}
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
                                <table class="table table-responsive table-bordered table-striped table-hover"
                                    id="table1">
                                    <thead style="text-align:center;">
                                        <tr>
                                            <th class="small text-xs" rowspan="2">
                                                <button type="button" class="btn btn-primary btn-xs"
                                                    onclick="tambahbaris(1)">
                                                    <i class="ti ti-plus"></i>
                                                </button>
                                            </th>
                                            <th rowspan="2">
                                                <span style="display: block;">NO</span>
                                            </th>
                                            <th rowspan="2">
                                                <span style="display: block;">NAMA PERALATAN**</span>
                                            </th>
                                            <th rowspan="2">
                                                <span style="display: block;">KODE</span>
                                            </th>
                                            <th rowspan="2">
                                                <span style="display: block;">JENIS KETIDAKSESUAIAN</span>
                                            </th>
                                            <th rowspan="2">
                                                <span style="display: block;">TINDAKAN YANG DILAKUKAN</span>
                                            </th>
                                            <th colspan="2">
                                                <span style="display: block;">JAM</span>
                                            </th>
                                            <th rowspan="2">
                                                <span style="display: block;">STATUS VERIFIKASI</span>
                                            </th>
                                            <th rowspan="2">
                                                <span style="display: block;">PARAF</span>
                                            </th>
                                        </tr>

                                        <tr>
                                            <th>MULAI</th>
                                            <th>SELESAI</th>
                                        </tr>


                                    </thead>
                                    <tbody id="tbody1">

                                    </tbody>

                                </table>
                            </div>
                        </div>

                    </div>
                </div>

            </div>




            <br>
            <div class="card">
                <div class="accordion-body m-3">

                    <div>
                        <div class="row">
                            <div class="col-md-12 " id="btnsave" style="display: flex; justify-content: flex-end;">
                                <button type="button" class="btn btn-primary btn-save" onclick="save()"><i
                                        class="fa fa-refresh"></i> Save</button>
                                <button type="submit" class="btn btn-success"><i class="fa fa-print"></i> Print</button>
                            </div> <!-- Kolom kosong untuk menggeser elemen ke kanan -->

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <!-- Your HTML code here -->

    <script>
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
            inputName.setAttribute("id", "namaperalatan_" + tbody
                .childElementCount); // Gunakan childElementCount sebagai detail id
            var cellName = document.createElement("td");
            cellName.appendChild(inputName);
            newRow.appendChild(cellName);

            // Buat input untuk qty dengan detail id
            var inputQty = document.createElement("input");
            inputQty.className = "form-control form-control-sm";
            inputQty.setAttribute("type", "text");
            inputQty.setAttribute("name", "kode[" + param + "][" + tbody.childElementCount + "]")
            inputQty.setAttribute("id", "kode_" + tbody.childElementCount); // Gunakan childElementCount sebagai detail id
            var cellQty = document.createElement("td");
            cellQty.appendChild(inputQty);
            newRow.appendChild(cellQty);

            // Buat input untuk nama dengan detail id
            var inputName = document.createElement("input");
            inputName.className = "form-control form-control-sm";
            inputName.setAttribute("type", "text");
            inputName.setAttribute("name", "ketidaksesuaian[" + param + "][" + tbody.childElementCount + "]")
            inputName.setAttribute("id", "ketidaksesuaian_" + tbody
                .childElementCount); // Gunakan childElementCount sebagai detail id
            var cellName = document.createElement("td");
            cellName.appendChild(inputName);
            newRow.appendChild(cellName);
            // Buat input untuk nama dengan detail id
            var inputName = document.createElement("input");
            inputName.className = "form-control form-control-sm";
            inputName.setAttribute("type", "text");
            inputName.setAttribute("name", "tindakan[" + param + "][" + tbody.childElementCount + "]")
            inputName.setAttribute("id", "tindakan_" + tbody
                .childElementCount); // Gunakan childElementCount sebagai detail id
            var cellName = document.createElement("td");
            cellName.appendChild(inputName);
            newRow.appendChild(cellName);
            // Buat input untuk nama dengan detail id
            var inputName = document.createElement("input");
            inputName.className = "form-control form-control-sm";
            inputName.setAttribute("type", "time");
            inputName.setAttribute("name", "mulai[" + param + "][" + tbody.childElementCount + "]")
            inputName.setAttribute("id", "mulai_" + tbody.childElementCount); // Gunakan childElementCount sebagai detail id
            var cellName = document.createElement("td");
            cellName.appendChild(inputName);
            newRow.appendChild(cellName);
            // Buat input untuk nama dengan detail id
            var inputName = document.createElement("input");
            inputName.className = "form-control form-control-sm";
            inputName.setAttribute("type", "time");
            inputName.setAttribute("name", "selesai[" + param + "][" + tbody.childElementCount + "]")
            inputName.setAttribute("id", "selesai_" + tbody
                .childElementCount); // Gunakan childElementCount sebagai detail id
            var cellName = document.createElement("td");
            cellName.appendChild(inputName);
            newRow.appendChild(cellName);
            // Buat input untuk nama dengan detail id
            var inputName = document.createElement("input");
            inputName.className = "form-control form-control-sm";
            inputName.setAttribute("type", "text");
            inputName.setAttribute("name", "statusverifikasi[" + param + "][" + tbody.childElementCount + "]")
            inputName.setAttribute("id", "statusverifikasi_" + tbody
                .childElementCount); // Gunakan childElementCount sebagai detail id
            var cellName = document.createElement("td");
            cellName.appendChild(inputName);
            newRow.appendChild(cellName);
            // Buat input untuk nama dengan detail id
            var inputName = document.createElement("input");
            inputName.className = "form-control form-control-sm";
            inputName.setAttribute("type", "text");
            inputName.setAttribute("name", "paraf[" + param + "][" + tbody.childElementCount + "]")
            inputName.setAttribute("id", "paraf_" + tbody.childElementCount); // Gunakan childElementCount sebagai detail id
            var cellName = document.createElement("td");
            cellName.appendChild(inputName);
            newRow.appendChild(cellName);


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
                            url: '{{ route('verivikasiqastore.store') }}',
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
