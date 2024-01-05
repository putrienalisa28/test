@section('title', 'List Of Rencana Tpm')
@extends('layouts.main')

@section('content')
    <style>
        /* Custom Styles */
        .tree-table {
            font-family: Arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        .tree-table td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        .tree-table .level-1 td {
            padding-left: 20px;
        }

        .tree-table .level-2 td {
            padding-left: 40px;
        }

        .tree-table .level-3 td {
            padding-left: 60px;
        }
    </style>


    <div class="container-fluid flex-grow-1 container-p-y">

        <div class="row g-4">
            <div style="display: flex; justify-content: space-between; align-items: center;" class="mb-3">
                <h4 class="fw-bold py-1 mb-2">
                    <span class="text-muted fw-light">Maintenance /</span> Rencana TPM
                </h4>
            </div>
            <!-- DataTable with Buttons -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card p-4">
                        <div class="row">
                            <div class="col-md-6">
                                {!! showAlert('warning', 'Reminder 1 : Notifikasi dikirim ke PIC PM & Stock') !!}
                            </div>
                            <div class="col-md-6">
                                {!! showAlert('warning', 'Reminder 1 : Notifikasi dikirim ke PIC Stock, PIC PM, PIC Produksi') !!}
                            </div>
                        </div>
                        {{-- <div class="card-datatable table-responsive pt-3" style="height: 700px;"> --}}
                        <div class="table table-responsive table-bordered table-striped table-hover text-nowrap pt-3"
                            style="height: 520px;">
                            <table class="tree-table">
                                <tbody>
                                    @foreach ($listRencanaTpm->groupBy('machine_id') as $key => $rtpmGrouped)
                                        <tr>
                                            <td colspan="3" class="bold">
                                                {{ $rtpmGrouped->first()->machine->machine_name }}</td>
                                        </tr>
                                        <tr class="level-1">
                                            <td colspan="3">List Of Sparepart</td>
                                        </tr>
                                        @php
                                            $listSparepartUnique = $rtpmGrouped->flatMap->rencanaTpmDetail->unique('sparepart_id');
                                        @endphp
                                        @foreach ($listSparepartUnique as $sparepart)
                                            <tr class="level-2">
                                                <td>
                                                    <i class="fa fa-chevron-right"></i>
                                                    {{ $sparepart->sparepart->item_name . ' : ' . $sparepart->sparepart->spare_part_no }}
                                                </td>
                                                <td class="status-stock">

                                                    @if ($sparepart->status_stock == null)
                                                        <button class="btn btn-xs btn-primary btn-confirmStatus"
                                                            data-id="{{ $sparepart->sparepart->id }}"
                                                            data-machineId="{{ $rtpmGrouped->first()->machine->machine_id }}"
                                                            value="" data-target="#editRoleModal">
                                                            <i class=""></i>&nbsp;Click to confirm stock
                                                        </button>
                                                    @else
                                                        {!! getConditionIcon($sparepart->status_stock) !!}
                                                        {{ $sparepart->status_stock == 1 ? 'Stock Ready' : 'Stock Not Ready' }}
                                                    @endif
                                                </td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                    @endforeach

                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalConfirmStatus" tabindex="-1" aria-hidden="true" \>
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="lable">Create New Interval Detail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-success btn-block w-100 btn-ready"><span class="ti ti-check"></span>
                                    &nbsp;Ready</button>
                            </div>
                            <div class="col">
                                <button class="btn btn-danger btn-block w-100 btn-notReady"><span
                                        class="ti ti-x"></span>&nbsp;Not
                                    Ready</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Add Role Modal -->

        <!-- / Add Role Modal -->
    </div>
    <script>
        $(document).ready(function() {
            $('.tree-table').treeTable();
        });

        $(".btn-confirmStatus").click(function() {
            $('#modalConfirmStatus').modal('show');
            var spareaPartId = $(this).data('id');
            var machineId = $(this).data('machineid');
            $('.btn-ready').attr('onclick',
                `confirmStatus(${spareaPartId},${machineId},1)`);
            $('.btn-notReady').attr('onclick', `confirmStatus(${spareaPartId},${machineId},2)`);

        })

        function confirmStatus(spareaPartId, machineId, statusStock) {

            var data = {
                sparepart_id: spareaPartId,
                machine_id: machineId,
                status_stock: statusStock
            };


            $.ajax({
                type: "post",
                url: "{{ route('rencanatpm.confirmStatusSparepart') }}",
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                beforeSend: function() {
                    var btn = '';
                    if (statusStock == 1) {
                        btn = '.btn-ready';
                    } else {
                        btn = '.btn-notReady';
                    }
                    $(`${btn}`).attr('disabled', true);
                    $(`${btn}`).html(
                        '<span class="spinner-border me-1" role="status" aria-hidden="true"></span>Loading...'
                    );
                },
                success: function(response) {
                    if (response.code != 200) {
                        swal("Error", response.message, "error");
                        return false;
                    }
                    if (response.code == 200) {
                        $('#modalConfirmStatus').modal('hide');
                        $('.btn').removeAttr('disabled', '');
                        $('.btn-ready').html('<span class="ti ti-check"></span>&nbsp;Ready');
                        $('.btn-notReady').html('<span class="ti ti-x"></span>&nbsp;Not Ready');
                        var row = $(`.btn-confirmStatus[data-id="${spareaPartId}"]`).closest(
                            'tr');
                        row.find('.status-stock').html(statusStock == 1 ?
                            '<i class="fa fa-check-circle text-success"></i> Stock Ready' :
                            '<i class="fa fa-times-circle text-danger"></i> Stock Not Ready');
                    }

                },
                Error: function(xhr) {
                    console.log(xhr);
                    swal("Error", xhr.responseJson.message, "error");
                    return false;
                }
            });

        }
    </script>
@endsection
