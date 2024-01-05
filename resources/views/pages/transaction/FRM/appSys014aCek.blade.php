@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')


    <div class="container-fluid flex-grow-1 container-p-y">
        <div style="display: flex; justify-content: space-between; align-items: center;" class="mb-3">
            <h4 class="fw-bold py-1 mb-2"><span class="text-muted fw-light">Approval /</span> FRM-SYS-014a-02</h4>
            <!-- DataTable with Buttons -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card p-4">
                    <div class="card-title fw-bold fs-5">List Approval</div>
                    <div class="card-datatable table-responsive pt-3" style="height: 700px;">
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
                                            <a href="{{ route('frm.view2', $data->headerid) }}"
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
