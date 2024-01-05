@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')


    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 col-xl-12 col-md-12">
                <div class="card h-100">
                    <div class="card-header ">
                        <div class="card-title mb-md-0">
                            <div class="alert alert-success" role="alert">This is a success alert — check it out!
                            </div>

                        </div>

                    </div>
                    <div class="card-body">
                        <div class="border rounded p-3 ">
                            <div class="row gap-4 gap-sm-0">
                                <div class="col-12 col-sm-4">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="badge rounded bg-label-primary mb-1 p-1">
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
                                            <button type="button" class="btn btn-success btn-save" onclick="save()"><i
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
                                    <th>Nosurat</th>
                                    <th>Departmen</th>
                                    <th>Mesin / Peralatan</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Bagian yang diperiksa</th>
                                    <th>Jenis kerusakan</th>
                                    <th>Tindakan yang dilakukan</th>
                                    <th>Jam</th>
                                    <th>Total jam</th>
                                    <th>Tanggal</th>
                                    <th>Peralatan / Sparepart</th>
                                    <th>Qty</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody id="">
                                @foreach ($all['inputwal'] as $awal)
                                    @foreach ($all['master'] as $master)
                                        @if ($awal->mesin_id == $master->machine_id)
                                            @php
                                                $namaperalatan = $master->machine_name;
                                            @endphp

                                            <tr>
                                                <td>
                                                    <a class="btn btn-primary btn-xs btn-print"
                                                        href="{{ route('printinput.index', ['id' => $awal->id]) }}"><i
                                                            class="fa fa-print"></i></a>
                                                    <a class="btn btn-secondary btn-xs btn-print"><i
                                                            class="fa fa-eye"></i></a>
                                                    <a class="btn btn-danger btn-xs btn-detail toggle-details"><i
                                                            class="fa fa-plus"></i></a>
                                                </td>
                                                <td style="text-align: center;">{{ $awal->nosurat }}</td>
                                                <td style="text-align: center;">{{ $awal->dept }}</td>
                                                <td style="text-align: center;">{{ $namaperalatan }}</td>

                                            </tr>
                                        @endif
                                    @endforeach

                                    @foreach ($awal->FormsysDetail as $x)
                                        @foreach ($all['master'] as $msn)
                                            @foreach ($msn->fm015category as $category)
                                                @foreach ($category->Form015asubcategory as $subcategory)
                                                    @if ($awal->id == $x->hdr_id)
                                                        @php
                                                            $status = $x->status == 't' ? 'Ok' : 'No Ok';
                                                            $statusColor = $x->status == 'f' ? '' : 'color: red;';
                                                        @endphp


                                                        @if ($x->sub_category_id == $subcategory->subcategory_id)
                                                            @php
                                                                $subcategoryname = $subcategory->subcategory_name;
                                                            @endphp

                                                            <tr class="detail-row">
                                                                <td colspan="4"></td>
                                                                <td style="text-align: center;">
                                                                    {{ $category->category_name }}
                                                                </td>
                                                                <td style="text-align: center;">{{ $subcategoryname }}
                                                                </td>
                                                                <td style="text-align: center;">
                                                                    {{ $x->days . ' ' . date('F Y', strtotime($awal->month)) }}
                                                                </td>
                                                                <td style="text-align: center; {{ $statusColor }}">
                                                                    {{ $status }}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @endforeach


                                        @foreach ($all['dtl_perbaikan'] as $perbaikan)
                                            @foreach ($perbaikan->bilingualDetail as $detail)
                                                @if ($detail->dtlsys == $x->id)
                                                    <tr>
                                                        <td colspan="7"></td>
                                                        <td>
                                                            <a class="btn btn-primary btn-xs btn-print" href=""><i
                                                                    class="fa fa-print"></i></a>
                                                            <a class="btn btn-success btn-xs btn-print"
                                                                href="{{ route('perbaikanview.index', $detail->hdr_id) }}"><i
                                                                    class="fa fa-eye"></i></a>
                                                        </td>

                                                        <td style="text-align: center;">{{ $detail->perawatan }}</td>
                                                        <td style="text-align: center;">{{ $detail->kerusakan }}</td>
                                                        <td style="text-align: center;">{{ $detail->tindakan }}</td>
                                                        <td style="text-align: center;">
                                                            {{ $detail->mulai . ' - ' . $detail->selesai }}</td>
                                                        <td style="text-align: center;">{{ $detail->totaljam }}</td>
                                                        <td style="text-align: center;">{{ $detail->tanggal_sys }}</td>

                                                    </tr>


                                                    @foreach ($all['dtl_verifikasi'] as $verifikasi)
                                                        @foreach ($verifikasi->verifikasiDetail as $z)
                                                            @if ($verifikasi->idbilingual == $detail->id)
                                                                <tr>
                                                                    <td colspan="13"></td>
                                                                    <td>
                                                                        <a class="btn btn-primary btn-xs btn-print"
                                                                            href=""><i class="fa fa-print"></i></a>
                                                                        <a class="btn btn-info btn-xs btn-print"
                                                                            href=""><i class="fa fa-eye"></i></a>
                                                                    </td>

                                                                    <td style="text-align: center;">
                                                                        {{ $z->namaperalatan }}
                                                                    <td style="text-align: center;">{{ $z->qty }}
                                                                    </td>
                                                                    <td style="text-align: center;">
                                                                        {{ $z->keterangan }}


                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                @endforeach

                        </table>



                    </div>
                </div>
            </div>


        </form>
    </div>

    <!-- Your HTML code here -->

    <script>
        // document.addEventListener("DOMContentLoaded", function() {
        //     var toggleButtons = document.getElementsByClassName("toggle-details");

        //     for (var i = 0; i < toggleButtons.length; i++) {
        //         toggleButtons[i].addEventListener("click", function() {
        //             var parentRow = this.parentNode.parentNode;
        //             var detailRow = parentRow.nextElementSibling;

        //             while (detailRow && !detailRow.classList.contains("detail-row")) {
        //                 detailRow = detailRow.nextElementSibling;
        //             }

        //             if (detailRow && detailRow.classList.contains("detail-row")) {
        //                 if (detailRow.style.display === "none") {
        //                     detailRow.style.display = "table-row";
        //                 } else {
        //                     detailRow.style.display = "none";
        //                 }
        //             }
        //         });
        //     }
        // });
        // Ambil semua tombol "toggle details"
        var toggleButtons = document.querySelectorAll('.toggle-details');

        // Loop melalui setiap tombol
        toggleButtons.forEach(function(button) {
            // Tambahkan event listener untuk setiap tombol
            button.addEventListener('click', function() {
                // Dapatkan baris detail terkait
                var detailRow = button.closest('tr').nextElementSibling;

                // Toggle kelas CSS 'hidden' pada baris detail
                detailRow.classList.toggle('hidden');
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
