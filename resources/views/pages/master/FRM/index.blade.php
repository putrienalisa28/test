@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')

    <style>
        ol {
            margin-left: 30px;
            counter-reset: item;
        }

        .wtree li {
            list-style-type: none;
            margin: 10px 0 10px 10px;
            position: relative;
        }

        .wtree li:before {
            content: "";
            counter-increment: item;
            position: absolute;
            top: -10px;
            left: -30px;
            border-left: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            width: 30px;
            height: 15px;
        }

        .wtree li:after {
            position: absolute;
            content: "";
            top: 5px;
            left: -30px;
            border-left: 1px solid #ddd;
            border-top: 1px solid #ddd;
            width: 30px;
            height: 100%;
        }

        .wtree li:last-child:after {
            display: none;
        }

        .wtree li span {
            display: block;
            border: 1px solid #ddd;
            padding: 10px 10px 20px;
            color: #666;
            text-decoration: none;
        }

        li span {
            background-color: #FFFFFF;
        }

        li li span {
            background-color: #FFFFFF;
        }

        li li li span {
            background-color: #FFFFFF;
        }
    </style>
    <div class="row pt-3 pe-4 ps-5">
        <div style="display: flex; justify-content: space-between; align-items: center;" class="mb-3">
            <h4 class="fw-bold mb-2"><span class="text-muted fw-light">Utility /</span> Template Form Sys</h4>
            <!-- DataTable with Buttons -->
        </div>
        <div class="col-md-8">
            <div class="card p-4">
                <div class="card-datatable table-responsive pt-3" style="height: 700px;">
                    {{-- <h4 class="title">FRM-SYS-015a</h4> --}}
                    <ol class="wtree">
                        @foreach ($peralatan as $key => $m)
                            <li>
                                <span style="background-color:  rgb(243, 221, 243)">
                                    {{ $m->machine_name }}
                                    <div class="btn-group" style="position: absolute; top: 10px; right: 10px;">
                                        <button type="button" class="btn btn-info btn-xs btn-tambah"
                                            data-id="{{ $m->machine_id }}"><i class="fa fa-plus"
                                                title="Tambah Level 2"></i></button>
                                        <button type="button" class="btn btn-primary btn-xs btn-edit"
                                            data-id="{{ $m->machine_id }}" data-name="{{ $m->machine_name }}"><i
                                                class="fa fa-edit"></i></button>
                                        @if (count($m['fm015category']) == 0)
                                            <button class="btn btn-danger btn-xs"><i class="fa fa-trash"
                                                    onclick="deleted()"></i></button>
                                        @else
                                        @endif
                                    </div>
                                </span>
                                <ol>
                                    @foreach ($m['fm015category'] as $key => $ct)
                                        <li>
                                            <span style="background-color: rgb(221, 243, 233)">
                                                {{ $key + 1 }}. {{ $ct->category_name }}
                                                <div class="btn-group" style="position: absolute; top: 10px; right: 10px;">
                                                    <button type="button" class="btn btn-info btn-xs btn-tambah2"
                                                        data-id="{{ $m->machine_id }}"
                                                        data-idcategory="{{ $ct->category_id }}"><i class="fa fa-plus"
                                                            title="Tambah Level 3"></i></button>
                                                    <button type="button" class="btn btn-primary btn-xs btn-edit"
                                                        data-id="{{ $m->machine_id }}"
                                                        data-idcategory="{{ $ct->category_id }}"
                                                        data-namecategory="{{ $ct->category_name }}"><i
                                                            class="fa fa-edit"></i></button>
                                                    @if (count($ct['Form015asubcategory']) == 0)
                                                        <button class="btn btn-danger btn-xs"><i class="fa fa-trash"
                                                                onclick="deleted()"></i></button>
                                                    @else
                                                    @endif
                                                </div>
                                            </span>
                                        </li>
                                        <ol>
                                            @foreach ($ct['Form015asubcategory'] as $sct)
                                                <li>
                                                    <span>
                                                        - {{ $sct->subcategory_name }}
                                                        <div class="btn-group"
                                                            style="position: absolute; top: 10px; right: 10px;">
                                                            <button type="button" class="btn btn-primary btn-xs btn-edit"
                                                                data-id="{{ $m->machine_id }}"
                                                                data-idcategory="{{ $ct->category_id }}"
                                                                data-idsubcategory="{{ $sct->subcategory_id }}"
                                                                data-namesubcategory="{{ $sct->subcategory_name }}"><i
                                                                    class="fa fa-edit"></i></button>
                                                            <button class="btn btn-danger btn-xs"><i class="fa fa-trash"
                                                                    onclick="deleted()"></i></button>
                                                        </div>
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ol>
                                    @endforeach
                                </ol>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-header">Form Setting Sys</h5>
                <div class="card-body">

                    <form id="form-data">
                        @csrf
                        <div class="mb-3" hidden>
                            <label for="exampleFormControlInput1" class="form-label">Header ID</label>
                            <input type="hidden" name="id_peralatan" class="form-control " id="id_peralatan">
                            <input type="hidden" name="id_category" class="form-control " id="id_category">
                            <input type="hidden" name="id_subcategory" class="form-control " id="id_subcategory">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Deskripsi</label>
                            <input type="text" name="deskripsi" class="form-control " id="deskripsi"
                                placeholder="deskripsi" />
                        </div>
                        <div class="pt-1">
                            <button type="button" class="btn btn-primary me-sm-3 me-1 btn-save"
                                onclick="save()">Save</button>
                            <button type="reset" class="btn btn-label-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="modal-form2" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalToggleLabel">Tambah Master Level 2</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-data2">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Machine ID</label>
                            <input type="text" name="id_peralatan2" class="form-control " id="id_peralatan2">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Deskripsi</label>
                            <input type="text" name="deskripsi2" class="form-control " id="deskripsi2"
                                placeholder="deskripsi" />
                        </div>
                        <div class="pt-1">
                            <button type="button" class="btn btn-primary me-sm-3 me-1 btn-save"
                                onclick="save2()">Save</button>
                            <button type="reset" class="btn btn-label-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-form3" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalToggleLabel">Tambah Master Level 3</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-data3">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Machine ID</label>
                            <input type="text" name="id_peralatan3" class="form-control " id="id_peralatan3">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Category ID</label>
                            <input type="text" name="id_category3" class="form-control " id="id_category3">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Deskripsi</label>
                            <input type="text" name="deskripsi3" class="form-control " id="deskripsi"
                                placeholder="deskripsi" />
                        </div>
                        <div class="pt-1">
                            <button type="button" class="btn btn-primary me-sm-3 me-1 btn-save"
                                onclick="save3()">Save</button>
                            <button type="reset" class="btn btn-label-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function save() {
            var formData = $('#form-data').serialize();
            swAlertConfirm('{{ route('frmsy015a.store') }}', undefined, undefined, formData)
        }

        function save2() {
            var formData = $('#form-data2').serialize();
            swAlertConfirm('{{ route('frmsy015a.store2') }}', undefined, undefined, formData)
        }

        function save3() {
            var formData = $('#form-data3').serialize();
            swAlertConfirm('{{ route('frmsy015a.store3') }}', undefined, undefined, formData)
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
            // Event handler untuk tombol edit
            $('.btn-edit').click(function(event) {
                var button = $(event.currentTarget);
                var id = button.data('id');
                var category = button.data('idcategory');
                var subcategory = button.data('idsubcategory');
                var name = button.data('name');
                var namecategory = button.data('namecategory');
                var namesubcategory = button.data('namesubcategory');

                $('.btn-save').html('Update');
                //
                $('#id_peralatan').val(id);
                $('#id_category').val(category);
                $('#id_subcategory').val(subcategory);

                if (name != undefined) {
                    $('#deskripsi').val(name);
                } else if (namecategory != undefined) {
                    $('#deskripsi').val(namecategory);
                } else {
                    $('#deskripsi').val(namesubcategory);
                }

            });


            $('.btn-save').click(function() {
                $('#modal-form').modal('hide');
            });

            $('.btn-tambah').click(function(event) {
                $('#modal-form2').modal('show');
                var button = $(event.currentTarget);
                var id = button.data('id');

                $('#id_peralatan2').val(id);
            });

            $('.btn-save').click(function() {
                $('#modal-form2').modal('hide');
            });

            $('.btn-tambah2').click(function(event) {
                $('#modal-form3').modal('show');
                var button = $(event.currentTarget);
                var id = button.data('id');
                var category = button.data('idcategory');
                console.log(id)

                $('#id_peralatan3').val(id);
                $('#id_category3').val(category);
            });

            $('.btn-save').click(function() {
                $('#modal-form3').modal('hide');
            });

        });
    </script>
@endsection
