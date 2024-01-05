@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')

    <div class="container-fluid flex-grow-1 container-p-y">
        <div style="display: flex; justify-content: space-between; align-items: center;" class="mb-3">
            <h4 class="fw-bold py-1 mb-2">
                <span class="text-muted fw-light">Master /</span> Sparepart
            </h4>
            <button type="button" class="btn btn-primary float-right open-modal" id="machineId"><span
                    class="fa fa-plus me-2"></span>New Sparepart</button>
        </div>

        <!-- DataTable with Buttons -->
        <div class="row">
            <div class="col-md-12">
                <div class="card p-4">
                    {{-- <div class="card-datatable table-responsive pt-3" style="height: 700px;"> --}}
                    <div class="table-responsive text-nowrap pt-3" style="height: 700px;">
                        <table class="table table-responsive table-striped table-hover" id="datatable"
                            style="font-size: 11px;">
                            <thead>

                                <tr>
                                    <th hidden>No</th>
                                    <th>Item ID</th>
                                    <th>Item Name</th>
                                    <th>Doc. No</th>
                                    <th>Interval (h)</th>
                                    <th>Actual Interval (h)</th>
                                    <th>Spare Part Number</th>
                                    <th>Tag</th>
                                    <th>Machine</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sparepart as $s)
                                    <tr>
                                        <td hidden>{{ $s->id }}</td>
                                        <td>{{ $s->item_id }}</td>
                                        <td>{{ $s->item_name }}</td>
                                        <td>{{ $s->doc_no }}</td>
                                        <td>{{ $s->interval }}</td>
                                        <td>{{ $s->actual_interval }}</td>
                                        <td>{{ $s->spare_part_no }}</td>
                                        <td>
                                            @php
                                                $tagData = json_decode($s->tag);
                                            @endphp
                                            @if (is_array($tagData))
                                                @foreach ($tagData as $tag)
                                                    <span
                                                        class="badge bg-danger mb-1">#{{ getCategoryMachineName($tag) }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @foreach ($s['sparepartDtl'] as $sd)
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


                                        <td hidden>{{ $s->tag }}</td>
                                        {{-- <td hidden>
                                            @php
                                                $machineIds = [];
                                                
                                                foreach ($s['sparepartDtl'] as $sd) {
                                                    $machineIds[] = $sd->machine_id;
                                                }
                                                
                                                echo json_encode($machineIds);
                                            @endphp
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-4">
                <div class="card">
                    <h5 class="card-header">Form Input Sparepart</h5>
                    <div class="card-body">
                        
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <div class="modal fade" id="modal-form" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalToggleLabel">Form New Sparepart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6" hidden>
                                <div class="row">
                                    <label for="exampleFormControlInput1"
                                        class="col-sm-4 col-form-label text-sm-end">ID</label>
                                    <div class="col-sm-8">
                                        <input type="text" x-model="id" name="id" id="id"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label for="exampleFormControlInput1" class="col-sm-4 col-form-label text-sm-end">Search
                                        Item</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" x-model="keyWord" name="keyWord" id="keyWord"
                                                placeholder="Enter Keywords" class="form-control" />&nbsp;&nbsp;
                                            <button class="btn btn-primary btn-search" type="button" title="Search Item">
                                                <span class="fas fa-search"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label for="exampleFormControlInput1" class="col-sm-4 col-form-label text-sm-end">Doc.
                                        No</label>
                                    <div class="col-sm-8">
                                        <input type="text" x-model="docNo" name="docNo" id="docNo"
                                            class="form-control" placeholder="Doc. No" id="docNo" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label for="exampleFormControlInput1" class="col-sm-4 col-form-label text-sm-end">Item
                                        ID</label>
                                    <div class="col-sm-8">
                                        <input type="text" x-model="itemNumber" name="itemNumber" id="itemNumber"
                                            placeholder="Item ID" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label for="exampleFormControlInput1"
                                        class="col-sm-4 col-form-label text-sm-end">Interval (h)</label>
                                    <div class="col-sm-8">
                                        <input type="number" x-model="interval" name="interval" id="interval"
                                            placeholder="Interval (h)" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label for="exampleFormControlInput1" class="col-sm-4 col-form-label text-sm-end">Item
                                        Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" x-model="itemName" name="itemName" id="itemName"
                                            placeholder="Item Name" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label for="exampleFormControlInput1"
                                        class="col-sm-4 col-form-label text-sm-end">Actual Interval (h)</label>
                                    <div class="col-sm-8">
                                        <input type="number" x-model="actualInterval" name="actualInterval"
                                            id="actualInterval" placeholder="Actual Intervals" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label for="exampleFormControlInput1"
                                        class="col-sm-4 col-form-label text-sm-end">Spare Part Number</label>
                                    <div class="col-sm-8">
                                        <input type="text" x-model="sparePartNumber" name="sparePartNumber"
                                            id="sparePartNumber" placeholder="Spare Part No." class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label for="select2Multiple" class="col-sm-4 col-form-label text-sm-end">Group of
                                        Category Machine</label>
                                    <div class="col-sm-8">
                                        <select id="select2Multiple" class="select2 form-select" name='tag[]' multiple>
                                            @foreach ($categorymachine as $x)
                                                <option value="{{ $x->machine_category_id }}">
                                                    {{ $x->name_category_mesin }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @foreach ($mastermesin as $y)
                                <div class="col-md-8">
                                </div>
                                <div class="col-md-4">
                                    <input class="form-check-input" type="checkbox" value="{{ $y->machine_id }}"
                                        id="IdMachine" name="IdMachine[]" />
                                    <label class="form-check-label" for="defaultCheck3"> {{ $y->machine_name }} </label>
                                </div>
                            @endforeach
                        </div><br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary me-sm-3 me-1 btn-save"
                                onclick="save()">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_search" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalToggleLabel">Form New Sparepart</h5>
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

                var id = row.find('td:nth-child(1)').text();
                var itemNumber = row.find('td:nth-child(2)').text();
                var itemName = row.find('td:nth-child(3)').text();
                var docNo = row.find('td:nth-child(4)').text();
                var interval = row.find('td:nth-child(5)').text();
                var actualInterval = row.find('td:nth-child(6)').text();
                var sparePartNumber = row.find('td:nth-child(7)').text();
                var group = row.find('td:nth-child(11)').html();
                var machineId = row.find('td:nth-child(12)').html();

                $('.btn-save').html('Update');

                $('#id').val(id);
                $('#itemNumber').val(itemNumber);
                $('#itemName').val(itemName);
                $('#docNo').val(docNo);
                $('#interval').val(interval);
                $('#actualInterval').val(actualInterval);
                $('#sparePartNumber').val(sparePartNumber);

                var selectElement = $('#select2Multiple');
                selectElement.val(null).trigger('change'); // Menghapus opsi yang dipilih sebelumnya

                var options = selectElement.find('option');
                options.each(function() {
                    var optionValue = $(this).val();
                    var optionText = $(this).text();
                });

                var data = JSON.parse(group);
                data.forEach(function(item) {
                    var option = new Option(item, item);
                });

                selectElement.val(data).trigger('change');
                $("input[type=checkbox]").removeAttr("checked", "");

                var jsonMachineId = JSON.parse(machineId);
                jsonMachineId.forEach(function(item) {
                    $("input[value=" + item + "]").attr("checked", "checked");
                });

                // Menutup modal setelah tombol "Update" diklik
                $('.btn-save').click(function() {
                    $('#modal-form').modal('hide');
                });
            });


            // Event handler untuk tombol search
            $('.btn-search').off('click').on('click', function() {
                var keyword = $('#keyWord').val();
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
                    url: "{{ route('sparepart.getItemMySamin') }}/",
                    type: "post",
                    data: {
                        keyword: keyword
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
                        // Menghapus elemen loading setelah permintaan Ajax berhasil
                        $("#loading-row").remove();

                        // Kode lainnya untuk menampilkan data yang diterima
                        var tableBody = $("#data-table-body");
                        // var parsedData = JSON.parse(data);
                        // console.log  (data.result);
                        var i = 1;
                        data.result.forEach(function(item) {
                            var btn_choose = '';
                            btn_choose = `<button type="button" class="btn btn-primary me-sm-3 me-1 btn-choose"
                            onclick="Choose($(this).closest('tr'))">Choose</button>`;
                            var row = $("<tr></tr>");
                            row.append("<td class='text-center'>" + i + "</td>");
                            row.append("<td>" + item.ItemName + "</td>");
                            row.append("<td class='text-center'>" + item.ItemID +
                                "</td>");
                            row.append("<td class='text-center'>" + btn_choose +
                                "</td>");
                            i++;
                            tableBody.append(row);
                        });
                    },
                    error: function(xhr, text) {

                        // Menghapus elemen loading jika terjadi kesalahan pada permintaan Ajax
                        // $("#loading-row").remove();
                        $("#modal_search").modal('hide')
                        // swAlert('error', String(xhr.responseJSON.message), xhr.responseJSON
                        // .code);
                        Swal.fire(String(xhr.responseJSON.code), String(xhr.responseJSON
                                .message),
                            'error')


                        console.log((xhr)); // Tampilkan pesan error dalam konsol
                        console.log(text); // Tampilkan pesan error dalam konsol
                    }
                });
            });

            // Event handler untuk tombol hapus
            // $('.btn-hapus').click(function() {
            //     var row = $(this).closest('tr');
            //     var id = row.find('td:first-child')
            //         .text(); // Mengambil nilai ID dari kolom pertama pada baris

            //     // Permintaan Ajax untuk menghapus data dari database
            //     if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
            //         $.ajax({
            //             url: "{{ route('sparepart.delete') }}/",
            //             type: "get",
            //             data: {
            //                 id: id
            //             },
            //             success: function(response) {
            //                 // Hapus baris dari tabel jika penghapusan berhasil
            //                 row.remove();
            //                 console.log("Data berhasil dihapus");
            //             },
            //             error: function(xhr, textStatus, errorThrown) {
            //                 console.log("Terjadi kesalahan saat menghapus data:", errorThrown);
            //             }
            //         });
            //     }
            // });

        });

        function save() {
            var formData = $('#form-data').serialize();
            swAlertConfirm('{{ route('sparepart.store') }}', undefined, undefined, formData);
            $('#modal-form').modal('hide'); // Menutup modal setelah tombol "Save" diklik
        }

        function deleted() {
            var row = event.target.closest("tr");
            var sparepart_id = row.cells[0].innerText;
            var formData = {
                'sparepart_id': sparepart_id
            };

            swAlertConfirm(`{{ route('sparepart.delete') }}`, undefined, undefined, formData);
        }


        function Choose(row) {
            var itemName = row.find('td:nth-child(2)').text();
            var itemNumber = row.find('td:nth-child(3)').text();

            $('#itemName').val(itemName);
            $('#itemNumber').val(itemNumber);
            $('#modal_search').modal('hide');
        }
    </script>
@endsection
