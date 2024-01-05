@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')


    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="row">
            <div>
                <div class="alert alert-info d-flex align-items-center" role="alert" button type="button"
                    data-bs-toggle="modal" data-bs-target="#fullscreenModal">
                    <span class="alert-icon text-info me-2">
                        <i class="ti ti-info-circle ti-xs"></i>
                    </span>Please click here to view all transactions Verification
                </div>
            </div>
            <div class="col-12 col-xl-12 col-md-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="border rounded p-3 ">
                            <div class="row gap-4 gap-sm-0">
                                <div class="col-12 col-sm-4">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="badge rounded bg-label-info mb-1 p-1">
                                            <i class="ti ti-files ti-sm"></i>
                                        </div>
                                        <h6 class="mb-0">No surat</h6>

                                    </div>
                                    <div class="col-md-12">
                                        <select id="nosurat" class="select form-select" name="nosurat"
                                            onchange="nosurat()">
                                            <option value="">Select</option>
                                            <option value="DPM">DPM</option>
                                            <option value="DRP">DRP</option>
                                            <option value="CWC">CWC</option>
                                            <option value="WTP">WTP</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="col-12 col-sm-4" id="select2">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="badge rounded bg-label-success mb-1 p-1">
                                            <i class="ti ti-settings ti-sm"></i>
                                        </div>
                                        <h6 class="mb-0">Peralatan/machine</h6>
                                    </div>
                                    <div class="col-md-12">
                                        <select id="selectmachine" class="select2 form-select" name="mesinid">
                                            <option value="">Select</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="col-md-12" id="btnsave">
                                            <button type="button" class="btn btn-info btn-save" onclick="save()"><i
                                                    class="fa fa-search"></i>
                                                Search</button>

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


        <form id="form-data">
            @csrf

            <hr class="m-0 p-0" style="padding: 0px; margin:0px;">
            <div class="col-md-12">
                <div class="card p-4">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-responsive table-bordered table-hover">
                            <thead>
                                <tr style="text-align: center; line-height: 1px; ">
                                    <th>#</th>
                                    {{-- <th>No</th> --}}
                                    <th>Bagian yang Diperiksa</th>
                                    <th>Kode</th>
                                    <th>Jenis Kerusakan</th>
                                    <th>Tindakan yang dilakukan</th>
                                    <th>Area</th>
                                    <th>Jam</th>
                                    <th>Total Jam</th>
                                </tr>
                            </thead>

                            <tbody id="">
                                <tr>
                                    @foreach ($dataperbaikan as $key => $x)
                                        @foreach ($x->bilingualDetail as $y)
                                            <td>


                                                <a class="btn btn-info btn-xs btn-edit"


                                                    href="{{ route('verifikasi015.index', $y->dtlsys) }}">

                                                    <i class="fa fa-edit"></i></a>
                                            </td>
                                            <td>{{ $y->perawatan }}</td>
                                            <td>{{ $y->code }}</td>
                                            <td>{{ $y->kerusakan }}</td>
                                            <td>{{ $y->tindakan }}</td>
                                            <td>{{ $x->dept }}</td>
                                            <td>{{ $y->mulai . ' - ' . $y->selesai }}</td>
                                            <td>{{ $y->totaljam }}</td>
                                </tr>
                                @endforeach
                                @endforeach
                        </table>

                    </div>
                </div>
            </div>


        </form>
    </div>
    <div class="modal fade" id="fullscreenModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFullTitle">List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="accordion" id="collapsibleSection">
                        @foreach ($dataverifikasi as $key => $hdr)
                            <div class="card accordion-item">
                                <h2 class="accordion-header" id="headingDeliveryAddress">
                                    <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseDeliveryAddress-{{ $key }}" aria-expanded="true"
                                        aria-controls="collapseDeliveryAddress">
                                        {{ $hdr->area . ' - ' . $hdr->namamesin . ' - ' . $hdr->jeniskerusakan }}


                                    </button>
                                </h2>
                                <div id="collapseDeliveryAddress-{{ $key }}" class="accordion-collapse collapse "
                                    data-bs-parent="#collapsibleSection">
                                    <div class="accordion-body">
                                        <div class="row g-3">

                                            {{-- <table class="table table-responsive table-bordered table-striped table-hover"
                                                id="tbl_perbaikan">
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
                                                <tbody>
                                                    <a class="btn btn-primary  btn-print" href=""><i
                                                            class="fa fa-print"></i></a>
                                                    @foreach ($hdr['bilingualDetail'] as $x)
                                                        <td style="text-align: center;">{{ $loop->iteration }}</td>
                                                        <td hidden><input type="text" name="dtlsys[]"
                                                                value="{{ $x->id }}"
                                                                class="form-control form-control-plaintext form-control-sm">
                                                        </td>
                                                        <td><input readonly type="text" name="perawatan[]"
                                                                value="{{ $x->perawatan }}"
                                                                class="form-control form-control-plaintext form-control-sm">
                                                        </td>
                                                        <td><input readonly="text" name="code[]"
                                                                value="{{ $x->code }}"
                                                                class="form-control form-control-plaintext form-control-sm">
                                                        </td>
                                                        <td>
                                                            <textarea readonly name="jeniskerusakan[]" class="form-control form-control-plaintext form-control-sm">{{ $x->kerusakan }}</textarea>
                                                        </td>

                                                        <td>
                                                            <textarea name="tindakan[]" value=""class="form-control form-control-plaintext form-control-sm">{{ $x->tindakan }}</textarea>

                                                        </td>
                                                        <td><input type="text" readonly name="tanggal[]"
                                                                value="{{ $x->tanggal_sys }}"
                                                                class="form-control form-control-plaintext form-control-sm md-4">
                                                        </td>

                                                        <td>
                                                            <input type="time" name="mulai[]"
                                                                value="{{ $x->mulai }}"
                                                                class="form-control form-control-plaintext form-control-sm">
                                                        </td>
                                                        <td>
                                                            <input type="time" name="selesai[]"
                                                                value="{{ $x->selesai }}"
                                                                class="form-control form-control-plaintext form-control-sm">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="totaljam[]"
                                                                value="{{ $x->totaljam }}"
                                                                class="form-control form-control-plaintext form-control-sm">
                                                        </td>
                                                        <td>
                                                            <textarea name="keterangan[]" value=""class="form-control form-control-plaintext form-control-sm"></textarea>

                                                        </td>
                                                        <td>
                                                            <select id="" class="select2 form-select namaparaf"
                                                                name="nama[]">
                                                                <option value="">Select</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="paraf[]" value=""
                                                                class="form-control form-control-plaintext form-control-sm">
                                                        </td>
                                                </tbody>
                        @endforeach
                        </table> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                            Close
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Your HTML code here -->

    <script>
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
