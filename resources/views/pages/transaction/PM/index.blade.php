@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="fw-semibold mb-4">List Of Machine UHT</h4>

        <div class="alert alert-info d-flex align-items-center" role="alert">
            <span class="alert-icon text-info me-2">
                <i class="ti ti-info-circle ti-xs"></i>
            </span>
            Silahlkan Pilih Salah Satu Machine Untuk Melakukan Transaksi
        </div>
        <!-- Role cards -->
        <div class="row g-4">
            @foreach ($machine as $key => $item)
                <div class="col-12 col-xl-4  col-md-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="mb-0 card-title">{{ $item['machine_name'] }}</h5>

                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="projectStatusId" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="projectStatusId">
                                    <a class="dropdown-item"
                                        href="{{ route('pm.maintenance', ['id' => $item['machine_id']]) }}">View More</a>
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
                                        <h6 class="mb-0">Mechine Location</h6>
                                        <small class="text-muted">{{ $item['location'] }}</small>
                                    </div>
                                    {{-- <p class="mb-0 text-success">+10.2%</p> --}}
                                </div>
                            </div>
                            <div id="projectStatusChart"></div>
                            <div class="d-flex justify-content-between mb-3">
                                <h6 class="mb-0">Running Time </h6>
                                <div class="d-flex">
                                    {{-- <p class="mb-0 me-3">$756.26</p> --}}
                                    <p class="mb-0 text-danger">
                                        {{ isset($item['hrm_machine']->actualrun_hour) ? number_format($item['hrm_machine']->actualrun_hour) : 'Not Found' }}
                                    </p>
                                </div>

                            </div>
                            <div class="d-flex justify-content-between mb-3 pb-1">
                                <div class="me-2">
                                    <h6 class="mb-0">Last Maintenance</h6>
                                    {{-- <small class="text-muted">UHT</small> --}}
                                </div>
                                <div class="d-flex">
                                    {{-- <p class="mb-0 me-3">$2,207.03</p> --}}

                                    <p class="mb-0 text-success">
                                        {{ isset($item['hrm_machine']) ? dateFormater($item['hrm_machine']->srvtimestamp) : 'Not Found' }}
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!--/ Add Role Modal -->

        <!-- / Add Role Modal -->
    </div>
@endsection
