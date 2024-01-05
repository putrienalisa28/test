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

        .bg-tidak-capai {
            background-color: #E56E96 !important;
            color: white;
        }

        .bg-rencana-awal {
            background-color: black !important;
            color: rgb(8, 8, 8);
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
                                <div class="col-12" id="tambah">
                                    <button type="button" id='btn-tes' class="btn btn-primary me-sm-3 me-1 btn-save"
                                    onclick="save()">Update</button>
                                    <button type="button"  class="btn btn-success me-sm-3 me-1 btn-komplit"
                                    onclick="komplit()">Completed</button>
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
                                                        {{ $header['no_ref'] }} 
                                                        <input id="no_ref" class="form-control" type="hidden" name="no_ref" value=" {{ $header['nomor'] }}">
                                                        <input id="hdridcek" class="form-control" type="hidden" name="hdridcek" value=" {{ $header['id'] }}">
                                                        <input id="headerid" class="form-control" type="hidden" value="{{ $header['headerid'] }}" name="headerid">
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th scope="col" style="vertical-align:middle; text-align: center;">
                                            <p class="fonthead"></p>DAFTAR CEK PERAWATAN DAN CATATAN PERBAIKAN/ PENGGANTIAN
                                            BULANAN
                                            <br>(MAINTENANCE CHECKLIST AND MONTHLY REPAIR/REPLACEMENT RECORDS)
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <br><br>
                            {{-- <div class="card-datatable table-responsive pt-3" style="height: 700px;"> --}}
                            <table class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th rowspan="2"
                                        style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                        No</th>
                                        <th rowspan="2"
                                            style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                            NAMA PERALATAN<br>(Equipment Nmae)</th>
                                        <th rowspan="2"
                                            style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                            KODE<br>(Code)</th>
                                        <th rowspan="2"
                                            style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                            JENIS KERUSAKAN</th>
                                        <th rowspan="2"
                                            style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                            TINDAKAN YANG DILAKUKAN<br>(Action Conducted)</th>
                                        <th rowspan="2"
                                            style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                            TGL<br>(Date)</th>
                                        <th colspan="2"
                                            style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                            Jam<br>(Hour)</th>
                                        <th rowspan="2"
                                            style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                            TOTAL JAM</th>
                                        <th rowspan="2"
                                            style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                            KETERANGAN<br>(Remarks)</th>
                                        <th rowspan="2"
                                            style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                            NAMA<br>(Name)</th>
                                        <th rowspan="2"
                                            style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                            Paraf<br>(Initials)</th>
                                    </tr>
                                    <th style="text-align: center;"> MULAI</th>
                                    <th style="text-align: center;">SELESAI</th>
                                    <tr>
                                </thead>
                                <tbody id="tbody-list-detail">
                                    @foreach ($detail as $key => $data)
                                    <tr style="cursor: pointer;" row="{{ $key+1 }}">
                                        <td style="text-align: center;">{{ $key + 1 }}</td>
                                        <td>{{ $data->nama_peralatan }}
                                            <input id="nama_peralatan" class="form-control" type="hidden" name="nama_peralatan[]" value="{{ $data->nama_peralatan }}">
                                        </td>
                                        <td style="text-align: center;">{{ $data->kode }}
                                            <input id="kode" class="form-control" type="hidden" name="kode[]" value="{{ $data->kode }}">
                                        </td>
                                        <td>
                                            <textarea id="kerusakan" class="form-control" name="kerusakan[]">{{ $data->kerusakan }}</textarea>
                                        </td>
                                        <td><textarea id="tindakan" class="form-control" name="tindakan[]">{{ $data->tindakan }}</textarea></td>
                                        <td>{{ $data->tanggal }}
                                            <input id="tanggal" class="form-control" type="hidden" name="tanggal[]" value="{{ $data->tanggal }}">
                                        </td>
                                        <td><input id="mulai_{{ $key + 1 }}" class="form-control" type="time" name="mulai[]" value="{{ $data->mulai }}" onkeyup="getDurasi(this);" onclick="getDurasi(this);"></td>
                                        <td><input id="selesai_{{ $key + 1 }}" class="form-control" type="time" name="selesai[]" value="{{ $data->selesai }}" onkeyup="getDurasi(this);" onfocusout="getDurasi(this);"></td>
                                        <td><input id="durasi_{{ $key + 1 }}" class="form-control" type="text" name="jam[]" value="{{ $data->jam }}" readonly></td>
                                        <td><textarea id="keterangan" class="form-control" name="keterangan[]">{{ $data->keterangan }}</textarea></td>
                                        <td>
                                            <select id="nama_{{ $key + 1 }}" class="form-select" name="nama[]" onchange="getParaf(this);">
                                                <option value=""></option>
                                                @foreach ($jabatan3 as $nama3)
                                                    <option data-regno="{{ $nama3->RegNo }}" value="{{ $nama3->NAMA }}" {{ $nama3->NAMA == $data->nama ? 'selected' : '' }}>{{ $nama3->NAMA }}</option>
                                                @endforeach
                                            </select>
                                            
                                        </td>     
                                        <td><input id="paraf_{{ $key + 1 }}" class="form-control" type="hidden" name="paraf[]"> {!! getTTD($data->paraf_by) !!};   
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <table class="table table-bordered table-hover table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <th height="300" style="vertical-align: middle; text-align: center; width: 33.3%">
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
                                                            (Name) &nbsp;&nbsp;&nbsp;:  
                                                            <select id="app1_by" class="select2 form-select" name="app1_by" onchange="getjabatan()">
                                                                <option value=""></option>
                                                                @foreach ($jabatan as $nama)
                                                                    <option data-jabatan="{{ $nama->JabatanName }}" data-regno="{{ $nama->RegNo }}" data-idjabatan="{{ $nama->JabatanID }}"
                                                                        value="{{ $nama->NAMA }}" {{ $nama->NAMA == $header['app1_by'] ? 'selected' : '' }}>{{ $nama->NAMA }}</option>
                                                                @endforeach
                                                            </select>                                                            
                                                        </td>
                                                        <td style="vertical-align: middle; text-align: left;">Nama
                                                            &nbsp;&nbsp;&nbsp;: 
                                                            <select id="app2_by" class="select2 form-select"
                                                            name="app2_by" onchange="getjabatan2()">
                                                            <option value=""></option>
                                                            @foreach ($jabatan2 as $nama2)
                                                                    <option data-jabatan2="{{ $nama2->JabatanName }}" data-regno2="{{ $nama2->RegNo }}" data-idjabatan2="{{ $nama2->JabatanID }}"
                                                                        value="{{ $nama2->NAMA }}" {{ $nama2->NAMA == $header['app2_by'] ? 'selected' : '' }}>{{ $nama2->NAMA }}</option>
                                                                @endforeach
                                                        </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle; text-align: left;">
                                                            Jabatan (position):
                                                            <input type="text" id="app1_jabatan" class="form-control" name="app1_jabatan" value="{{$header['app1_jabatan']}}" readonly>
                                                            <input type="hidden" id="regno" class="form-control" name="regno" value="{{$header['app1_regno']}}">
                                                            <input type="hidden" id="idjabatan" class="form-control" name="idjabatan">
                                                        </td>
                                                        <td style="vertical-align: middle; text-align: left;">
                                                            Jabatan (position):
                                                            <input type="text" id="app2_jabatan" class="form-control" name="app2_jabatan" value="{{$header['app2_jabatan']}}" readonly>
                                                            <input type="hidden" id="regno2" class="form-control" name="regno2" value="{{$header['app2_regno']}}">
                                                            <input type="hidden" id="idjabatan2" class="form-control" name="idjabatan2">
                                                        </td>                                                                
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle; text-align: left;">
                                                            Tanggal (date) :</td>
                                                        <td style="vertical-align: middle; text-align: left;">
                                                            Tanggal :</td>
                                                        </tr>
                                                    </tbody>
                                            </table>
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
        function komplit() {
            var formData = $('#form-data').serialize();
            swAlertConfirm('{{ route('frm.komplit_cek') }}', undefined, undefined, formData);
        }
        function save() {
            var formData = $('#form-data').serialize();
            console.log(formData)
            Swal.fire({
                title: 'Are you sure?',
                text: "It will be saved!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, save it!',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return new Promise((resolve) => {
                        $.ajax({
                            url: '{{ route('frm.store_cek') }}',
                            type: "POST",
                            data: formData,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            dataType: "JSON",
                            success: function(response) {
                                console.log(response);

                            },
                            error: function(xhr, text) {
                                console.log(xhr);
                                Swal.fire('Error : ' + String(xhr.responseJSON
                                        .code),
                                    String(xhr
                                        .responseJSON
                                        .message), 'error');
                                // $(".btn-save").attr('disabled', false);
                                // $(".btn-save").html('Save');
                            }
                        });
                    });
                },
            }).then((result) => {
                if (!result.isConfirmed) {
                    $(".btn-save").attr('disabled', false);
                    $(".btn-save").html('Save');
                }
            });
        }
        
        function getDurasi(id) {
            var row = id.closest("tr").getAttribute("row");
            date = new Date();

            var mulai = $(`#mulai_${row}`).val().split(":");
            var selesai = $(`#selesai_${row}`).val().split(":");
            var menitmulai = mulai[0] * 60;
            var menitselesai = selesai[0] * 60;

            var durasi = (parseInt(menitselesai) + parseInt(selesai[1])) - (parseInt(menitmulai) + parseInt(mulai[1]));
            var durasijam = Math.floor(durasi / 60);
            var durasimenit = parseInt(durasi) - (parseInt(durasijam) * 60);
            if(!isNaN(durasi)){
                $(`#durasi_${row}`).val(durasijam + ' Jam ' + durasimenit + ' Menit');
            }else{
                $(`#durasi_${row}`).val('');
            }
        }
       
        function getParaf(id){
            var row = id.closest("tr").getAttribute("row");
            var regno = $(`#nama_${row}`).find(':selected').data('regno');
            $(`#paraf_${row}`).val(regno);
	    }

        function getjabatan(){
            var jabatan = $('#app1_by').find(':selected').data('jabatan');
            var regno = $('#app1_by').find(':selected').data('regno');
            var idjabatan = $('#app1_by').find(':selected').data('idjabatan');
             $("#app1_jabatan").val(jabatan);
             $("#regno").val(regno);
             $("#idjabatan").val(idjabatan);
        }

        function getjabatan2(){
            var jabatan = $('#app2_by').find(':selected').data('jabatan2');
            var regno2 = $('#app2_by').find(':selected').data('regno2');
            var idjabatan2 = $('#app2_by').find(':selected').data('idjabatan2');
             $("#app2_jabatan").val(jabatan);
             $("#regno2").val(regno2);
             $("#idjabatan2").val(idjabatan2);
        }
    </script>
@endsection
