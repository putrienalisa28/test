@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')


    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 col-xl-12 col-md-12">
                <div class="card h-100">
                    <div class="card-header ">
                        <div class="card-title mb-md-0">
                            <div class="alert alert-info" role="alert">This is a success alert — check it out!
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
                                    @foreach ($dtlverifikasi as $key => $x)
                                        @foreach ($x->perbaikanDetail as $y)
                                            <td>

                                                <a class="btn btn-primary btn-xs btn-edit"
                                                    href="{{ route('verifikasitahun.index', $y->dtlsys) }}">
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
