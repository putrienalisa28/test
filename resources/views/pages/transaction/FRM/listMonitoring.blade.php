@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="fw-semibold mb-4">List Monitoring </h4>

        <div class="alert alert-info d-flex align-items-center" role="alert">
            <span class="alert-icon text-info me-2">
                <i class="ti ti-info-circle ti-xs"></i>
            </span>
            Silahlkan Pilih Salah Satu Form Untuk Melakukan Monitoring
        </div>
        <!-- Role cards -->
        <div class="row g-4">
            @foreach ($forminput as $key => $form)
                <div class="col-md-4 col-sm-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="mb-0 card-title">{{ $form['form_name'] . '-' . $form['form_revisi'] }}</h5>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="projectStatusId" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="projectStatusId">
                                    @if ($form['link_monitoring'] != '')
                                        <a class="dropdown-item"
                                            href="{{ route($form['link_monitoring'], $form['form_id']) }}">View More</a>
                                    @endif
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
                                    </div>
                                    {{-- <p class="mb-0 text-success">+10.2%</p> --}}
                                </div>
                            </div>
                            <div id="projectStatusChart"></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!--/ Add Role Modal -->

        <!-- / Add Role Modal -->
    </div>
@endsection
