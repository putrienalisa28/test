@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')


    <div class="container-fluid flex-grow-1 container-p-y">
        {{-- <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 mb-4 mb-xl-0">
                                <small class="text-light fw-semibold">Vertical</small>
                                <div class="mt-3">
                                    <div class="row">
                                        <div class="col-md-4 col-12 mb-3 mb-md-0">
                                            @foreach ($bilingual['hdr'] as $key => $hdr)
                                                <div class="list-group">
                                                    <a class="list-group-item list-group-item-action" id="list-home-list"
                                                        data-bs-toggle="list"
                                                        href="#list-home-{{ $key }}">{{ $hdr->nosurat }}</a>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="col-md-8 col-12">
                                            <div class="tab-content p-0">
                                                @foreach ($bilingual['hdr'] as $key => $hdr)
                                                    <div class="tab-pane fade show " id="list-home-{{ $key }}">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <th>#</th>
                                                                <th>Nosurat</th>
                                                                <th>Departmen</th>
                                                                <th>Mesin / Peralatan</th>
                                                                <th>Category</th>
                                                                <th>Sub Category</th>
                                                                <th>Tanggal</th>
                                                                <th>Created By</th>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($bilingual['dtl-bilingual'] as $dtl)
                                                                    @if ($hdr->id == $dtl->hdr_id)
                                                                        <tr style="line-height: -10px;">
                                                                            <td colspan="3"></td>
                                                                            <td style="text-align: center;">
                                                                                {{ $dtl->machine_name }}
                                                                            </td>
                                                                            <td style="text-align: center;">
                                                                                {{ $dtl->category_name }}</td>
                                                                            <td text-align: center;>
                                                                                {{ $dtl->subcategory_name }}
                                                                            </td>
                                                                            <td text-align: center;>
                                                                                {{ $dtl->subcategory_name }}
                                                                            </td>
                                                                            <td colspan="2" text-align: center;>
                                                                                {{ $dtl->days . ' ' . date('F Y', strtotime($hdr->month)) }}
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                @endforeach

                                            </div>





                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

        <div class="col-12 col-sm-12 col-md-12">
            <div class="card h-100">
                <div class="card-body">
                    <div class="alert alert-primary d-flex align-items-center mb-3" role="alert" button type="button"
                        data-bs-toggle="modal" data-bs-target="#fullscreenModal">
                        <span class="alert-icon text-primary me-2">
                            <i class="ti ti-info-circle ti-xs"></i>
                        </span>
                        Please click here to view all transactions
                    </div>
                    <div class="row align-items-center">
                        <div class="col-12 col-sm-12 mb-3">
                            <input type="text" class="form-control" id="search_input"
                                placeholder="Type your search term..">
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
                    {{-- <div class="table-responsive pt-0 p-2">
                        <table class="table table-bordered data_table">
                            <thead>
                                <th>#</th>
                                <th>Nosurat</th>
                                <th>Departmen</th>
                                <th>Mesin / Peralatan</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Tanggal</th>
                                <th>Created By</th>
                            </thead>

                            <tbody>
                                @foreach ($bilingual['hdr'] as $hdr)
                                    <tr style="line-height: -10px;">
                                        <td>
                                            <a class="btn btn-primary btn-xs btn-edit"
                                                href="{{ route('perbaikanharian.index', $hdr->id) }}"><i
                                                    class="fa fa-edit"></i></a>
                                        </td>

                                        <td style="text-align: center;">{{ $hdr->nosurat }}</td>
                                        <td text-align: center;>{{ $hdr->dept }}</td>
                                        <td style="text-align: center;">{{ $hdr->created_by }}</td>

                                        @php
                                            $foundDtl = false;
                                        @endphp
                                    </tr>
                                    @foreach ($bilingual['dtl-bilingual'] as $dtl)
                                        @if ($hdr->id == $dtl->hdr_id)
                                            <tr style="line-height: -10px;">
                                                 <td colspan="3"></td> 
                    <td style="text-align: center;">{{ $dtl->machine_name }}</td>
                    <td style="text-align: center;">{{ $dtl->category_name }}</td>
                    <td text-align: center;>{{ $dtl->subcategory_name }}</td>
                    <td text-align: center;>{{ $dtl->subcategory_name }}</td>
                     <td colspan="2" text-align: center;>
                                                    {{ $dtl->days . ' ' . date('F Y', strtotime($hdr->month)) }}</td> 
                    </tr>
                    @php
                        $foundDtl = true;
                    @endphp
                    @endif
                    @endforeach
                    @if (!$foundDtl)
                    @endif
                    @endforeach
                    </tbody>
                    </table>
                </div>  --}}
                    <div class="table-responsive text-nowrap">
                        <table class="table table-responsive table-bordered table-hover" id="table_perbaikan">
                            <thead>
                                <tr style="text-align: center; line-height: 1px; ">
                                    <th>#</th>
                                    <th>Nosurat</th>
                                    <th>Departmen</th>
                                    <th>Mesin / Peralatan</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Tanggal</th>
                                    <th>Created By</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bilingual['hdr'] as $hdr)
                                    <tr style="line-height: -10px;">
                                        <td>
                                            <a class="btn btn-primary btn-xs btn-edit"

                                                href="{{ route('perbaikanharian.index', $hdr->id) }}"><i

                                                    class="fa fa-edit"></i></a>
                                        </td>
                                        <td hidden style="text-align: center;">{{ $hdr->id }}</td>
                                        <td style="text-align: center;">{{ $hdr->nosurat }}</td>
                                        <td colspan="5"text-align: center;>{{ $hdr->dept }}</td>
                                        <td style="text-align: center;">{{ $hdr->created_by }}</td>
                                        @php
                                            $foundDtl = false;
                                        @endphp
                                    </tr>
                                    @foreach ($bilingual['dtl-bilingual'] as $dtl)
                                        @if ($hdr->id == $dtl->hdr_id)
                                            <tr style="line-height: -10px;">
                                                <td colspan="3"></td>
                                                <td style="text-align: center;">{{ $dtl->machine_name }}</td>
                                                <td style="text-align: center;">{{ $dtl->category_name }}</td>
                                                <td text-align: center;>{{ $dtl->subcategory_name }}</td>
                                                <td colspan="2" text-align: center;>
                                                    {{ $dtl->days . ' ' . date('F Y', strtotime($hdr->month)) }}</td>
                                            </tr>
                                            @php
                                                $foundDtl = true;
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if (!$foundDtl)
                                        <tr>
                                            <td colspan="4"></td>
                                        </tr>
                                    @endif
                                @endforeach


                        </table>
                    </div>
                </div>
            </div>


        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="fullscreenModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFullTitle">List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="accordion" id="collapsibleSection">
                        @foreach ($bilingual['alldataperbaikan'] as $key => $hdr)
                            <div class="card accordion-item">
                                <h2 class="accordion-header" id="headingDeliveryAddress">
                                    <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseDeliveryAddress-{{ $key }}" aria-expanded="true"
                                        aria-controls="collapseDeliveryAddress">
                                        {{ $hdr->nosurat . ' - ' . $hdr->mesinname }}


                                    </button>
                                </h2>
                                <div id="collapseDeliveryAddress-{{ $key }}" class="accordion-collapse collapse "
                                    data-bs-parent="#collapsibleSection">
                                    <div class="accordion-body">
                                        <div class="row g-3">

                                            <table class="table table-responsive table-bordered table-striped table-hover"
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
                                                    <a class="btn btn-label-secondary d-grid w-100 mb-2" target="_blank"
                                                        href="{{ route('printinput.index', $hdr->id) }}"><i
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
                        </table>
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
        // $(document).ready(function() {
        //     $('.data_table').DataTable();
        // });
        document.addEventListener('DOMContentLoaded', function() {
            var searchInput = document.getElementById('search_input');
            var tableRows = document.querySelectorAll('#table_perbaikan tbody tr');

            searchInput.addEventListener('keyup', function() {
                var searchValue = searchInput.value.toLowerCase();
                console.log('Search Value:', searchValue);

                tableRows.forEach(function(row) {
                    console.dir(row);
                    var rowData = row.innerText.toLowerCase();

                    if (rowData.indexOf(searchValue) > -1) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
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
