@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')

    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="fw-bold py-1 mb-2"><span class="text-muted fw-light"></span> Dashboaord</h4>
        <div class="row">
            <!-- View sales -->
            <div class="col-xl-4 mb-4 col-lg-5 col-12">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-7">
                            <div class="card-body text-nowrap">
                                <h5 class="card-title mb-0">Congratulations ! 🎉</h5>
                                <p class="mb-2">Best seller of the month</p>
                                <h4 class="text-primary mb-1">$48.9k</h4>
                                <a href="javascript:;" class="btn btn-primary">View Sales</a>
                            </div>
                        </div>
                        <div class="col-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('img/illustrations/card-advance-sale.png') }}" height="140"
                                    alt="view sales" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- View sales -->

            <!-- Statistics -->
            <div class="col-xl-8 mb-4 col-lg-7 col-12">
                <div class="card h-100">
                    <div class="card-header">
                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="card-title mb-0">Realtime Machine Running (Hours)</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row gy-3">
                            @foreach ($runningMachine as $run)
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded-pill bg-label-primary me-3 p-2">
                                            <i class="ti ti-clock ti-sm"></i>
                                        </div>
                                        <div class="card-info">
                                            <h5 class="mb-0">{{ number_format($run->run_hour) }}</h5>
                                            <small>{{ strtoupper($run->machine) }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Statistics -->

            <div class="col-xl-8 mb-4 col-lg-7 col-12">
                <div class="card">
                    {{-- <div class="card-header">
                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="card-title mb-0">TPMS Stats Progress</h5>
                        </div>
                    </div> --}}
                    <div class="col-xl-12 col-md-12 col-12">
                        <form action="">
                            <div class="row mt-4 ms-1">
                                <div class="col-5">
                                    <div class="input-group">
                                        <select class="form-select form-select-md form-input select w-25" id="pemborong"
                                            name="pemborong">
                                            <option value="0">Pilih Machine</option>

                                        </select>
                                        <select class="form-select form-select-md form-input select w-25" id="dept"
                                            name="dept">
                                            <option value="0">Pilih Sparepart</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group">
                                        {{-- <select name="pencarian_by" class="form-select" id="searchBy">
                                            <option value="2">Sparepart</option>
                                        </select> --}}
                                        <input type="text" class="form-control pencarian-tk w-50" id="valPencarian"
                                            name="value_pencarian" placeholder="Silahkan masukkan kata kunci"
                                            aria-describedby="btnPencarian" autofocus />
                                        <button class="btn btn-success" id="btnPencarian" type="submit"><i
                                                data-feather="search" class="me-25"></i>Cari</button>
                                    </div>
                                    <input name="status_tk" type="hidden" id="valListTk" value="1">
                                    <!-- 1.karyawan, 2. harian/borongan -->
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="d-flex align-items-end row ms-1">
                        <div class="table-responsive pt-3" style="height: 540px;">
                            <table class="table table-striped table-hover table-bordered" id="datatable"
                                style="font-size: 11px; line-height: 0px; width: 98%;">
                                <thead>
                                    <tr>
                                        <th hidden>No</th>
                                        <th>Sparepart</th>
                                        <th>Interval</th>
                                        <th>Last Interval</th>
                                        <th>Stok</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 mb-4 col-lg-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="card-title mb-0">TPMS Stats Progress</h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-end row">
                        <div class="table-responsive text-nowrap pt-3" style="height: 510px;">

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection
