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

        .checkbox-cell.selected {
            background-color: black;
        }
    </style>


    <div class="container-fluid flex-grow-1 container-p-y">
        <div style="display: flex; justify-content: space-between; align-items: center;" class="mb-3">
            <!-- DataTable with Buttons -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card p-4">
                    <div class="container-fluid flex-grow-1 container-p-y">
                        <form id="form-data">
                            @csrf
                            <div class="row m-1 mt-4">
                                <div class="col-md-6">
                                    @if ($header[0]['status_komplit'] == '1' && $header[0]['app1_sts'] == null)
                                        <button type="button" id='btn-tes'
                                            class="btn btn-primary me-sm-3 me-1 btn-approve"
                                            onclick="approve()">Approve</button>
                                        <button type="button" id='btn-tes' class="btn btn-danger me-sm-3 me-1 btn-reject"
                                            onclick="reject()">Reject</button>
                                    @else
                                    <a href="{{ route('frm.printData', $header[0]['headerid']) }}"
                                                class="btn btn-primary">
                                                <i class="fa fa-print"></i>&nbsp;Print
                                            </a>
                                    @endif
                                </div>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:120px;" rowspan="3"
                                            style="vertical-align: middle; text-align: center"><img
                                                src="{{ asset('public/img/logo-01042022.png') }}" style="width: 100px;">
                                        </th>
                                        <th style="vertical-align: middle; text-align: center;">PT RIAU SAKTI UNITED
                                            PLANTATION</th>
                                        <th rowspan="3" style="vertical-align: middle; width: 200px;">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>No : </label>
                                                        {{ $header[0]['nomor'] }}
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th scope="col" style="vertical-align:middle; text-align: center;">
                                            <p class="fonthead"></p>{{ $forminput[0]['form_judul'] }}
                                            <br>{{ $forminput[0]['form_bilingual'] }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="3" style="vertical-align: middle; text-align: left">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <label for="exampleFormControlInput1"
                                                            class="col-sm-4 col-form-label text-sm-end">Nama Peralatan/Mesin
                                                            :</label>
                                                        <div class="col-sm-6">
                                                            <label for="exampleFormControlInput1"
                                                                class="col-sm-4 col-form-label text-sm-end">
                                                                @foreach ($peralatan as $item)
                                                                    @if ($header[0]['jenis_mesin'] == $item['machine_id'])
                                                                        {{ $item['machine_name'] }}
                                                                    @endif
                                                                @endforeach
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <label for="exampleFormControlInput1"
                                                            class="col-sm-4 col-form-label text-sm-end">Kode (Code)
                                                            :</label>
                                                        <div class="col-sm-4">
                                                            <label for="exampleFormControlInput1"
                                                                class="col-sm-4 col-form-label text-sm-end">{{ $header[0]['kode'] }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <label for="exampleFormControlInput1"
                                                            class="col-sm-4 col-form-label text-sm-end">(Name of Equipment/
                                                            Machine) </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br><br>
                            {{-- <div class="card-datatable table-responsive pt-3" style="height: 700px;"> --}}
                            <table class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th rowspan="2"
                                            style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px; background-color: white; z-index: 50">
                                            NO</th>
                                        <th rowspan="2"
                                            style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px; background-color: white; z-index: 50">
                                            NAMA PERALATAN</th>
                                        <th rowspan="2"
                                            style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px; background-color: white; z-index: 50">
                                            FREKUENSI<br>(Frequency)</th>
                                        <th rowspan="2"
                                            style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px; background-color: white; z-index: 50">
                                            P/ R/ S</th>
                                        <th colspan="5"
                                            style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px; background-color: white; z-index: 50">
                                            MINGGU KE-</th>
                                    </tr>
                                    <th style="text-align: center;">I</th>
                                    <th style="text-align: center;">II</th>
                                    <th style="text-align: center;">III</th>
                                    <th style="text-align: center;">IV</th>
                                    <th style="text-align: center;">V</th>
                                    </tr>
                                </thead>
                                <tbody id="data-table-body">
                                    @php
                                        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                        $i = 1;
                                    @endphp
                                    @foreach ($detail as $data)
                                        <tr style="cursor: pointer;">
                                            <td>{{ $alphabet[$i - 1] }}</td>
                                            <td> {{ $data->category_name }}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        @foreach ($data['form015asubcategory'] as $key => $data2)
                                            <tr>
                                                <td rowspan='5' style="text-align: center">{{ $key + 1 }}</td>
                                                <td rowspan='5'>{{ $data2->subcategory_name }}</td>
                                                <td rowspan='5'></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center">Plan</td>
                                                @foreach ($data2['FormSys014aDtl'] as $key => $data3)
                                                    <td style="text-align: center"
                                                        class="checkbox-cell{{ $data3->plan == 1 ? ' selected' : '' }}">
                                                    </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td style="text-align: center">Realisasi</td>
                                                @foreach ($data2['FormSys014aDtl'] as $key => $data3)
                                                    <td style="text-align: center">{{ $data3->realisasi }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td style="text-align: center">Status</td>
                                                @foreach ($data2['FormSys014aDtl'] as $key => $data3)
                                                    <td style="text-align: center">
                                                        {{ $data3->status }}<br>
                                                        {!! $data3->s_condition == 't'
                                                            ? '<span style="color: black;">Ok</span>'
                                                            : ($data3->s_condition == 'f'
                                                                ? '<span style="color: red;">No Ok</span>'
                                                                : '') !!}
                                                    </td>
                                                @endforeach
                                            </tr>

                                            <tr>
                                                <td style="text-align: center">Nama & Paraf</td>
                                                @foreach ($data2['FormSys014aDtl'] as $key => $data3)
                                                    <td style="text-align: center">{{ $data3->remaks }}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        @php$i++;
                                                                                @endphp ?>
                                    @endforeach
                                </tbody>
                            </table>
                            <table class="table table-bordered table-hover table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <th height="300" style="vertical-align: middle; text-align: center; width: 33.3%">
                                            <div class="row">
                                                <div class="col-md-6"
                                                    style="vertical-align: middle; text-align: left; text-transform: capitalize;">
                                                    <label> Keterangan :</label><br>
                                                    <label>P = Plan/ Rencana diisi tinta hitam/bold warna hitam tiap awal
                                                        tahun</label>
                                                    <label><span
                                                            style="font-style: italic;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(plan
                                                            is filled by black ink /black bold every beginning of the
                                                            year)</span></label>
                                                    <label>R = Realization/ Realisasi diisi dengan tanggal setiap selesai
                                                        pelaksanaan</label>
                                                    <label><span
                                                            style="font-style: italic;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(realization
                                                            is filled by date after the implementation)</span></label><br>
                                                    <label>S = Status ok = √ , no ok = x</label>
                                                    <label><span
                                                            style="font-style: italic;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(status
                                                            ok/no ok merujuk ke prosedur/panduan kerja masing-masing
                                                            dept/bagian)</span></label>
                                                </div>



                                                <div class="col-md-6">
                                                    <table class="table table-bordered table-hover table-striped"
                                                        style="vertical-align: middle; text-align: left; text-transform: capitalize;">
                                                        <thead>
                                                            <tr>
                                                                <th style="vertical-align: middle; text-align: center;">
                                                                    DIBUAT OLEH</th>
                                                                <th style="vertical-align: middle; text-align: center;">
                                                                    DISETUJUI OLEH</th>
                                                            </tr>
                                                            <tr>
                                                                <th height="100"
                                                                    style="vertical-align: middle; text-align: center">
                                                                </th>
                                                                <th height="100"
                                                                    style="vertical-align: middle; text-align: center">
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td style="vertical-align: middle; text-align: left;">Nama
                                                                    (Name) &nbsp;&nbsp;&nbsp;:  {{ $header[0]['app1_by'] }}</td>
                                                                <td style="vertical-align: middle; text-align: left;">Nama
                                                                    &nbsp;&nbsp;&nbsp;: {{ $header[0]['app2_by'] }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="vertical-align: middle; text-align: left;">
                                                                    Jabatan (position) : {{ $header[0]['app1_jabatan'] }}</td>
                                                                <td style="vertical-align: middle; text-align: left;">
                                                                    Jabatan : {{ $header[0]['app2_jabatan'] }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="vertical-align: middle; text-align: left;">
                                                                    Tanggal (date) :</td>
                                                                <td style="vertical-align: middle; text-align: left;">
                                                                    Tanggal :</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function approve() {
            var formData = $('#form-data').serialize();
            swAlertConfirm('{{ route('frm.store') }}', undefined, undefined, formData);
        }
        function printData() {
        const printButton = document.getElementById('printButton');
        const url = printButton.href;
        // Buka jendela baru dan muat URL
        window.open(url, '_blank');
    }
     // Tambahkan event listener ke tombol
     document.getElementById('printButton').addEventListener('click', function(e){
        e.preventDefault();
        // Panggil fungsi print
        printData();
    });
    </script>
@endsection
