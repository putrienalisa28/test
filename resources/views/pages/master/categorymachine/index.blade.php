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
    </style>

    <div class="container-fluid flex-grow-1 container-p-y">
        <div style="display: flex; justify-content: space-between; align-items: center;" class="mb-3">
            <h4 class="fw-bold py-1 mb-2"><span class="text-muted fw-light">Master /</span> Category Maintenance</h4>
            <!-- DataTable with Buttons -->
            <button type="button" class="btn btn-primary float-right open-modal"><span class="fa fa-plus me-2"></span>New
                Category</button>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card p-4">
                    <div class="card-title fw-bold fs-5">List Of Category Maintenance</div>
                    <div class="card-datatable table-responsive pt-3" style="height: 700px;">
                        <table class="table table-responsive table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name Of Category</th>
                                    <th>Group Machine</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($listOfCategoryMachine as $m)
                                    <tr>
                                        <td>{{ $m->machine_category_id }}</td>
                                        <td>{{ $m->name_category_mesin }}</td>
                                        <td>
                                            @php
                                                $tagData = json_decode($m->tag);
                                            @endphp
                                            @if (is_array($tagData))
                                                @foreach ($tagData as $tag)
                                                    <span
                                                        class="badge bg-danger p-1 text-small">#{{ getMachineName($tag) }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-xs btn-edit"><i
                                                    class="fa fa-edit"></i></button>
                                            <button class="btn btn-danger btn-xs"><i class="fa fa-trash"
                                                    onclick="deleted()"></i></button>
                                        </td>
                                        <td hidden>{{ $m->tag }}</td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-form" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalToggleLabel">Form Category Maintenance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label" hidden>Id Category Machine</label>
                            <input type="hidden" x-model="idcategorymesin" name="machine_category_id" class="form-control"
                                id="idcategorymesin" placeholder="idcategorymesin" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Name Of Category Machine</label>
                            <input type="text" x-model="categorymachine" name="categorymachine" class="form-control"
                                id="categorymachine" placeholder="Category Machine" />
                        </div>
                        <!-- Multiple -->
                        <div class=" mb-3">
                            <label for="select2Multiple" class="form-label">Group of Machine</label>
                            <select id="select2Multiple" class="select2 form-select" name='tag[]' multiple>
                                @foreach ($listOfMachine as $x)
                                    <option value="{{ $x->machine_id }}">{{ $x->machine_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="pt-1">
                            <button type="button" class="btn btn-primary me-sm-3 me-1 btn-save"
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

    <form id="myForm">
        <input type="text" name="name" id="name">
        <input type="email" name="email" id="email">
        <input type="button" value="Submit" id="submitButton">
    </form>

    <script>
        $(document).ready(function() {
            $('.open-modal').click(function() {
                $('#modal-form').modal('show');
            });

            $("#myForm").validate({
                rules: {
                    name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    name: {
                        required: "Please enter your name"
                    },
                    email: {
                        required: "Please enter your email",
                        email: "Please enter a valid email address"
                    }
                },
                submitHandler: function(form) {
                    // Code to handle form submission
                    form.submit();
                }
            });

            $("#submitButton").click(function() {
                if ($("#myForm").valid()) {
                    // Valid form, submit it
                    $("#myForm").submit();
                } else {
                    // Invalid form, display error messages
                    $("#myForm").validate().focusInvalid();
                }
            });
        });
    </script>


    <script>
        function resetModal() {
            $('#idcategorymesin').val('');
            $('#categorymachine').val('');
            $('#select2Multiple').val(null).trigger('change');
        }

        $(document).ready(function() {
            // Event handler untuk tombol edit
            $('.btn-edit').click(function() {
                $('#modal-form').modal('show');
                var row = $(this).closest('tr');
                var id = row.find('td:nth-child(1)').text();
                var name = row.find('td:nth-child(2)').text();
                var group = row.find('td:nth-child(5)').html();

                $('.btn-save').html('Update')

                $('#idcategorymesin').val(id);
                $('#categorymachine').val(name);

                var selectElement = $('#select2Multiple');
                selectElement.val(null).trigger('change'); // Menghapus opsi yang dipilih sebelumnya

                var options = selectElement.find('option');
                options.each(function() {
                    var optionValue = $(this).val();
                    var optionText = $(this).text();
                    // console.log("Nilai: " + optionValue + ", Teks: " + optionText);
                });

                var data = JSON.parse(group);
                data.forEach(function(item) {
                    var option = new Option(item, item);
                    // selectElement.append(option);
                });

                selectElement.val(data).trigger('change');

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

        function save() {
            var formData = $('#form-data').serialize();
            swAlertConfirm('{{ route('categorymachine.store') }}', undefined, undefined, formData);
            $('#modal-form').modal('hide');

        }

        function deleted() {
            var row = event.target.closest("tr");
            var category_id = row.cells[0].innerText;
            var formData = {
                'category_id': category_id
            };

            swAlertConfirm(`{{ route('categorymachine.delete') }}`, undefined, undefined, formData);
        }
    </script>

@endsection
