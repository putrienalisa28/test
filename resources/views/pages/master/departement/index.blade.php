@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')


    <div class="container-fluid flex-grow-1 container-p-y">
        <div style="display: flex; justify-content: space-between; align-items: center;" class="mb-3">
            <h4 class="fw-bold py-1 mb-2"><span class="text-muted fw-light">Master /</span> Department</h4>
            <!-- DataTable with Buttons -->
            <button type="button" class="btn btn-primary float-right open-modal" id="machineId"><span
                    class="fa fa-plus me-2"></span>New Department</button>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card p-4">
                    <div class="card-title fw-bold fs-5">List Of Department</div>
                    <div class="card-datatable table-responsive pt-3" style="height: 700px;">
                        <table class="table table-responsive table-striped table-hover" id="datatable">
                            <thead>
                                <tr>
                                    <th hidden>Header Id</th>
                                    <th hidden>Dept Id</th>
                                    <th>Dept Abbr</th>
                                    <th>Department Name</th> 
                                    <th>Machine</th> 
                                    <th>Action</th>                               
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($list_data as $key=>$data)
                                    <tr style="cursor: pointer;">
                                        <td hidden>{{ $data->header_id }}</td>
                                        <td hidden>{{ $data->dept_id }}</td>
                                        <td>{{ $data->dept_abbr }}</td>
                                        <td>{{ $data->nama_panjang }}</td>
                                        <td> @foreach ($data['deptDtl'] as $sd)
                                                <span
                                                    class="badge bg-primary mb-1">#{{ $sd['machine']->machine_name }}</span>
                                            @endforeach
                                        </td>
                                        <td style="position: sticky; right: 0px; background-color: aliceblue;">
                                            <button type="button" class="btn btn-primary btn-xs btn-edit me-1"><i
                                                    class="fa fa-edit"></i></button>
                                            <button class="btn btn-danger btn-xs"><i class="fa fa-trash"
                                                    onclick="deleted()"></i></button>
                                        </td>
                                        <td hidden>
                                            @php
                                                $machineIds = [];
                                                
                                                foreach ($data['deptDtl'] as $sd) {
                                                    $machineIds[] = $sd->machine_id;
                                                }
                                                
                                                echo json_encode($machineIds);
                                            @endphp
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-form" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalToggleLabel">Form New Department</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-data">
                            @csrf 
                            <div class="mb-3">
                                <label  for="exampleFormControlInput1" class="form-label">Department</label>
                                <input hidden  type="text"  name="header_id" id="header_id"
                                    class="form-control"  placeholder="Dept" /> 
                                <select id="selectdept" class="form-select select2 select-dept" name='iddept'>
                                @foreach ($dept as $x)
                                                <option value="{{ $x->BagianID }}">
                                                    {{ $x->NamaBagian }}
                                                </option>
                                            @endforeach                        
                                </select>             
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Full Name</label>
                                <input type="text"  name="namapanjang" id="namapanjang"
                                    class="form-control"  placeholder="Full Name" />
                            </div> 
                            <div class="mb-3" hidden>
                                <label hidden for="exampleFormControlInput1" class="form-label">Singkatan</label>
                                <input hidden  type="text"  name="namadeptabbr" id="namadeptabbr"
                                    class="form-control"  placeholder="idmesin" />
                            </div>     
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Machine</label>
                                @foreach ($mesin as $y)
                                    <div class="col-md-8"></div>
                                    <div class="col-md-4">
                                        <input class="form-check-input" type="checkbox" value="{{ $y->machine_id }}"
                                            id="IdMachine" name="IdMachine[]" />
                                        <label class="form-check-label" for="defaultCheck3"> {{ $y->machine_name }} </label>
                                    </div>
                                @endforeach
                            </div>                    
                            <div class="pt-1">
                                <button type="button" id='btn-tes' class="btn btn-primary me-sm-3 me-1 btn-save"
                                    onclick="save()">Save</button>
                                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
         </div>        
        <script>

            function save() {
                var formData = $('#form-data').serialize();
                swAlertConfirm('{{ route('departement.store') }}', undefined, undefined, formData);
                $('#modal-form').modal('hide'); // Menutup modal setelah tombol "Save" diklik
                // Menghilangkan nilai pada elemen select dengan ID select2Multiple
                $("#select2Multiple").val(null).trigger("change");
                $("#namapanjang").val("");
                $("#iddept").val("");
                $(".select2").val(null).trigger("change");

            }

            function deleted() {
                var row = event.target.closest("tr");
                var header_id = row.cells[0].innerText;
                var formData = {
                    'header_id': header_id
                };

                swAlertConfirm(`{{ route('departement.delete') }}`, undefined, undefined, formData);
            }

            function resetModal() {
                $('#header_id').val('');
                $('#namapanjang').val('');
                $('#namadeptabbr').val('');
                $('#select2Multiple').val(null).trigger('change');
               
            }

            $(document).ready(function() {

                $('.open-modal').click(function() {
                    $('#modal-form').modal('show');

                    $('#form-data input').val('');
                    $('#select2Multiple').val(null).trigger('change');
                    $('input[type="checkbox"]').prop('checked', false);
                });

                // Event handler untuk tombol edit
                $('.btn-edit').click(function() {
                    $('#modal-form').modal('show');
                    var row = $(this).closest('tr');
                    var headerid = row.find('td:nth-child(1)').text();
                    var iddept = row.find('td:nth-child(2)').text();
                    var deptabbr = row.find('td:nth-child(3)').text();
                    var namapanjang = row.find('td:nth-child(4)').text();
                    var machineId = row.find('td:nth-child(7)').html();

                    $(".btn-save").html("Update")

                    $('#header_id').val(headerid);
                    $('#iddept').val(iddept);
                    $('#namadeptabbr').val(deptabbr);
                    $('#namapanjang').val(namapanjang);
                    $("#selectdept").val(iddept).trigger("change");

                    var dataMachine = <?=$mesin;?>;
                    for(var i = 0;i<dataMachine.length;i++){
                        $("input[value=" + dataMachine[i]["machine_id"] + "]").attr("checked", false);
                    }

                    var jsonMachineId = JSON.parse(machineId);
                    jsonMachineId.forEach(function(item) {
                        $("input[value=" + item + "]").attr("checked", true);
                    });

                    // Menutup modal setelah tombol "Update" diklik
                    $('.btn-save').click(function() {
                        $('#modal-form').modal('hide');
                    });

                });

                $('.select-dept').change(function() {
                    var dept_id = $(this).val();
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    // Set the CSRF token as a default request header
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    });

                    $.ajax({
                    url: "{{ route('departement.getDeptByPay') }}/",
                    type: "post",
                    data: {
                        dept_id: dept_id
                    },
                    beforeSend: function() {
                    
                        // Menampilkan elemen loading sebelum permintaan Ajax dimulai
                        var loadingRow = $(
                            "<tr class='text-center' id='loading-row'><td colspan='4'>Loading...</td></tr>"
                        );
                        $("#data-table-body").append(loadingRow);
                    },
                    success: function(data) {
                        console.log(data);
                        
                        $("#namadeptabbr").val(data.result[0].NamaBagian)
                        $("#namapanjang").val(data.result[0].NamaPanjang)
                    },
                    error: function(xhr, text) {

                        // Menghapus elemen loading jika terjadi kesalahan pada permintaan Ajax
                        // $("#loading-row").remove();
                        $("#modal-form").modal('hide')
                        // swAlert('error', String(xhr.responseJSON.message), xhr.responseJSON
                        // .code);
                        Swal.fire(String(xhr.responseJSON.code), String(xhr.responseJSON
                                .message),
                            'error')

                        console.log((xhr)); // Tampilkan pesan error dalam konsol
                        console.log(text); // Tampilkan pesan error dalam konsol
                    }
                });
                    // console.log(selectedValue);
                });



                $('.btn-save').click(function() {
                    $('#modal-form').modal('hide');
                });

                $('#modal-form').on('hidden.bs.modal', function() {
                    if (!$('.btn-edit').hasClass('modal-open')) {
                        resetModal();
                        $(".btn-save").html("Save");
                    }
                });
            });
        </script>
    @endsection
