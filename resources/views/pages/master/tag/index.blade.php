@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')

    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="fw-bold py-1 mb-2"><span class="text-muted fw-light">Master /</span> Tag</h4>
        <!-- DataTable with Buttons -->
        <div class="row">
            <div class="col-md-8">
                <div class="card p-4">
                    <div class="card-datatable table-responsive pt-3" style="height: 700px;">
                        <table class="table table-responsive table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tag Abbr</th>
                                    <th>Tag Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listOfTag as $key => $val)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $val->tag_abbr }}</td>
                                        <td>{{ $val->tag_desc }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <h5 class="card-header">Form Input Tag</h5>
                    <div class="card-body">
                        <form id="form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tag Abbr</label>
                                <input type="text" x-model="itemNumber" name="tag_abbr" class="form-control"
                                    id="itemNumber" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tag Name</label>
                                <input type="text" x-model="itemName" name="tag_desc" class="form-control"
                                    id="itemName" />
                            </div>

                            <div class="pt-1">
                                <button type="button" class="btn btn-primary me-sm-3 me-1 btn-save"
                                    onclick="save()">Submit</button>
                                <button type="reset" class="btn btn-label-secondary">Cancel</button>
                            </div>
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
            // Retrieve the CSRF token from the meta tag
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Set the CSRF token as a default request header
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            $.ajax({
                url: "{{ route('tag.store') }}",
                type: "POST",
                data: formData,
                beforeSend: function() {
                    $(".btn-save").attr('disabled', true);
                    $(".btn-save").html('loading...');
                },
                success: function(response) {
                    console.log(response.message); // Tampilkan pesan sukses dalam konsol
                    console.log(response.post); // Tampilkan data post yang disimpan dalam konsol
                    setTimeout(() => {
                        $(".btn-save").attr('disabled', false);
                        $(".btn-save").html('submit');

                    }, 2000);


                    // Lakukan aksi lain yang Anda perlukan setelah berhasil menyimpan data
                },
                error: function(xhr, text) {
                    console.log(xhr.responseText, text); // Tampilkan pesan error dalam konsol
                }
            });
        }
    </script>
@endsection
