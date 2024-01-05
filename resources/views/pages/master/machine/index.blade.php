@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')


    <div class="container-fluid flex-grow-1 container-p-y">
        <div style="display: flex; justify-content: space-between; align-items: center;" class="mb-3">
            <h4 class="fw-bold py-1 mb-2"><span class="text-muted fw-light">Master /</span> Machine</h4>
            <!-- DataTable with Buttons -->
            <button type="button" class="btn btn-primary float-right open-modal" id="machineId"><span
                    class="fa fa-plus me-2"></span>New Machine</button>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card p-4">
                    <div class="card-title fw-bold fs-5">List Of Machine</div>
                    <div class="card-datatable table-responsive pt-3" style="height: 700px;">
                        <table class="table table-responsive table-striped table-hover" id="datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name Of Machine</th>
                                    <th>Serial Number</th>
                                    <th>Location</th>
                                    <th>Departmen</th>
                                    <th>Table Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listOfMachine as $m)
                                    <tr style="cursor: pointer;">
                                        <td>{{ $m->machine_id }}</td>
                                        <td>{{ $m->machine_name }}</td>
                                        <td>{{ $m->serial_number }}</td>
                                        <td>{{ $m->location }}</td>
                                        <td>{{ $m->tag }}</td>
                                        <td>{{ $m->tbl_from_prk_server }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-xs btn-edit"><i
                                                    class="fa fa-edit"></i></button>
                                            <button class="btn btn-danger btn-xs"><i class="fa fa-trash"
                                                    onclick="deleted()"></i></button>
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
                        <h5 class="modal-title" id="modalToggleLabel">Form New Machine</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-data">
                            @csrf

                            <div class="mb-3" hidden>
                                <label for="exampleFormControlInput1" class="form-label">Id mesin</label>
                                <input type="text" x-model="accountNumber" name="machine_id" id="machine_id"
                                    class="form-control" id="exampleFormControlInput1" placeholder="idmesin" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Name of Machine</label>
                                <input type="text" x-model="namamesin" name="machine_name" id="machine_name"
                                    class="form-control" id="exampleFormControlInput1" placeholder="Name of Machine" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Serial Number</label>
                                <input type="text" x-model="serialNumber" name="serial_number" id="serial_number"
                                    class="form-control" id="exampleFormControlInput1" placeholder="Serial Number" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Location</label>
                                <input type="text" x-model="lokasi" name="location" id="location" class="form-control"
                                    id="exampleFormControlInput1" placeholder="Location Of Machine" />
                            </div>
                            <div class="mb-3">
                                <label for="select2Multiple" class="form-label">Bagian</label>
                                <select id="select2Multiple" class="select2 form-select" name='tag'>
                                    <option value="WTP">WTP</option>
                                    <option value="CWC">CWC</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Table Name PRK Server</label>
                                <input type="text" x-model="lokasi" name="table_name" id="table_name"
                                    class="form-control" id="exampleFormControlInput1" placeholder="" />
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
        <div class="modal fade" id="modal_search" aria-labelledby="modalToggleLabel" tabindex="-1"
            style="display: none" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalToggleLabel">Form New Machine</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="dt-scrollableTable table" id="mdl-table">
                                    <thead>
                                        <tr class="bg-gradient-primary text-center">
                                            <th>No</th>
                                            <th>Item Name</th>
                                            <th>Item ID</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data-table-body">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-bs-target="#modalToggle2"
                            data-bs-toggle="modal"data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function save() {
                var formData = $('#form-data').serialize();
                swAlertConfirm('{{ route('machine.store') }}', undefined, undefined, formData);
                $('#modal-form').modal('hide'); // Menutup modal setelah tombol "Save" diklik
            }

            function deleted() {
                var row = event.target.closest("tr");
                var machine_id = row.cells[0].innerText;
                var formData = {
                    'machine_id': machine_id
                };

                swAlertConfirm(`{{ route('machine.delete') }}`, undefined, undefined, formData);
            }

            function resetModal() {
                $('#machine_id').val('');
                $('#machine_name').val('');
                $('#serial_number').val('');
                $('#location').val('');
                $('#select2Multiple').val(null).trigger('change');
                $('#table_name').val('');
            }


            $(document).ready(function() {

                $('.open-modal').click(function() {
                    $('#modal-form').modal('show');
                });

                // Event handler untuk tombol edit
                $('.btn-edit').click(function() {
                    $('#modal-form').modal('show');
                    var row = $(this).closest('tr');
                    var id = row.find('td:nth-child(1)').text();
                    var name = row.find('td:nth-child(2)').text();
                    var serialnumber = row.find('td:nth-child(3)').html();
                    var location = row.find('td:nth-child(4)').html();
                    var dept = row.find('td:nth-child(5)').html();
                    var table = row.find('td:nth-child(6)').html();

                    $(".btn-save").html("Update")


                    $('#machine_id').val(id);
                    $('#machine_name').val(name);
                    $('#serial_number').val(serialnumber);
                    $('#location').val(location);
                    $('#select2Multiple').val(dept).trigger('change');
                    $('#table_name').val(table);
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
