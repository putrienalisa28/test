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
        @foreach ($transaction as $data)
            <tr style="cursor: pointer;">
                <td>{{ $data->operator_name }}</td>
                @foreach ($nametable as $name)
                    <td>{{ $data->{'size_'.$name->size_name} }}</td>
                @endforeach
                <td class="text-center">{{ $data->totalqty }}</td>
                <td>{{ $data->Destination }} {{ 'HK' == $data->Destination ? '(Hongkong)' : '(Singapore)' }}</td>
                <td>
                    <button type="button" class="btn btn-primary btn-xs btn-edit" onclick="getData('{{ $data->style }}')">
                        <i class="fa fa-edit"></i>&nbsp;Edit
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

