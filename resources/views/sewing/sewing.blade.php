@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')


    <div class="container-fluid flex-grow-1 container-p-y">
    <div style="display: flex; justify-content: space-between; align-items: center;" class="mb-3">
        <h4 class="fw-bold py-1 mb-2"><span class="text-muted fw-light">Sewing /</span> Output</h4>
        <!-- DataTable with Buttons -->
        <button type="button" class="btn btn-primary float-right open-modal" id="machineId">
            <span class="fa fa-plus me-2"></span>New Machine
        </button>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4 border">
                <div class="card-title fw-bold fs-5">Summary</div>
                <!-- Adjusted the height of the card-datatable to auto to fit the table's content -->
                <div class="card-datatable table-responsive pt-3" style="height: auto;">
                    <table class="table table-responsive table-striped table-hover" id="datatable">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Style</th>
                                <th>Total Size</th>
                                <th>Total Output</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lygSewingOutput as $m)
                                <tr style="cursor: pointer;">
                                    <td>{{ $m->date }}</td>
                                    <td>{{ $m->style }}</td>
                                    <td>{{ $m->totalsize }}</td>
                                    <td>{{ $m->totaloutput }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-xs btn-edit" onclick="getData('{{ $m->date }}', '{{ $m->style }}')">
                                            <i class="fa fa-eye"></i>&nbsp;View Detail
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><br><br><br>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4 border">
                <div class="card-title fw-bold fs-5" id="txt-style"></div>
                <!-- Adjusted the height of the card-datatable to auto to fit the table's content -->
                <div class="card-datatable table-responsive pt-3" style="height: auto;" id="data-tabel-rekap">
                </div>
            </div>
        </div>
    </div>
</div>
        <script>
            function getData(date,style) {
                // console.log(date)
            $('#txt-style').text(style+ ' #'+date);
            var modalData = $('#mdl_table').serialize();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            // Set the CSRF token as a default request header
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            // Kosongkan data tabel sebelum melakukan permintaan Ajax
            $("#data-table-body").empty();

            // Tampilkan modal search
            $('#modal_search').modal("show");

            $.ajax({
                url: "{{ asset('sewing/style') }}",
                type: "post",
                data: {
                    date: date,
                    style: style
                },
                success: function(data) {
                    if(data == ''){
                    alert('Tidak ada data');
                    } 
                    else{
                        $("#data-tabel-rekap").html(data);                                                     
                    }
                },
                error: function(xhr, text) {
                    $("#modal_search").modal('hide')
                    Swal.fire(String(xhr.responseJSON.code), String(xhr.responseJSON
                            .message),
                        'error')


                    console.log((xhr)); // Tampilkan pesan error dalam konsol
                    console.log(text); // Tampilkan pesan error dalam konsol
                }
            });

                
            }
            // function save() {
            //     var formData = $('#form-data').serialize();
            //     swAlertConfirm('{{ route('machine.store') }}', undefined, undefined, formData);
            //     $('#modal-form').modal('hide'); // Menutup modal setelah tombol "Save" diklik
            // }

            // function deleted() {
            //     var row = event.target.closest("tr");
            //     var machine_id = row.cells[0].innerText;
            //     var formData = {
            //         'machine_id': machine_id
            //     };

            //     swAlertConfirm(`{{ route('machine.delete') }}`, undefined, undefined, formData);
            // }


            // $(document).ready(function() {

            //     $('.open-modal').click(function() {
            //         $('#modal-form').modal('show');
            //     });

            //     // Event handler untuk tombol edit
            //     $('.btn-edit').click(function() {
            //         $('#modal-form').modal('show');
            //         var row = $(this).closest('tr');
            //         var id = row.find('td:nth-child(1)').text();
            //         var name = row.find('td:nth-child(2)').text();
            //         var serialnumber = row.find('td:nth-child(3)').html();
            //         var location = row.find('td:nth-child(4)').html();
            //         var dept = row.find('td:nth-child(5)').html();
            //         var table = row.find('td:nth-child(6)').html();

            //         $(".btn-save").html("Update")


            //         $('#machine_id').val(id);
            //         $('#machine_name').val(name);
            //         $('#serial_number').val(serialnumber);
            //         $('#location').val(location);
            //         $('#select2Multiple').val(dept).trigger('change');
            //         $('#table_name').val(table);
            //     });

            //     $('.btn-save').click(function() {
            //         $('#modal-form').modal('hide');
            //     });

            //     $('#modal-form').on('hidden.bs.modal', function() {
            //         if (!$('.btn-edit').hasClass('modal-open')) {
            //             resetModal();
            //             $(".btn-save").html("Save");
            //         }
            //     });
            // });
        </script>
    @endsection
