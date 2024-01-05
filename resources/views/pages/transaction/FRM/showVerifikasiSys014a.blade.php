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

        .bg-tidak-capai {
            background-color: #E56E96 !important;
            color: white;
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
                                    <button type="button" id='btn-tes' class="btn btn-primary me-sm-3 me-1 btn-save"
                                        onclick="save()">Print</button>
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
                                                        <label>No : </label>
                                                        @if ($header[0]['nomor'] == 'WTP')
                                                            {{ trim($header[0]['nomor']) }}/WPM
                                                        @else
                                                            {{ $header[0]['nomor'] }}
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tanggal :</label>
                                                    {{ $header[0]['tanggal'] }}
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th scope="col" style="vertical-align:middle; text-align: center;">
                                            <p class="fonthead"></p>VERIFIKASI PERBAIKAN MESIN
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="3" style="vertical-align: middle; text-align: left">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleFormControlInput1"
                                                                class="col-sm-4 col-form-label text-sm-end">Nama Mesin
                                                                :&nbsp;&nbsp;&nbsp;</label>
                                                            {{ $header[0]['nama_peralatan'] }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleFormControlInput1"
                                                                class="col-sm-4 col-form-label text-sm-end">Area
                                                                :&nbsp;&nbsp;&nbsp;</label>
                                                            {{ $header[0]['area'] }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="exampleFormControlInput1"
                                                                    class="col-sm-4 col-form-label text-sm-end">Jam
                                                                    :&nbsp;&nbsp;&nbsp;</label>
                                                                {{ $header[0]['antara_jam'] }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleFormControlInput1"
                                                                    class="col-sm-4 col-form-label text-sm-end">Kode
                                                                    :&nbsp;&nbsp;&nbsp;</label>
                                                                {{ $header[0]['kode'] }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleFormControlInput1"
                                                                    class="col-sm-4 col-form-label text-sm-end">Shift
                                                                    :&nbsp;&nbsp;&nbsp;</label>
                                                                {{ $header[0]['shift'] }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="exampleFormControlInput1"
                                                                    class="col-sm-4 col-form-label text-sm-end">Total Jam
                                                                    :&nbsp;&nbsp;&nbsp;</label>
                                                                {{ $header[0]['total_jam'] }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="vertical-align: middle; text-align: left">Jenis Kerusakan
                                            : &nbsp;&nbsp;&nbsp;{{ $header[0]['jenis_kerusakan'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="vertical-align: middle; text-align: left">
                                            Tindakan : &nbsp;&nbsp;&nbsp;{{ $header[0]['tindakan'] }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br><br>
                            <table class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th colspan="3"
                                            style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                            Peralatan / sparepart yang dibawa</th>
                                        <th colspan="4"
                                            style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                            Peralatan yang dikembalikan</th>
                                    </tr>
                                    <th style="text-align: center;">No</th>
                                    <th style="text-align: center;">Nama Peralatan/Sparepart</th>
                                    <th style="text-align: center;"> Qty</th>
                                    <th style="text-align: center;">No</th>
                                    <th style="text-align: center;"> Nama Peralatan/Sparepart</th>
                                    <th style="text-align: center;">Qty</th>
                                    <th style="text-align: center;">Keterangan</th>
                                    <tr>
                                </thead>
                                <tbody>
                                    @foreach ($detail as $key => $data)
                                        <tr style="cursor: pointer;">
                                            <td style="text-align: center;">{{ $key + 1 }}</td>
                                            <td>{{ $data->sparepart_dibawa }}</td>
                                            <td style="text-align: center;">{{ $data->quantity_dibawa }}</td>
                                            <td style="text-align: center;">{{ $key + 1 }}</td>
                                            <td>{{ $data->sparepart_kembali }}</td>
                                            <td style="text-align: center;">{{ $data->quantity_kembali }}</td>
                                            <td>{{ $data->keterangan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <br>
                            <table class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th colspan="3"
                                            style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                            Sparepart yang dipasang/dipakai</th>
                                        <th colspan="4"
                                            style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                            Sparepart yang rusak / sisa sparepart</th>
                                    </tr>
                                    <th style="text-align: center;">No</th>
                                    <th style="text-align: center;">Nama Sparepart*</th>
                                    <th style="text-align: center;"> Qty</th>
                                    <th style="text-align: center;">No</th>
                                    <th style="text-align: center;"> Nama Sparepart%</th>
                                    <th style="text-align: center;">Qty</th>
                                    <th style="text-align: center;">Keterangan</th>
                                    <tr>
                                </thead>
                                <tbody>
                                    @foreach ($detail2 as $key => $data2)
                                        <tr style="cursor: pointer;">
                                            <td style="text-align: center;">{{ $key + 1 }}</td>
                                            <td>{{ $data2->sparepart_pasang }}</td>
                                            <td style="text-align: center;">{{ $data2->quantity_pasang }}</td>
                                            <td style="text-align: center;">{{ $key + 1 }}</td>
                                            <td>{{ $data2->sparepart_rusak }}</td>
                                            <td style="text-align: center;">{{ $data2->quantity_rusak }}</td>
                                            <td>{{ $data2->keterangan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table><br>
                            <table class="table table-bordered table-responsive">
                                <tbody>
                                    <tr>
                                        <td>Dikerjakan Oleh :</td>
                                        <td>1. {{ $header[0]->dikerjakan_by }}</td>
                                        <td>2. {{ $header[0]->dikerjakan2_by }}</td>
                                        <td>3. {{ $header[0]->dikerjakan3_by }}</td>
                                        <td>4. {{ $header[0]->dikerjakan4_by }}</td>
                                    <tr>
                                </tbody>
                            </table><br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card p-4">
                    <div class="card-title fw-bold fs-5">Verifikasi QAD Personil**</div>
                    <table class="table table-bordered table-responsive">

                        <head>
                            <tr>
                                <th></th>
                                <th>Yes</th>
                                <th>No</th>
                            </tr>
                        </head>
                        <tbody>
                            @foreach ($soal as $key=>$data)
                            <tr>
                                <td>{{ ($key+1).'. '.$data->soal }}
                                    <input class="form-control" type="hidden" value="{{ $data->id }}" id="soal"
                                    name="soal[]" />
                                </td>
                                <td>
                                    <div class="col-md-4">
                                        <input class="form-check-input" type="checkbox" value="0" id="status" name="status[]"
                                            {{ $data->status == 0 ? 'checked' : '' }} />
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-4">
                                        <input class="form-check-input" type="checkbox" value="1" id="status" name="status[]"
                                             {{ $data->status == 1 ? 'checked' : '' }} />
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <table class="table table-bordered table-responsive">
                        <tbody>
                            <tr>
                                <td>Keterangan :<br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*
                                    : Jika ada penggantian spartepart :
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yes
                                    : Tidak terjadi ketidaksesuaian(NC)<br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;**
                                    : Diisi oleh personil QAD
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    No : Terjadi ketidaksesuaian(NC)</td>
                            <tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered table-hover table-striped"
                        style="vertical-align: middle; text-align: left; text-transform: capitalize;">
                        <thead>
                            <tr>
                                <th style="vertical-align: middle; text-align: center;">DIBUAT OLEH</th>
                                <th style="vertical-align: middle; text-align: center;">DICEK OLEH</th>
                                <th style="vertical-align: middle; text-align: center;">DIVERIFIKASI OLEH</th>
                            </tr>
                            <tr>
                                <th height="100" style="vertical-align: middle; text-align: center"></th>
                                <th height="100" style="vertical-align: middle; text-align: center"></th>
                                <th height="100" style="vertical-align: middle; text-align: center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="vertical-align: middle; text-align: left;">Nama (Name) &nbsp;&nbsp;&nbsp;: {{ $header[0]->app1_by }}</td>
                                <td style="vertical-align: middle; text-align: left;">Nama &nbsp;&nbsp;&nbsp;: {{ $header[0]->app2_by }}</td>
                                <td style="vertical-align: middle; text-align: left;">Nama &nbsp;&nbsp;&nbsp;: {{ $header[0]->app3_by }}</td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle; text-align: left;">Jabatan (position) : {{ $header[0]->app1_jabatan }}</td>
                                <td style="vertical-align: middle; text-align: left;">Jabatan : {{ $header[0]->app2_jabatan }}</td>
                                <td style="vertical-align: middle; text-align: left;">Jabatan : {{ $header[0]->app3_jabatan }}</td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle; text-align: left;">Tanggal (date) :</td>
                                <td style="vertical-align: middle; text-align: left;">Tanggal :</td>
                                <td style="vertical-align: middle; text-align: left;">Tanggal :</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="col-12" id="tambah">
                        <button type="button" id='btn-tes' class="btn btn-primary me-sm-3 me-1 btn-print"
                            onclick="print()">Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script></script>
@endsection
