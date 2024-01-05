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
                    <div class="card-title fw-bold fs-5">List Verifikasi Perbaikan</div>
                    <div class="card-datatable table-responsive pt-3" style="height: 350px;">
                        <table class="table table-responsive table-striped table-hover" id="datatable">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">Nomor</th>
                                    <th style="text-align: center;">No</th>
                                    <th>Nama Peralatan</th>
                                    <th>Kode</th>
                                    <th>JENIS KERUSAKAN</th>
                                    <th>TINDAKAN YANG DILAKUKAN</th>
                                    <th>TANGGAL</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td rowspan='6' style="text-align: center;">{{ @$header[0]['nomor'] }}</td>
                                    </tr>
                                    @foreach ($header as $key => $data)
                                        <tr style="cursor: pointer;">
                                            <td style="text-align: center;">{{ $key + 1 }}</td>
                                            <td>{{ $data->nama_peralatan }}</td>
                                            <td>{{ $data->kode }}</td>
                                            <td>{{ $data->kerusakan }}</td>
                                            <td>{{ $data->tindakan }}</td>
                                            <td>{{ $data->tanggal }}</td>
                                            <td>
                                                <a href="{{ route('frm.verifikasi', [$data->headerid, $data->id]) }}"
                                                    class="btn btn-primary btn-xs">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
