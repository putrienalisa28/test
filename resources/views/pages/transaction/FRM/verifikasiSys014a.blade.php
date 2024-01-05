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
                                                        @if ($header[0]['department'] == 'WTP')
                                                            {{ trim($header[0]['department']) }}/WPM
                                                        @else
                                                            {{ $header[0]['department'] }}
                                                        @endif
                                                        <input id="department" class="form-control" type="hidden"
                                                            value="{{ $header[0]['department'] }}" name="department">
                                                        <input id="checkid" class="form-control" type="hidden"
                                                            value="{{ $cek[0]['id'] }}" name="checkid">
                                                        <input id="headerid" class="form-control" type="hidden"
                                                            value="{{ $header[0]['headerid'] }}" name="headerid">
                                                        <input id="id" class="form-control" type="hidden" name="id">
                                                    </div>
                                                </div><br><br>
                                                <div class="form-group">
                                                    <label>Tanggal :</label>{{ $cek[0]['tanggal'] }}
                                                    <input id="tanggal" class="form-control" type="hidden"
                                                        value="{{ $cek[0]['tanggal'] }}" name="tanggal" readonly>
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
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="exampleFormControlInput1"
                                                                class="col-sm-4 col-form-label text-sm-end">Nama Mesin
                                                                :&nbsp;&nbsp;&nbsp;</label>
                                                            {{ $cek[0]['nama_peralatan'] }}
                                                            <input id="nama_peralatan" class="form-control" type="hidden"
                                                                value="{{ $cek[0]['nama_peralatan'] }}"
                                                                name="nama_peralatan">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="row">
                                                        <label for="exampleFormControlInput1"
                                                            class="col-sm-3 col-form-label text-sm-end">Area :</label>
                                                        <div class="col-sm-9"> {{ $header[0]['department'] }}
                                                            <input type="hidden" x-model="area" name="area"
                                                                id="area" value="{{ $header[0]['department'] }}" placeholder="Enter Code"
                                                                class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="exampleFormControlInput1"
                                                                    class="col-sm-4 col-form-label text-sm-end">Jam
                                                                    :&nbsp;&nbsp;&nbsp;</label>
                                                                {{ $cek[0]['mulai'] }} - {{ $cek[0]['selesai'] }}
                                                                <input id="jam" class="form-control" type="hidden"
                                                                    value="{{ $cek[0]['mulai'] }} - {{ $cek[0]['selesai'] }}"
                                                                    name="antara_jam">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="exampleFormControlInput1"
                                                                    class="col-sm-4 col-form-label text-sm-end">Kode
                                                                    :&nbsp;&nbsp;&nbsp;</label>
                                                                {{ $header[0]['kode'] }}
                                                                <input id="kode" class="form-control" type="hidden"
                                                                    value="{{ $cek[0]['kode'] }}" name="kode">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="row">
                                                        <label for="exampleFormControlInput1"
                                                            class="col-sm-3 col-form-label text-sm-end">Shift :</label>
                                                        <div class="col-sm-9">
                                                            <input type="input" x-model="shift" name="shift"
                                                                id="shift" placeholder="Enter Code"
                                                                class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="exampleFormControlInput1"
                                                                    class="col-sm-4 col-form-label text-sm-end">Total Jam
                                                                    :&nbsp;&nbsp;&nbsp;</label>
                                                                {{ $cek[0]['jam'] }}
                                                                <input id="total_jam" class="form-control" type="hidden"
                                                                    value="{{ $cek[0]['jam'] }}" name="total_jam">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="vertical-align: middle; text-align: left">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label for="exampleFormControlInput1"
                                                        class="col-sm-4 col-form-label text-sm-end">Jenis Kerusakan :
                                                        &nbsp;&nbsp;&nbsp;{{ $cek[0]['kerusakan'] }}</label>
                                                    <input id="kerusakan" class="form-control" type="hidden"
                                                        value="{{ $cek[0]['kerusakan'] }}" name="kerusakan">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="vertical-align: middle; text-align: left">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label for="exampleFormControlInput1"
                                                        class="col-sm-7 col-form-label text-sm-end">Tindakan :
                                                        &nbsp;&nbsp;&nbsp;{{ $cek[0]['tindakan'] }}</label>
                                                    <input id="tindakan" class="form-control" type="hidden"
                                                        value="{{ $cek[0]['tindakan'] }}" name="tindakan">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br><br>
                            <table class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th rowspan="2"
                                            style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                            <button type="button" class="btn btn-primary btn-xs"
                                                    onclick="tambah_baris();">
                                                    <i class="ti ti-plus"></i>
                                                </button></th>
                                        <th colspan="2"
                                            style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                            Peralatan / sparepart yang dibawa</th>
                                        <th colspan="3"
                                            style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                            Peralatan yang dikembalikan</th>
                                    </tr>
                                    <th style="text-align: center;">Nama Peralatan/Sparepart</th>
                                    <th style="text-align: center;"> Qty</th>
                                    <th style="text-align: center;"> Nama Peralatan/Sparepart</th>
                                    <th style="text-align: center;">Qty</th>
                                    <th style="text-align: center;">Keterangan</th>
                                    <tr>
                                </thead>
                                <tbody id="tbody-list-detail">

                                </tbody>
                            </table>
                            <br>
                            <table class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th rowspan="2"
                                        style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                        <button type="button" class="btn btn-primary btn-xs"
                                                onclick="tambah_baris2();">
                                                <i class="ti ti-plus"></i>
                                            </button></th>
                                        <th colspan="2"
                                            style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                            Sparepart yang dipasang/dipakai</th>
                                        <th colspan="3"
                                            style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                            Sparepart yang rusak / sisa sparepart</th>
                                    </tr>
                                    <th style="text-align: center;">Nama Sparepart*</th>
                                    <th style="text-align: center;"> Qty</th>
                                    <th style="text-align: center;"> Nama Sparepart%</th>
                                    <th style="text-align: center;">Qty</th>
                                    <th style="text-align: center;">Keterangan</th>
                                    <tr>
                                </thead>
                                <tbody id="tbody-list-detail-2">

                                </tbody>
                            </table>
                            <br>
                            <table class="table table-bordered table-responsive">
                                <tbody>
                                    <tr>
                                        <td>Dikerjakan Oleh :</td>
                                        <td>1.<select id="dikerjakan_oleh" class="select2 form-select"
                                            name="dikerjakan_oleh">
                                            <option value=""></option>
                                            @foreach ($jabatan3 as $nama)
                                                <option value="{{ $nama->NAMA }}">{{ $nama->NAMA }}</option>
                                                @endforeach
                                        </select>
                                        </td>
                                        <td>2.<select id="dikerjakan_oleh2" class="select2 form-select"
                                            name="dikerjakan_oleh2">
                                            <option value=""></option>
                                            @foreach ($jabatan3 as $nama)
                                                <option value="{{ $nama->NAMA }}">{{ $nama->NAMA }}</option>
                                                @endforeach
                                        </select>
                                        </td>
                                        <td>3.<select id="dikerjakan_oleh3" class="select2 form-select"
                                            name="dikerjakan_oleh3">
                                            <option value=""></option>
                                            @foreach ($jabatan3 as $nama)
                                                <option value="{{ $nama->NAMA }}">{{ $nama->NAMA }}</option>
                                                @endforeach
                                        </select>
                                        </td>
                                        <td>4.<select id="dikerjakan_oleh4" class="select2 form-select"
                                            name="dikerjakan_oleh4">
                                            <option value=""></option>
                                            @foreach ($jabatan3 as $nama)
                                                <option value="{{ $nama->NAMA }}">{{ $nama->NAMA }}</option>
                                                @endforeach
                                        </select>
                                        </td>
                                    <tr>
                                </tbody>
                            </table><br>
                            {{-- <div class="col-12" id="tambah">
                            <button type="button" id='btn-tes' class="btn btn-primary me-sm-3 me-1 btn-save"
                                    onclick="save()">Save</button>
                        </div><br> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card p-4">
                    <div class="card-title fw-bold fs-5">Verifikasi QAD Personil**</div>
                    <form id="form-data2">
                        @csrf
                    <table class="table table-bordered table-responsive">
                        <head>
                            <tr>
                                <th></th>
                                <th>Yes</th>
                                <th>No</th>
                            </tr>
                        </head>
                        <tbody>
                            @foreach ($soal as $key=>$data)
                            <tr>
                                <td>{{ ($key+1).'. '.$data->soal }}
                                    <input class="form-control" type="hidden" value="{{ $data->id }}" id="soal"
                                    name="soal[]" />
                                </td>
                                <td>
                                    <div class="col-md-4">
                                        <input class="form-check-input" type="checkbox" value="0" id="status"
                                            name="status[]" />
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-4">
                                        <input class="form-check-input" type="checkbox" value="1" id="status"
                                            name="status[]" />
                                    </div>
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
                                                    DICEK OLEH</th>
                                                    <th style="vertical-align: middle; text-align: center;">
                                                        DIVERIFIKASI OLEH</th>
                                            </tr>
                                            <tr>
                                                <th height="100"
                                                    style="vertical-align: middle; text-align: center">
                                                </th>
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
                                                    <select id="app1_by" class="select2 form-select"
                                                    name="app1_by" onchange="getjabatan()">
                                                    <option value=""></option>
                                                    @foreach ($jabatan3 as $nama)
                                                            <option data-jabatan="{{ $nama->JabatanName }}" data-regno="{{ $nama->RegNo }}" data-idjabatan="{{ $nama->JabatanID }}"
                                                                value="{{ $nama->NAMA }}">{{ $nama->NAMA }}</option>
                                                        @endforeach
                                                </select>
                                                </td>
                                                <td style="vertical-align: middle; text-align: left;">Nama
                                                    &nbsp;&nbsp;&nbsp;: 
                                                    <select id="app2_by" class="select2 form-select"
                                                    name="app2_by" onchange="getjabatanwcc()">
                                                    <option value=""></option>
                                                    @foreach ($jabatanwcc as $nama2)
                                                            <option data-jabatan2="{{ $nama2->JabatanName }}" data-regno2="{{ $nama2->RegNo }}" data-idjabatan2="{{ $nama2->JabatanID }}"
                                                                value="{{ $nama2->NAMA }}">{{ $nama2->NAMA }}</option>
                                                        @endforeach
                                                </select>
                                                </td>
                                                <td style="vertical-align: middle; text-align: left;">Nama
                                                    (Name) &nbsp;&nbsp;&nbsp;:  
                                                    <select id="app3_by" class="select2 form-select"
                                                    name="app3_by" onchange="getjabatanqad()">
                                                    <option value=""></option>
                                                    @foreach ($jabatanqad as $nama3)
                                                            <option data-jabatan3="{{ $nama3->JabatanName }}" data-regno3="{{ $nama3->RegNo }}" data-idjabatan3="{{ $nama3->JabatanID }}"
                                                                value="{{ $nama3->NAMA }}">{{ $nama3->NAMA }}</option>
                                                        @endforeach
                                                </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="vertical-align: middle; text-align: left;">
                                                    Jabatan (position):
                                                    <input type="text" id="app1_jabatan" class="form-control" name="app1_jabatan"  readonly>
                                                    <input type="hidden" id="regno" class="form-control" name="regno">
                                                    <input type="hidden" id="idjabatan" class="form-control" name="idjabatan">
                                                </td>
                                                <td style="vertical-align: middle; text-align: left;">
                                                    Jabatan (position):
                                                    <input type="text" id="app2_jabatan" class="form-control" name="app2_jabatan"  readonly>
                                                    <input type="hidden" id="regno2" class="form-control" name="regno2">
                                                    <input type="hidden" id="idjabatan2" class="form-control" name="idjabatan2">
                                                </td> 
                                                <td style="vertical-align: middle; text-align: left;">
                                                    Jabatan (position):
                                                    <input type="text" id="app3_jabatan" class="form-control" name="app3_jabatan"  readonly>
                                                    <input type="hidden" id="regno3" class="form-control" name="regno3">
                                                    <input type="hidden" id="idjabatan3" class="form-control" name="idjabatan3">
                                                </td>                                                                
                                            </tr>
                                            <tr>
                                                <td style="vertical-align: middle; text-align: left;">
                                                    Tanggal (date) :</td>
                                                <td style="vertical-align: middle; text-align: left;">
                                                    Tanggal :</td>
                                                <td style="vertical-align: middle; text-align: left;">
                                                        Tanggal :</td>
                                                </tr>
                                            </tbody>
                                    </table>
                                </th>
                            </tr>
                        </thead>
                    </table>
                    <br>
                    <div class="col-12" id="tambah">
                        <button type="button" id='btn-tes' class="btn btn-primary me-sm-3 me-1 btn-save"
                            onclick="save()">Save</button>
                    </div><br>
                </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function save() {
            var formData = $('#form-data').serialize();
            var formData2 = $('#form-data2').serialize();
            console.log(formData);
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
                            url: '{{ route('frm.store_verifikasi') }}',
                            type: "POST",
                            data: formData + '&' + formData2, // Combine formData and formData2
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType: "JSON",
                            success: function(response) {
                                console.log(response);
                            },
                            error: function(xhr, text) {
                                console.log(xhr);
                                Swal.fire('Error : ' + String(xhr.responseJSON.code),
                                    String(xhr.responseJSON.message), 'error');
                                $(".btn-save").attr('disabled', false);
                                $(".btn-save").html('Save');
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
        let jumlah_baris = 1;

        function tambah_baris() {
            var tr = "";
            tr += `
			<tr row="${jumlah_baris}"> 
                <td style="text-align: center;">
					<button class="btn btn-danger btn-xs" onclick="hapus_kategori(this);"><i class="fa fa-trash"></i></button>
				</td>
                <td style="text-align: center;">
                    <input id="detail_id" class="form-control" type="hidden" value="{{ $header[0]['headerid'] }}" name="detail_id[]">
                    <input id="sparepart_dibawa" class="form-control" type="text" name="sparepart_dibawa[]"></td>
                <td style="text-align: center;"><input id="quantity_dibawa" class="form-control" type="text" name="quantity_dibawa[]"></td>
                <td style="text-align: center;"><input id="sparepart_kembali" class="form-control" type="text" name="sparepart_kembali[]"></td>
                <td style="text-align: center;"><input id="quantity_kembali" class="form-control" type="text" name="quantity_kembali[]"></td>
                <td style="text-align: center;"><input id="keterangan" class="form-control" type="text" name="keterangan[]"></td>
			</tr>
		`;
            $('#tbody-list-detail').append(tr);
            jumlah_baris = jumlah_baris + 1;
        }

        function tambah_baris2() {
            var tr = "";
            tr += `
			<tr row="${jumlah_baris}"> 
                <td style="text-align: center;">
					<button class="btn btn-danger btn-xs" onclick="hapus_kategori(this);"><i class="fa fa-trash"></i></button>
				</td>
                <td style="text-align: center;">
                    <input id="detail_id2" class="form-control" type="hidden" value="{{ $header[0]['headerid'] }}" name="detail_id2[]">
                    <input id="sparepart_pasang" class="form-control" type="text" name="sparepart_pasang[]" value="{{ $header[0]['sparepart_pasang'] }}"></td>
                <td style="text-align: center;"><input id="quantity_pasang" class="form-control" type="text" name="quantity_pasang[]"></td>
                <td style="text-align: center;"><input id="sparepart_rusak" class="form-control" type="text" name="sparepart_rusak[]"></td>
                <td style="text-align: center;"><input id="quantity_rusak" class="form-control" type="text" name="quantity_rusak[]"></td>
                <td style="text-align: center;"><input id="keterangan2" class="form-control" type="text" name="keterangan2[]"></td>
			</tr>
		`;
            $('#tbody-list-detail-2').append(tr);
            jumlah_baris = jumlah_baris + 1;
        }

        function hapus_kategori(element) {
            $(element).closest('tr').remove();
        }

        function getjabatan(){
            var jabatan = $('#app1_by').find(':selected').data('jabatan');
            var regno = $('#app1_by').find(':selected').data('regno');
            var idjabatan = $('#app1_by').find(':selected').data('idjabatan');
             $("#app1_jabatan").val(jabatan);
             $("#regno").val(regno);
             $("#idjabatan").val(idjabatan);
        }

        function getjabatanwcc(){
            var jabatan = $('#app2_by').find(':selected').data('jabatan2');
            var regno = $('#app2_by').find(':selected').data('regno2');
            var idjabatan = $('#app2_by').find(':selected').data('idjabatan2');
             $("#app2_jabatan").val(jabatan);
             $("#regno2").val(regno);
             $("#idjabatan2").val(idjabatan);
        }

        function getjabatanqad(){
            var jabatan = $('#app3_by').find(':selected').data('jabatan3');
            var regno = $('#app3_by').find(':selected').data('regno3');
            var idjabatan = $('#app3_by').find(':selected').data('idjabatan3');
             $("#app3_jabatan").val(jabatan);
             $("#regno3").val(regno);
             $("#idjabatan3").val(idjabatan);
        }
    </script>
@endsection
