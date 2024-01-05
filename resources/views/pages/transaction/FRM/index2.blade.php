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
                    <div class="card-title fw-bold fs-5">List Kerusakan dan Penggantian Alat/ Mesin</div>
                    <div class="card-datatable table-responsive pt-3" style="height: 350px;">
                        <table class="table table-responsive table-striped table-hover" id="datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Periode</th>
                                    <th>No. Ref</th>
                                    <th>Dept/ Bag</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Dibuat Oleh</th>
                                    <th>Disetujui Oleh</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($header as $key => $data)
                                    <tr style="cursor: pointer;">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $data->kode_periode }}</td>
                                        <td>{{ $data->nomor }}</td>
                                        <td>{{ $data->department }}</td>
                                        <td>{{ $data->created_at }}</td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="{{ route('frm.cekform', $data->headerid) }}"
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
