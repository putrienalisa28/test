@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">
        <form id="form-data">
            @csrf
            <input type="hidden" name="hdrsys" value="{{ $hasil_perbaikan->first()->hdr_id }}" readonly>
            <input type="hidden" id="department" value="{{ $hasil_perbaikan->first()->dept }}" readonly>
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
                                        <th style="width: 50px;" rowspan="">

                                            <input type="text" name="nosurat" id="nosurat"
                                                value="{{ $hasil_perbaikan->first()->nosurat }}"
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
                                        <th style="width: 50px;" rowspan="">

                                            <input type="hidden" name="dept"
                                                value="{{ $hasil_perbaikan->first()->dept }}"
                                                class="form-control form-control-plaintext form-control-sm"
                                                style="text-align:center; display: block; font-weight: bold;" readonly>

                                            <span style="display: block;">HAL : 2 DARI 2</span>
                                            <span><em>(Pages) 2 of 2</em></span>
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
                            <div class=" pt-3">
                                <table class="table table-responsive table-bordered table-striped table-hover">
                                    <thead style="text-align:center;">
                                        <tr>
                                            <th rowspan="2" style="width: 50px;">No</th>
                                            <th rowspan="2"style="width: 100px;">
                                                <span style="display: block;">BAGIAN YANG DIPERIKSA</span>
                                                <span><em>(Part to Check)</em></span>
                                            </th>
                                            <th rowspan="2"class="tanggal">
                                                <span style="display: block;">KODE</span>
                                                <span><em>(Code)</em></span>
                                            </th>
                                            <th rowspan="2"class="tanggal">
                                                <span style="display: block;">JENIS KERUSAKAN</span>
                                                <span><em>(Damage Type)</em></span>
                                            </th>
                                            <th rowspan="2">
                                                <span style="display: block;">TINDAKAN YANG DILAKUKAN</span>
                                                <span><em>(Action Conducted)</em></span>
                                            </th>
                                            <th rowspan="2">
                                                <span style="display: block; width: 100%;">TGL</span>
                                                <span><em>(Date)</em></span>

                                            </th>
                                            <th colspan="2"> <span style="display: block;">JAM</span>
                                                <span><em>(Hour)</em></span>

                                            </th>
                                            <th rowspan="2">
                                                <span style="display: block;">TOTAL JAM</span>
                                                <span><em>(Total Hour)</em></span>
                                            </th>
                                            <th rowspan="2">
                                                <span style="display: block;">KETERANGAN</span>
                                                <span><em>(Remaks)</em></span>
                                            </th>
                                            <th rowspan="2"><span style="display: block;">NAMA</span>
                                                <span><em>(Name)</em></span>
                                            </th>
                                            <th rowspan="2"> <span style="display: block;">PARAF</span>
                                                <span><em>(Initials)</em></span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th><span style="display: block;">MULAI</span>
                                                <span><em>(Start)</em></span>
                                            </th>
                                            <th><span style="display: block;">SELESAI</span>
                                                <span><em>(Finish)</em></span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody">

                                        @foreach ($hasil_perbaikan as $x)
                                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                                            <td hidden><input type="text" name="dtlsys[]" value="{{ $x->id }}"
                                                    class="form-control form-control-plaintext form-control-sm"></td>
                                            <td><input readonly type="text" name="perawatan[]"
                                                    value="{{ $x->category_name }}"
                                                    class="form-control form-control-plaintext form-control-sm"></td>
                                            <td><input readonly="text" name="code[]" value="{{ $x->code }}"
                                                    class="form-control form-control-plaintext form-control-sm"></td>
                                            <td>
                                                <textarea readonly name="jeniskerusakan[]" class="form-control form-control-plaintext form-control-sm">{{ $x->subcategory_name }}</textarea>
                                            </td>

                                            <td>
                                                <textarea name="tindakan[]" value=""class="form-control form-control-plaintext form-control-sm"></textarea>

                                            </td>
                                            <td><input type="date" name="tanggal[]" value=""
                                                    class="form-control form-control-plaintext form-control-sm md-4"></td>

                                            <td>
                                                <input type="time" name="mulai[]" value=""
                                                    class="form-control form-control-plaintext form-control-sm">
                                            </td>
                                            <td>
                                                <input type="time" name="selesai[]" value=""
                                                    class="form-control form-control-plaintext form-control-sm">
                                            </td>
                                            <td>
                                                <input type="text" name="totaljam[]" value=""
                                                    class="form-control form-control-plaintext form-control-sm">
                                            </td>
                                            <td>
                                                <textarea name="keterangan[]" value=""class="form-control form-control-plaintext form-control-sm"></textarea>

                                            </td>
                                            <td>
                                                <select id="" class="select2 form-select namaparaf"
                                                    name="nama[]" style="z-index:99999 !important">
                                                    <option value="">Select</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="paraf[]" value=""
                                                    class="form-control form-control-plaintext form-control-sm">
                                            </td>

                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                    </div>

                    <!--/ Complex Headers -->
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
                                                    style="display: block;">Dicek Oleh</span>
                                                <span><em>(Checked by)</em></span>
                                            </th>
                                            <th style="vertical-align: middle; text-align: center; width: 33.3%"><span
                                                    style="display: block;">Diketahui Oleh</span>
                                                <span><em>(Acknowledged by)</em></span>
                                            </th>

                                        </tr>
                                        <tr>
                                            <th height="100" style="vertical-align: middle; text-align: center">
                                                {!! getTTD(18) !!}
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
                                                    <select id="selectnamacheck" class="select2 form-select"
                                                        name="idofcheck">
                                                        <option value="">Select</option>
                                                    </select>
                                                    <input hidden id="nameofcheck" class="form-control" type="text"
                                                        name="nameofcheck" value="" readonly />
                                                </div>
                                                <span><em>(Name)</em></span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <label
                                                        style="font-style: italic; display: block; margin-right: 10px;">Nama</label>
                                                    <select id="selectnamaknow" class="select2 form-select col-md-10"
                                                        name="idofacknowledged">
                                                        <option value="">Select</option>
                                                        <input hidden id="nameofacknowledged" class="form-control"
                                                            type="text" name="nameofacknowledged" value=""
                                                            readonly />
                                                    </select>
                                                </div>
                                                <span><em>(Name)</em></span>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <label
                                                        style="font-style: italic; display: block; margin-right: 10px;">Jabatan</label>
                                                    <input class="form-control" type="text" name="positionofcheck"
                                                        id="positionofcheck" value="" />
                                                </div>
                                                <span><em>(Position)</em></span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <label
                                                        style="font-style: italic; display: block; margin-right: 10px;">Jabatan</label>
                                                    <input class="form-control" type="text" id="positionfacknowledged"
                                                        name="positionfacknowledged" value="" />
                                                </div>
                                                <span><em>(Positionme)</em></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <label for="getbulan"
                                                        style="font-style: italic; display: block; margin-right: 10px;">Tanggal</label>
                                                    <input class="form-control" type="date" name="dateofcheck"
                                                        value="2023-06-01" id="getbulan" />
                                                </div>
                                                <span><em>(Date)</em></span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <label for="getbulan"
                                                        style="font-style: italic; display: block; margin-right: 10px;">Tanggal</label>
                                                    <input class="form-control" type="date" name="dateofacknowledged"
                                                        value="2023-06-01" id="getbulan" />
                                                </div>
                                                <span><em>(Date)</em></span>
                                            </td>

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
            </div>
            <br>
            <div class="row">
                <div class="col-12 ">
                    <div class="card h-100">

                        <div class="card-body">
                            <div class="border rounded p-3 mt-2">
                                <div class="row gap-4 gap-sm-0">

                                    <div class="col-12 col-sm-4 mt-2">
                                        <div class="col-md-12" id="btnsave">
                                            <button type="button" class="btn btn-primary btn-save" onclick="save()"><i
                                                    class="fa fa-refresh"></i>
                                                Save</button>
                                            <button type="submit" class="btn btn-success"><i class="fa fa-print"></i>
                                                Print</button>
                                            {{-- <a href="{{ route('verifikasi.index') }}" class="btn btn-outline-primary "
                                                for="btnradio1">Verifikasi perbaikan</a> --}}
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
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
                            $('.namaparaf').append('<option value="' + item
                                .personalid +
                                '">' +
                                item.nama + '</option>');
                            $('#selectnamaknow').append('<option value="' + item.personalid +
                                '">' +
                                item.nama + '</option>');
                            $('#selectnamacheck').append('<option value="' + item.personalid +
                                '">' +
                                item.nama + '</option>');
                        });


                        $('#selectnamaknow').change(function() {
                            var selectednama = $(this).val();
                            console.log(data.listTk.Results);
                            var selectedItem = data.listTk.Results.find(function(obj) {
                                return obj.personalid == selectednama;
                            });

                            if (selectedItem) {
                                $('#positionfacknowledged').val(selectedItem.jabatan_nama);
                                $('#nameofacknowledged').val(selectedItem.nama);
                            } else {
                                $('#jabatan').val('');
                            }

                        });

                        $('#selectnamacheck').change(function() {
                            var selectednama = $(this).val();
                            console.log(data.listTk.Results);
                            var selectedItem = data.listTk.Results.find(function(obj) {
                                return obj.personalid == selectednama;
                            });

                            if (selectedItem) {
                                $('#positionofcheck').val(selectedItem.jabatan_nama);
                                $('#nameofcheck').val(selectedItem.nama);
                            } else {
                                $('#positionofcheck').val('');
                            }

                        });


                    } else {
                        console.log('Invalid response data: listTk is not an array');
                    }



                    swal.close();
                },
                error: function(error) {
                    console.log(error);
                }
            });

        });

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
                            url: '{{ route('perbaikan.store') }}',
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
