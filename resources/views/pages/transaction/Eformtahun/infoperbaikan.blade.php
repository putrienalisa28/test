@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 col-xl-12 col-md-12">
                <div class="card h-100">
                    <div class="card-header ">
                        <div class="card-title mb-md-0">
                            <div class="alert alert-primary" role="alert">This is a success alert — check it out!
                            </div>

                        </div>

                    </div>
                    <div class="card-body">
                        <div class="border rounded p-3 ">
                            <div class="row gap-4 gap-sm-0">
                                <div class="col-12 col-sm-4">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="badge rounded bg-label-info mb-1 p-1">
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
                                            <button type="button" class="btn btn-primary btn-save" onclick="save()"><i
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
                                    {{-- <th>No</th> --}}
                                    <th>Nosurat</th>
                                    <th>Departmen</th>
                                    <th>Mesin / Peralatan</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Bulan</th>
                                    <th>Created By</th>
                                </tr>
                            </thead>
                            <tbody id="">
                                @foreach ($perbaikan['hdr'] as $hdr)
                                    <tr style="line-height: -10px;">
                                        <td>
                                            <a class="btn btn-primary btn-xs btn-edit"
                                                href="{{ route('perbaikan.index', $hdr->id) }}"><i
                                                    class="fa fa-edit"></i></a>
                                        </td>
                                        <td hidden style="text-align: center;">{{ $hdr->id }}</td>
                                        <td style="text-align: center;">{{ $hdr->nosurat }}</td>
                                        <td colspan="5"text-align: center;>{{ $hdr->dept }}</td>
                                        <td style="text-align: center;">{{ $hdr->created_by }}</td>
                                        @php
                                            $foundDtl = false;
                                        @endphp
                                    </tr>
                                    @foreach ($perbaikan['dtl-perbaikan'] as $dtl)
                                        @if ($hdr->id == $dtl->hdr_id)
                                            <tr style="line-height: -10px;">
                                                <td colspan="3"></td>
                                                <td style="text-align: center;">{{ $dtl->machine_name }}</td>
                                                <td style="text-align: center;">{{ $dtl->category_name }}</td>
                                                <td text-align: center;>{{ $dtl->subcategory_name }}</td>
                                                <td colspan="2" text-align: center;>
                                                    @php
                                                        $bulan = $dtl->bulan;
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
                                            </tr>
                                            @php
                                                $foundDtl = true;
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if (!$foundDtl)
                                        <tr>
                                            <td colspan="4"></td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>


        </form>
    </div>

    <!-- Your HTML code here -->

@endsection
