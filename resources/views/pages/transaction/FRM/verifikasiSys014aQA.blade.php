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
                                    onclick="save()">Save</button>
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
                                                        @if ($headerperbaikan[0]['dept_id'] == 'WTP')
                                                        {{ trim($headerperbaikan[0]['dept_id']) }}/WPM
                                                        @else
                                                            {{ $headerperbaikan[0]['dept_id'] }}
                                                        @endif
                                                        <input id="no_ref" class="form-control" type="hidden" name="no_ref" value=" {{ $header[0]['nomor'] }}">
                                                        <input id="hdridcek" class="form-control" type="hidden" name="hdridcek">
                                                        <input id="headerid" class="form-control" type="hidden" value="{{ $header[0]['headerid'] }}" name="headerid">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Tanggal : </label>
                                                        <input id="tanggal" class="form-control" type="date"  name="tanggal">
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th scope="col" style="vertical-align:middle; text-align: center;">
                                            <p class="fonthead"></p>VERIFIKASI PERBAIKAN  MESIN
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
                                        <button type="button" class="btn btn-primary btn-xs"
                                                onclick="tambah_baris();">
                                                <i class="ti ti-plus"></i>
                                            </button></th>
                                        <th rowspan="2"
                                        style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                        No</th>
                                        <th rowspan="2"
                                            style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                            NAMA PERALATAN**</th>
                                        <th rowspan="2"
                                            style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                            KODE<br>(Code)</th>
                                        <th rowspan="2"
                                            style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                            JENIS KETIDAKSESUAIAN</th>
                                        <th rowspan="2"
                                            style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                            TINDAKAN YANG DILAKUKAN<br>(Action Conducted)</th>
                                        <th colspan="2"
                                            style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                            JAM</th>
                                        <th rowspan="2"
                                            style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                            STATUS VERIFIKASI</th>
                                        <th rowspan="2"
                                            style="vertical-align:middle; text-align: center; position: sticky; left: 0px; top : 0px">
                                            PARAF</th>
                                    </tr>
                                    <tr>
                                    <th style="text-align: center;"> MULAI</th>
                                    <th style="text-align: center;">SELESAI</th>
                                    <tr>
                                </thead>
                                <tbody id="tbody-list-detail">
                                    {{-- @foreach ($header as $key => $data)
                                    <tr style="cursor: pointer;" row="{{ $key+1 }}">
                                        <td style="text-align: center;">{{ $key + 1 }}</td>
                                        <td>{{ $data->category_name }}
                                            <input id="nama_peralatan" class="form-control" type="hidden" name="nama_peralatan[]" value="{{ $data->category_name }}">
                                        </td>
                                        <td style="text-align: center;">{{ $data->kode }}
                                            <input id="kode" class="form-control" type="hidden" name="kode[]" value="{{ $data->kode }}">
                                        </td>
                                        <td>
                                            <textarea id="kerusakan" class="form-control" name="kerusakan[]"></textarea>
                                        </td>
                                        <td><textarea id="tindakan" class="form-control" name="tindakan[]"></textarea></td>
                                        <td>{{ $data->realisasi }}
                                            <input id="tanggal" class="form-control" type="hidden" name="tanggal[]" value="{{ $data->realisasi }}">
                                        </td>
                                        <td><input id="mulai_{{ $key + 1 }}" class="form-control" type="time" name="mulai[]" onkeyup="getDurasi(this);" onclick="getDurasi(this);"></td>
                                        <td><input id="selesai_{{ $key + 1 }}" class="form-control" type="time" name="selesai[]" onkeyup="getDurasi(this);" onfocusout="getDurasi(this);"></td>
                                        <td><input id="durasi_{{ $key + 1 }}" class="form-control" type="text" name="jam[]" readonly></td>
                                        <td><textarea id="keterangan" class="form-control" name="keterangan[]"></textarea></td>
                                        <td>
                                            <select id="nama_{{ $key + 1 }}" class="form-select" name="nama[]" onchange="getParaf(this);">
                                                <option value=""></option>
                                                @foreach ($jabatan3 as $nama3)
                                                    <option data-regno="{{ $nama3->RegNo }}" value="{{ $nama3->NAMA }}">{{ $nama3->NAMA }}</option>
                                                @endforeach
                                            </select>
                                            
                                        </td>     
                                        <td><input id="paraf_{{ $key + 1 }}" class="form-control" type="text" name="paraf[]"></td>
                                    </tr>
                                @endforeach --}}
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
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
                <td style="text-align: center;"><input id="quantity_dibawa" class="form-control" type="text" name="quantity_dibawa[]"></td>
                <td style="text-align: center;"><input id="sparepart_kembali" class="form-control" type="text" name="sparepart_kembali[]"></td>
                <td style="text-align: center;"><input id="quantity_kembali" class="form-control" type="text" name="quantity_kembali[]"></td>
                <td style="text-align: center;"><input id="keterangan" class="form-control" type="text" name="keterangan[]"></td>
                <td style="text-align: center;"><input id="quantity_kembali" class="form-control" type="text" name="quantity_kembali[]"></td>
                <td style="text-align: center;"><input id="keterangan" class="form-control" type="text" name="keterangan[]"></td>
			</tr>
		`;
            $('#tbody-list-detail').append(tr);
            jumlah_baris = jumlah_baris + 1;
        }
    </script>
@endsection
