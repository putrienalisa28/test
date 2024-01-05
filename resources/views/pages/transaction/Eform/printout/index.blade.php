@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')

    <div class="container-fluid flex-grow-1 container-p-y">
        <form id="form-data">
            @csrf


            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <input hidden class="form-control col-md-2" type="text" name="jenisform" value="1" readonly />
                        <input hidden class="form-control col-md-2" type="text" name="id" value="" readonly />

                        <div class="accordion-body m-3">
                            <div class="table-responsive text-nowrap pt-3">
                                <table class="table table-responsive table-bordered table-striped table-hover">
                                    <tr style="text-align:center;">
                                        <th style="width: 50px;" rowspan="3"><img
                                                src="{{ asset('public/img/logo-01042022.png') }}">
                                        </th>
                                        <th style="width: 50px;">PT RIAU SAKTI UNITED PLANTATIONS</th>
                                        <th style="width: 100px;" rowspan="">
                                            <input type="text" name="nosurat" value="" id="nosurat"
                                                class="form-control form-control-plaintext form-control-sm"
                                                style="text-align:center; display: block; font-weight: bold;" readonly>
                                        </th>
                                    </tr>
                                    <tr style="text-align:center;">
                                        <th style="width: 50px;">

                                            <span style="display: block;">DAFTAR CEK PERAWATAN DAN CATATAN PERBAIKAN/
                                                PENGGANTIAN</span>
                                            <span><em>(MAINTENANCE CHECKLIST AND REPAIR/REPLACEMENT
                                                    RECORD)</em></span>
                                        </th>
                                        <th style="width: 100px;" rowspan="">
                                            <span style="display: block;">HAL : 1 DARI 2</span>
                                            <span><em>(Pages) 1 of 2</em></span>
                                        </th>
                                    </tr>
                                </table>

                                <table class="table table-responsive table-bordered table-striped table-hover">
                                    <tr>
                                        <th style="width: 50px;"> <span style="display: block;">Nama Peralatan/Mesin
                                            </span>
                                            <span><em>(Name of Equipment/ Machine)</em></span>
                                            <input type="text" name="peralatan" id="peralatan"value="" readonly>
                                        </th>
                                        <th style="width: 50px;"> <span style="display: block;">Kode (Code) :
                                                <input type="text" name="kode" value="" id="code"
                                                    class="form-control  form-control-sm" required>
                                        </th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="accordion-body m-3">
                            <div class="table-responsive text-nowrap pt-3">
                                <table id="tableContainer"
                                    class="table table-responsive table-bordered table-striped table-hover">
                                    <thead style="text-align:center;">
                                        <tr>
                                            <th rowspan="2" style="width: 50px;">No</th>
                                            <th rowspan="2" style="width: 100px;"> <span style="display: block;">Bagian
                                                    yang
                                                    diperiksa </span>
                                                <span><em>(Part to Check)</em></span>
                                            </th>
                                            <th class="tanggal">Tanggal (Date)</th>
                                            <th> <span style="display: block;">KETERANGAN</span>
                                                <span><em>(Remarks)</em></span>
                                            </th>
                                        </tr>
                                        <tr id="tanggalkalender">

                                        </tr>
                                    </thead>
                                    <tbody id="tableBody">
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row" id="footer">
                <div class="col-12">
                    <div class="card">
                        <div class="accordion-body m-3">
                            <div class="table-responsive text-nowrap pt-3">
                                <table class="table table-bordered table-hover table-striped table-responsive">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align: middle; text-align: center; width: 33.3%"><span
                                                    style="display: block;">Keterangan :</span>
                                                <span><em>(Remarks)</em></span>
                                            </th>
                                            <th style="vertical-align: middle; text-align: center; width: 33.3%"><span
                                                    style="display: block;">Diketahui Oleh</span>
                                                <span><em>(Acknowledged by)</em></span>
                                            </th>

                                        </tr>
                                        <tr>
                                            <th height="100" style="vertical-align: middle; text-align: left"
                                                rowspan="2">
                                                <img src="{{ asset('img/rmk.png') }}">
                                            </th>
                                            <th height="100" style="vertical-align: middle; text-align: center">
                                            </th>

                                        </tr>

                                    </thead>
                                    <tbody>


                                        <tr>
                                            <td><span style="display: block;">
                                            </td>
                                            <th colspan="2"><span style="display: block;">Nama</span>
                                                <span><em>(Name)</em></span>
                                            </th>

                                        </tr>
                                        <tr>
                                            <td><span style="display: block;">
                                            </td>
                                            <th><span style="display: block;">Jabatan</span>
                                                <span><em>(Position)</em>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td><span style="display: block;"></span></td>
                                            <th>
                                                <div class="d-flex align-items-center">
                                                    <label for="getbulan"
                                                        style="font-style: italic; display: block; margin-right: 10px;">Tanggal</label>
                                                    <input class="form-control" type="date" name="acknowledged"
                                                        value="2023-06-01" id="getbulan" />


                                                </div>
                                                <span><em>(Date)</em></span>
                                            </th>
                                        </tr>

                                    </tbody>
                                </table>
                                <table class="table table-bordered" style="margin-bottom: 0px;">
                                    <tfoot>
                                        <tr>

                                            <td>
                                                <span style="font-style: italic;"><span style="display: block;">Tanggal
                                                        Efektif : 01 April 2022</span>
                                                    <span><em>(Effective Date: 01 April 2022)</em></span>
                                                    <span style="font-style: italic" class="pull-right"></span>
                                            </td>

                                            <td>
                                                <span style="font-style: italic;" class="pull-right">FRM-SYS-015a-02
                                                </span>

                                            </td>

                                        </tr>
                                    </tfoot>
                                </table>
                                <br>

                            </div>
                        </div>
                    </div>
                </div>



        </form>
    </div>

    <!-- Your HTML code here -->




@endsection
