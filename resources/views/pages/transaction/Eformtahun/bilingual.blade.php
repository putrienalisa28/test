@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">
        <form id="form-data">
            @csrf
            <div class="row">
                <div class="col-12 ">
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

                                    <div class="col-12 col-sm-4" id="select2">
                                        <div class="d-flex gap-2 align-items-center">
                                            <div class="badge rounded bg-label-success mb-1 p-1">
                                                <i class="ti ti-files ti-sm"></i>
                                            </div>
                                            <h6 class="mb-0">No Surat</h6>
                                        </div>
                                        <div class="col-md-10">
                                            <select id="selectmachine" class="select2 form-select" name="mesinid">
                                                <option value="">Select</option>
                                                {{-- @foreach ($bilingual as $item)
                                                    <option value="{{ $item['nosurat'] }}">{{ $item['nosurat'] }}
                                                    </option>
                                                @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4" id="select2">
                                        <div class="d-flex gap-2 align-items-center">
                                            <div class="badge rounded bg-label-primary mb-1 p-1">
                                                <i class="ti ti-settings ti-sm"></i>
                                            </div>
                                            <h6 class="mb-0">Machine/Perlatan</h6>
                                        </div>
                                        <div class="col-md-10">
                                            <select id="selectmachine" class="select2 form-select" name="mesinid">
                                                <option value="">Select</option>
                                                {{-- @foreach ($bilingual as $item)
                                                    <option value="{{ $item['nosurat'] }}">{{ $item['nosurat'] }}
                                                    </option>
                                                @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="col-12 col-sm-4 mt-4">
                                        <div class="col-md-12" id="btnsave">
                                            <button type="button" class="btn btn-primary btn-save" onclick="save()"><i
                                                    class="fa fa-refresh"></i>
                                                Save</button>
                                            <button type="submit" class="btn btn-success"><i class="fa fa-print"></i>
                                                Print</button>
                                            <a href="{{ route('verifikasitahun.index') }}" class="btn btn-outline-primary"
                                                for="btnradio1">Verifikasi perbaikan</a>
                                        </div>
                                    </div> --}}


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
                        <div class="accordion-body m-3">
                            <div class="table-responsive text-nowrap pt-3">
                                <table id="tableContainer"
                                    class="table table-responsive table-bordered table-striped table-hover">
                                    <tr style="text-align:center;">
                                        <th style="width: 50px;" rowspan="3"> <img
                                                src="{{ asset('public/img/logo-01042022.png') }}"></th>
                                        <th style="width: 50px;">PT RIAU SAKTI UNITED PLANTATIONS</th>
                                        <th style="width: 50px;" rowspan=""> <input type="text" name="nosurat"
                                                id="nosurat" value=""
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
                            <div class="table-responsive text-nowrap pt-3">
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
                                            <th rowspan="2" style=" width: 100%;">
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
                                        @foreach ($bilingual as $x)
                                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                                            <td hidden><input type="text" name="hdrsys[]" value="{{ $x->hdr_id }}"
                                                    class="form-control form-control-plaintext form-control-sm"></td>
                                            <td hidden><input type="text" name="dtlsys[]" value="{{ $x->id }}"
                                                    class="form-control form-control-plaintext form-control-sm"></td>
                                            <td><input type="text" name="perawatan[]" value="{{ $x->machine_name }}"
                                                    class="form-control form-control-plaintext form-control-sm"></td>
                                            <td><input type="text" name="code[]" value="{{ $x->code }}"
                                                    class="form-control form-control-plaintext form-control-sm"></td>
                                            <td>
                                                <textarea name="jeniskerusakan[]" class="form-control form-control-plaintext form-control-sm">{{ $x->subcategory_name }}</textarea>
                                            </td>

                                            <td>
                                                <textarea name="tindakan[]" value=""class="form-control form-control-plaintext form-control-sm"></textarea>

                                            </td>
                                            <td><input type="text" name="tanggal[]"
                                                    value="{{ $x->days . ' ' . date('F Y', strtotime($x->month)) }}"
                                                    class="form-control form-control-plaintext form-control-sm md-4"></td>

                                            <td>
                                                <input type="text" name="mulai[]" value=""
                                                    class="form-control form-control-plaintext form-control-sm">
                                            </td>
                                            <td>
                                                <input type="text" name="selesai[]" value=""
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
                                                <input type="text" name="nama[]" value=""
                                                    class="form-control form-control-plaintext form-control-sm">
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

                                            </th>
                                            <th height="100" style="vertical-align: middle; text-align: center">

                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><span style="display: block;">Nama</span>
                                                <span><em>(Name)</em></span>
                                            </td>
                                            <td><span style="display: block;">Nama</span>
                                                <span><em>(Name)</em></span>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td><span style="display: block;">Jabatan</span>
                                                <span><em>(Position)</em></span>
                                            </td>
                                            <td><span style="display: block;">Jabatan</span>
                                                <span><em>(Position)</em>
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



        </form>
    </div>

    <!-- Your HTML code here -->

    <script>
        function ceksurat() {
            var ssrt = document.getElementById("selectnosurat");
            var selectElement = ssrt.value;
            // return selectElement;
            var inputElement = document.getElementById("nosurat");
            inputElement.value = selectElement;


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
