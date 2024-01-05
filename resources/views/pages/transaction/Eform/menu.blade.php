@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">


        <div class="alert alert-info d-flex align-items-center" role="alert">
            <span class="alert-icon text-info me-2">
                <i class="ti ti-info-circle ti-xs"></i>
            </span>
            Silahlkan Pilih Salah Satu Form Untuk Melakukan Transaksi
        </div>
        <!-- Role cards -->
        <div class="row g-4">
            @foreach ($forminput as $key => $form)
                <div class="col-md-4 col-sm-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="mb-0 card-title">{{ $form['form_name'] . '-' . $form['form_revisi'] }}</h5>

                            <div class="dropdown" class="mb-0 mb-7 card-title">
                                <button type="button" class="btn text-nowrap d-inline-block">
                                    <span class="tf-icons ti-sm ti ti-home"></span>
                                    <span
                                        class="badge rounded-pill bg-danger text-white badge-notifications">{{ $form['urut'] }}</span>
                                </button>

                                <button class="btn p-0" type="button" id="projectStatusId" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="projectStatusId">
                                    <a class="dropdown-item" href="{{ route($form['form_route'], $form['form_id']) }}">View
                                        More</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <div class="badge rounded bg-label-warning p-2 me-3 rounded">
                                    <i class="ti ti-list-details ti-sm"></i>
                                </div>
                                <div class="d-flex justify-content-between w-100 gap-2 align-items-center mb-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">{{ $form['form_judul'] }}</h6>
                                        <small class="text-muted">{{ $form['identifikasi'] }}</small>
                                    </div>

                                </div>
                            </div>
                            <div id="projectStatusChart"></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
