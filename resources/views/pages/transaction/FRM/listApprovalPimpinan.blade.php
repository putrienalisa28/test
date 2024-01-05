@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')


    <div class="container-fluid flex-grow-1 container-p-y">
        <div style="display: flex; justify-content: space-between; align-items: center;" class="mb-3">
            <h4 class="fw-bold py-1 mb-2"><span class="text-muted fw-light">Approval /</span> FRM-SYS-014a-02</h4>
            <!-- DataTable with Buttons -->
        </div>
        <div class="row g-4">
            @foreach ($list_jabatan['jabatan'] as $key => $jabatan)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h6 class="fw-normal mb-2">Total {{ $list_jabatan['total'][$key] }} Dokumen</h6>
                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    title="Total Document" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{ asset('img/avatars/user.png') }}"
                                        alt="Avatar" />
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex justify-content-between align-items-end mt-1">
                            <div class="role-heading">
                                <h4 class="mb-1">{{ $jabatan }}</h4>
                                <a href="{{ route(@$form[0]['link_approval'], @$form[0]['form_id']) }}" data-bs-toggle="modal" data-bs-target="#addRoleModal"
                                    class="role-edit-modal"><span>View List</span></a>
                            </div>
                            <a href="javascript:void(0);" class="text-muted"><i class="ti ti-copy ti-md"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        
    </div>
    @endsection
