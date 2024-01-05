@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')


    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 col-xl-12 col-md-12">
                <div class="card h-100">
                    <div class="card-header ">
                        <div class="card-title mb-md-0">
                            <div class="alert alert-success" role="alert">This is a success alert — check it out!
                            </div>

                        </div>

                    </div>
                    <div class="card-body">
                        <div class="border rounded p-3 ">
                            <div class="row gap-4 gap-sm-0">
                                <div class="col-12 col-sm-4">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="badge rounded bg-label-primary mb-1 p-1">
                                            <i class="ti ti-files ti-sm"></i>
                                        </div>
                                        <h6 class="mb-0">No surat</h6>

                                    </div>
                                    <div class="col-md-12">
                                        <select id="nosurat" class="select form-select" name="nosurat"
                                            onchange="nosurat()">
                                            <option value="">Select</option>
                                            <option value="DPM">DPM</option>
                                            <option value="DRP">DRP</option>
                                            <option value="CWC">CWC</option>
                                            <option value="WTP">WTP</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="col-12 col-sm-4" id="select2">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="badge rounded bg-label-success mb-1 p-1">
                                            <i class="ti ti-settings ti-sm"></i>
                                        </div>
                                        <h6 class="mb-0">Peralatan/machine</h6>
                                    </div>
                                    <div class="col-md-12">
                                        <select id="selectmachine" class="select2 form-select" name="mesinid">
                                            <option value="">Select</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="col-md-12" id="btnsave">
                                            <button type="button" class="btn btn-success btn-save" onclick="save()"><i
                                                    class="fa fa-search"></i>
                                                Search</button>

                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
        <br>
        <form id="form-data">
            @csrf
            <hr class="m-0 p-0" style="padding: 0px; margin:0px;">
            <div class="col-md-12">
                <div class="card p-4">
                    <div class="table-responsive text-nowrap">

                        <table class="table table-responsive table-bordered table-hover">
                            <thead>
                                <tr style="text-align: center; line-height: 1px; ">
                                    <th>#</th>
                                    <th>Nosurat</th>
                                    <th>Departmen</th>
                                    <th>Mesin / Peralatan</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Bulan</th>
                                    <th>Status</th>
                                    <th>Status TPM</th>
                                    <th>Bagian yang diperiksa</th>
                                    <th>Jenis kerusakan</th>
                                    <th>Tindakan yang dilakukan</th>
                                    <th>Jam</th>
                                    <th>Total jam</th>
                                    <th>Tanggal</th>
                                    <th>Peralatan / Sparepart</th>
                                    <th>Qty</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody id="">
                                @foreach ($all['inputwal'] as $awal)
                                    @foreach ($all['master'] as $master)
                                        @if ($awal->mesin_id == $master->machine_id)
                                            @php
                                                $namaperalatan = $master->machine_name;
                                            @endphp

                                            <tr>
                                                <td>
                                                    <a class="btn btn-primary btn-xs btn-print" href=""><i
                                                            class="fa fa-print"></i></a>
                                                    <a class="btn btn-secondary btn-xs btn-print"><i
                                                            class="fa fa-eye"></i></a>
                                                    <a class="btn btn-danger btn-xs btn-detail toggle-details"><i
                                                            class="fa fa-plus"></i></a>
                                                </td>
                                                <td style="text-align: center;">{{ $awal->nosurat }}</td>
                                                <td style="text-align: center;">{{ $awal->dept }}</td>
                                                <td style="text-align: center;">{{ $namaperalatan }}</td>

                                            </tr>
                                        @endif
                                    @endforeach

                                    @foreach ($awal->Formsystahunandtl as $x)
                                        @foreach ($all['master'] as $msn)
                                            @foreach ($msn->fm015category as $category)
                                                @foreach ($category->Form015asubcategory as $subcategory)
                                                    @if ($awal->id == $x->hdr_id)
                                                        @php
                                                            $status = $x->status == 't' ? 'Ok' : 'No Ok';
                                                            $statusColor = $x->status == 'f' ? '' : 'color: red;';
                                                        @endphp
                                                        @php
                                                            $statustpm = $x->statustpm !== null ? $x->statustpm : '-';
                                                            $statustpmColor = $x->statustpm !== null ? 'color: red;' : '';
                                                        @endphp


                                                        @if ($x->subcategory_id == $subcategory->subcategory_id)
                                                            @php
                                                                $subcategoryname = $subcategory->subcategory_name;
                                                            @endphp


                                                            <tr class="detail-row">
                                                                <td colspan="4"></td>
                                                                <td style="text-align: center;">
                                                                    {{ $category->category_name }}
                                                                </td>
                                                                <td style="text-align: center;">{{ $subcategoryname }}
                                                                </td>
                                                                <td style="text-align: center;">
                                                                    @php
                                                                        $bulan = $x->bulan;
                                                                        $namaBulan = '';
                                                                        switch ($bulan) {
                                                                            case 1:
                                                                                $namaBulan = 'Januari';
                                                                                break;
                                                                            case 2:
                                                                                $namaBulan = 'February';
                                                                                break;
                                                                            case 3:
                                                                                $namaBulan = 'March';
                                                                                break;
                                                                            case 4:
                                                                                $namaBulan = 'April';
                                                                                break;
                                                                            case 5:
                                                                                $namaBulan = 'May';
                                                                                break;
                                                                            case 6:
                                                                                $namaBulan = 'June';
                                                                                break;
                                                                            case 7:
                                                                                $namaBulan = 'July';
                                                                                break;
                                                                            case 8:
                                                                                $namaBulan = 'August';
                                                                                break;
                                                                            case 9:
                                                                                $namaBulan = 'September';
                                                                                break;
                                                                            case 10:
                                                                                $namaBulan = 'October';
                                                                                break;
                                                                            case 11:
                                                                                $namaBulan = 'November';
                                                                                break;
                                                                        
                                                                            case 12:
                                                                                $namaBulan = 'December';
                                                                                break;
                                                                        
                                                                            // tambahkan kasus bulan lain di sini
                                                                            default:
                                                                                $namaBulan = 'Bulan Tidak Valid';
                                                                                break;
                                                                        }
                                                                    @endphp
                                                                    {{ $namaBulan }}
                                                                </td>
                                                                <td style="text-align: center; {{ $statusColor }}">
                                                                    {{ $status }}
                                                                </td>
                                                                <td style="text-align: center; {{ $statustpmColor }}">
                                                                    {{ $statustpm }}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @endforeach


                                        @foreach ($all['dtl_perbaikan'] as $perbaikan)
                                            @foreach ($perbaikan->perbaikanDetail as $detail)
                                                @if ($detail->dtlsys == $x->id)
                                                    <tr>
                                                        <td colspan="8"></td>
                                                        <td>
                                                            <a class="btn btn-primary btn-xs btn-print" href=""><i
                                                                    class="fa fa-print"></i></a>
                                                            <a class="btn btn-success btn-xs btn-print" href=""><i
                                                                    class="fa fa-eye"></i></a>
                                                        </td>

                                                        <td style="text-align: center;">{{ $detail->perawatan }}</td>
                                                        <td style="text-align: center;">{{ $detail->kerusakan }}</td>
                                                        <td style="text-align: center;">{{ $detail->tindakan }}</td>
                                                        <td style="text-align: center;">
                                                            {{ $detail->mulai . ' - ' . $detail->selesai }}</td>
                                                        <td style="text-align: center;">{{ $detail->totaljam }}</td>
                                                        <td style="text-align: center;">{{ $detail->tanggal_sys }}</td>

                                                    </tr>


                                                    @foreach ($all['dtl_verifikasi'] as $verifikasi)
                                                        @foreach ($verifikasi->verifikasiDetail as $z)
                                                            @if ($verifikasi->idbilingual == $detail->id)
                                                                <tr>
                                                                    <td colspan="14"></td>
                                                                    <td>
                                                                        <a class="btn btn-primary btn-xs btn-print"
                                                                            href=""><i class="fa fa-print"></i></a>
                                                                        <a class="btn btn-info btn-xs btn-print"
                                                                            href=""><i class="fa fa-eye"></i></a>
                                                                    </td>

                                                                    <td style="text-align: center;">
                                                                        {{ $z->namaperalatan }}
                                                                    <td style="text-align: center;">{{ $z->qty }}
                                                                    </td>
                                                                    <td style="text-align: center;">
                                                                        {{ $z->keterangan }}


                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                @endforeach

                        </table>



                    </div>
                </div>
            </div>


        </form>
    </div>

    <!-- Your HTML code here -->

    <script></script>

@endsection
