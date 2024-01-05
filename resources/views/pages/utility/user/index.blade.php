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
        <h4 class="fw-bold py-1 mb-2"><span class="text-muted fw-light">Utility /</span> Management User</h4>
        <!-- DataTable with Buttons -->
        <div class="row g-4">
            @foreach ($groupList as $item)
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h6 class="fw-normal mb-2">Total {{ count($item->users) }} users</h6>
                                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                    @foreach ($item->users as $users)
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="{{ $users->name }}" class="avatar avatar-sm pull-up">
                                            <img class="rounded-circle" src="{{ asset('img/avatars/user.png') }}"
                                                alt="Avatar" />
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="d-flex justify-content-between align-items-end mt-1">
                                <div class="role-heading">
                                    <h4 class="mb-1">{{ $item->user_group_name }}</h4>
                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal"
                                        class="role-edit-modal"><span>Edit Role</span></a>
                                </div>
                                <a href="javascript:void(0);" class="text-muted"><i class="ti ti-copy ti-md"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card h-100">
                    <div class="row h-100">
                        <div class="col-sm-5">
                            <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                                <img src="{{ asset('img/illustrations/add-new-roles.png') }}"
                                    class="img-fluid mt-sm-4 mt-md-0" alt="add-new-roles" width="83" />
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="card-body text-sm-end text-center ps-sm-0">
                                <button data-bs-target="#addRoleModal" data-bs-toggle="modal"
                                    class="btn btn-primary mb-2 text-nowrap add-new-role">
                                    Add New Role
                                </button>
                                <p class="mb-0 mt-1">Add role, if it does not exist</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row pt-3">
            <div class="col-md-8">
                <div class="card p-4">
                    <div class="card-title fw-bold fs-5">List Of Users</div>
                    <div class="card-datatable table-responsive pt-3" style="height: 700px;">
                        <table class="table table-responsive table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Userid</th>
                                    <th>Fullname</th>
                                    <th>Group User</th>
                                    <th>Telgram ID</th>
                                    <th class="text-center">Send Notif</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($userList as $m)
                                    <tr>
                                        <td>{{ $m->username }}</td>
                                        <td>{{ $m->name }}</td>
                                        <td>{{ $m->group->user_group_name }}</td>
                                        <td>{{ $m->telegram_id }}</td>
                                        <td align="center">{!! $m->send_reminder == 1
                                            ? '<i class="fa fa-check-circle text-success"></i>'
                                            : '<i class="fa fa-times-circle text-danger"></i>' !!}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-xs btn-edit"><i
                                                    class="fa fa-edit"></i></button>
                                            <button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                        </td>
                                        <td hidden>{{ $m->tag }}</td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <h5 class="card-header">Form Input Category Machine</h5>
                    <div class="card-body">

                        <form id="form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Username</label>
                                <input type="hidden" name="action" class="form-control " id="action" value="save">
                                <input type="text" name="username" class="form-control " id="username"
                                    placeholder="username" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Fullname</label>
                                <input type="text" name="name" class="form-control " id="name"
                                    placeholder="fullname" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Password</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="password" class="form-control" placeholder="password" />
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="c_password" class="form-control"
                                            placeholder="confirm password" />
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Group User</label>
                                <select class="select2 form-select" name='group_id'>
                                    <option></option>
                                    @foreach ($groupList as $x)
                                        <option value="{{ $x->user_group_id }}">{{ $x->user_group_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Is Active</label>
                                <select id="select2Multiple" class="select2 form-select" name='is_active'>
                                    <option></option>
                                    <option value="1" selected>Active</option>
                                    <option value="0">Not Active</option>
                                </select>
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

    <script>
        $(document).ready(function() {
            // Event handler untuk tombol edit
            $('.btn-edit').click(function() {
                var row = $(this).closest('tr');
                var id = row.find('td:nth-child(1)').text();
                var name = row.find('td:nth-child(2)').text();
                var group = row.find('td:nth-child(5)').html();

                $('.btn-save').html('update')
                $('#action').val('update');

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
        });

        function save() {

            var formData = $('#form-data').serialize();

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
                            url: '{{ route('user.store') }}',
                            type: "POST",
                            data: formData,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType: "JSON",
                            success: function(response) {
                                console.log(response);
                                Swal.fire('Success!', String(response.message),
                                    'success');
                                if (response.code == 200) {
                                    Swal.fire("Success!",
                                        String(
                                            response
                                            .message), 'success');
                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 2000);
                                } else {
                                    Swal.fire('Error : ' + String(response.code),
                                        String(
                                            response
                                            .message), 'warning');
                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 2000);
                                }
                                $(".btn-save").attr('disabled', false);
                                $(".btn-save").html('Save');
                            },
                            error: function(xhr, text) {
                                console.log(xhr);
                                Swal.fire('Error : ' + String(xhr.status),
                                    String(xhr
                                        .responseJSON
                                        .message), 'error');
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
    </script>

@endsection
