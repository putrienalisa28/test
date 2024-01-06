<span class="text-primary fw-light"><u><strong>DETAIL TRANSACTION:</u><strong></span>
<table class="table table-responsive table-striped table-hover" id="datatable">
    <thead>
        <tr>
            <th rowspan="2">Operator</th>
            <th colspan="{{ count($nametable)}}" class="text-center">Size</th>
            <th rowspan="2">Total Qty</th>
            <th rowspan="2">Destination</th>
            <th rowspan="2">Action</th>
        </tr>
        <tr>
            @foreach ($nametable as $th)
            <th rowspan="2">{{ $th->size_name }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($transaction as $key=>$data)
            <tr style="cursor: pointer;" data-baris="{{ $key+1 }}">
                <td>{{ $data->operator_name }}
                    <input id="operator_name" class="txt" type="hidden" name="operator_name" value="{{ $data->operator_name }}">
                </td>
                @foreach ($nametable as $name)
                    <td class="text-center">
                        <input id="size_name" class="txt" type="hidden" name="detail[size_name][]" value="{{ $name->size_name }}">
                        <input id="qty_output" class="txt" type="text" name="detail[qty_output][]" value="{{ $data->{'size_'.$name->size_name} }}"></td>
                @endforeach
                <td class="text-center">{{ $data->totalqty }}</td>
                <td>{{ $data->Destination }} {{ 'HK' == $data->Destination ? '(Hongkong)' : '(Singapore)' }}
                    <input id="destination_code" class="txt" type="hidden" name="destination_code" value="{{ $data->Destination }}">
                </td>
                <td>
                    <button type="button" class="btn btn-primary btn-xs btn-edit" onclick="save('{{ $key+1 }}')">
                        <i class="fa fa-save"></i>&nbsp;Save
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>

    function save(id) {
        var rowSelector = 'tr[data-baris="' + id + '"]';
        var formData = $(rowSelector + ' input').serialize();
        var formData2 = $('#form-data').serialize();
        swAlertConfirm('{{ asset('sewing/edit') }}', undefined, undefined, formData + '&' + formData2);
    }
    // function save(id) {
        // var rowSelector = 'tr[data-baris="' + id + '"]';
        // var formData = $(rowSelector + ' input').serialize();
        // var formData2 = $('#form-data').serialize();
        //     Swal.fire({
        //         title: 'Are you sure?',
        //         text: "It will be saved!",
        //         showCancelButton: true,
        //         confirmButtonColor: '#30419b',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes, save it!',
        //         showLoaderOnConfirm: true,
        //         preConfirm: () => {
        //             return new Promise((resolve) => {
        //                 $.ajax({
        //                     url: '{{ asset('sewing/edit') }}',
        //                     type: "POST",
        //                     data: formData + '&' + formData2,
        //                     headers: {
        //                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
        //                             'content')
        //                     },
        //                     dataType: "JSON",
        //                     success: function(response) {
        //                         console.log(response);

        //                     },
        //                     error: function(xhr, text) {
        //                         console.log(xhr);
        //                         Swal.fire('Error : ' + String(xhr.responseJSON
        //                                 .code),
        //                             String(xhr
        //                                 .responseJSON
        //                                 .message), 'error');
        //                         // $(".btn-save").attr('disabled', false);
        //                         // $(".btn-save").html('Save');
        //                     }
        //                 });
        //             });
        //         },
        //     }).then((result) => {
        //         if (!result.isConfirmed) {
        //             $(".btn-save").attr('disabled', false);
        //             $(".btn-save").html('Save');
        //         }
        //     });
        // }
</script>

