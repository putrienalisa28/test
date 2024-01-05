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

        .bg-rencana-awal {
            background-color: black !important;
            color: rgb(8, 8, 8);
        }
    </style>

    <div class="container-fluid flex-grow-1 container-p-y">
        <div style="display: flex; justify-content: space-between; align-items: center;" class="mb-3">
            <!-- DataTable with Buttons -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card p-4">
                    <div class="container-fluid flex-grow-1 container-p-y">
                        <form id="form-data">
                            @csrf
                            <div class="row m-1 mt-4">
                                <div class="col-md-6">
                                    <a href="{{ route('frm.printDatapdf', $header[0]['headerid']) }}"
                                                class="btn btn-primary">
                                                <i class="fa fa-print"></i>&nbsp;Print
                                            </a>
                                </div>
                            </div>
                            <br>
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
                                                        <label>No : {{ $header[0]['nomor'] }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th scope="col" style="vertical-align:middle; text-align: center;">
                                            <p class="fonthead"></p>{{ $forminput[0]['form_judul'] }}
                                            <br>{{ $forminput[0]['form_bilingual'] }}
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                            <br><br>
                            <div class="card-datatable table-responsive pt-3" style="height: 700px;">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th rowspan="2"
                                                style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                                NO</th>
                                            <th rowspan="2"
                                                style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                                NAMA PERALATAN<br>(Equipment Nmae)</th>
                                            <th rowspan="2"
                                                style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                                KODE<br>(Code)</th>
                                            <th rowspan="2"
                                                style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                                JENIS KERUSAKAN</th>
                                            <th rowspan="2"
                                                style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                                TINDAKAN YANG DILAKUKAN<br>(Action Conducted)</th>
                                            <th rowspan="2"
                                                style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                                TGL<br>(Date)</th>
                                            <th colspan="2"
                                                style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                                Jam<br>(Hour)</th>
                                            <th rowspan="2"
                                                style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                                TOTAL JAM</th>
                                            <th rowspan="2"
                                                style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                                KETERANGAN<br>(Remarks)</th>
                                            <th rowspan="2"
                                                style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                                NAMA<br>(Name)</th>
                                            <th rowspan="2"
                                                style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                                Paraf<br>(Initials)</th>
                                            {{-- <th rowspan="2"
                                                style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                                Verifikasi</th> --}}

                                        </tr>
                                        <th style="text-align: center;"> MULAI</th>
                                        <th style="text-align: center;">SELESAI</th>
                                        <tr>
                                    </thead>
                                    <tbody id="tbody-list-detail">
                                        @foreach ($detail as $key => $data)
                                            <tr style="cursor: pointer;">
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $data->nama_peralatan }}</td>
                                                <td>{{ $data->kode }}</td>
                                                <td>{{ $data->kerusakan }}</td>
                                                <td>{{ $data->tindakan }}</td>
                                                <td>{{ $data->tanggal }}</td>
                                                <td>{{ $data->mulai }}</td>
                                                <td>{{ $data->selesai }}</td>
                                                <td>{{ $data->jam }}</td>
                                                <td>{{ $data->keterangan }}</td>
                                                <td>{{ $data->nama }}</td>
                                                <td>{{ $data->paraf_by }}</td>
                                                {{-- <td class="text-center">
                                                    <a href="{{ route('frm.verifikasi', [$header[0]['headerid'], $data->id]) }}"
                                                        class="btn btn-primary btn-xs" title="Buat Verifikasi">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </td> --}}

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <table class="table table-bordered table-hover table-striped table-responsive">
                                    <thead>
                                        <tr>
                                            <th height="300" style="vertical-align: middle; text-align: center; width: 33.3%">
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
                                                                {{ $detail[0]->app1_by }}                                                           
                                                            </td>
                                                            <td style="vertical-align: middle; text-align: left;">Nama
                                                                &nbsp;&nbsp;&nbsp;: 
                                                                {{ $detail[0]->app2_by }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="vertical-align: middle; text-align: left;">
                                                                Jabatan (position):
                                                                {{ $detail[0]->app1_jabatan }}
                                                            </td>
                                                            <td style="vertical-align: middle; text-align: left;">
                                                                Jabatan (position):
                                                                {{ $detail[0]->app2_jabatan }}
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
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    function printData() {
        const printButton = document.getElementById('printButton');
        const url = printButton.href;
        // Buka jendela baru dan muat URL
        window.open(url, '_blank');
    }
     // Tambahkan event listener ke tombol
     document.getElementById('printButton').addEventListener('click', function(e){
        e.preventDefault();
        // Panggil fungsi print
        printData();
    });
    </script>
@endsection
