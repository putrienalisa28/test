@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">
        <div style="display: flex; justify-content: space-between; align-items: center;" class="mb-3">
            <h4 class="fw-bold py-1 mb-2"><span class="text-muted fw-light">Royalty Programming /</span> Input</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card p-4 border">
                    <div class="card-title fw-bold fs-5">Dapatkan Loyalti</div>
                    <div class="modal-body">
                        <form id="form-data">
                            @csrf
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <label for="exampleFormControlInput1" class="form-label">Masukkan ID Card:</label>&nbsp;&nbsp;
                                    <input type="text" x-model="id_card" name="id_card" id="id_card"
                                        placeholder="Enter keyword" class="form-control" />&nbsp;&nbsp;
                                    <button class="btn btn-primary btn-search" type="button" title="Search Value">
                                        <span class="fas fa-search"></span>
                                    </button>
                                </div>
                            </div><br><br>
                            <div class="card-datatable table-responsive pt-3">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>ID CARD</th>
                                            <th>CUSTOMER NAME</th>
                                            <th>EMAIL</th>
                                            <th class="text-center">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data-table-body">
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-form" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalToggleLabel"></h5>
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
                                    <input type="text" x-model="iduser" name="iduser" id="iduser"
                                        class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <label for="exampleFormControlInput1" class="col-sm-4 col-form-label text-sm-end">Choose Item :</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <select x-model="item_id" name="item_id" id="item_id" class="form-control" onchange="getDataItem()">
                                            <option value=""></option>
                                            @foreach ($listOfItem as $x)
                                                <option value="{{ $x->itemid }}">
                                                    {{ $x->item_name }}
                                                </option>
                                            @endforeach
                                          </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <label for="exampleFormControlInput1" class="col-sm-4 col-form-label text-sm-end">Transaction Date :</label>
                                <div class="col-sm-8">
                                    <input type="date" x-model="created_at" name="created_at" id="created_at"
                                        class="form-control"/>
                                </div>
                            </div>
                        </div>
                    </div><br><br>
                    <div class="card-datatable table-responsive pt-3">
                        <table class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th>ITEM ID</th>
                                    <th>ITEM NAME</th>
                                    <th>QTY</th>
                                    <th>PRICE</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody id="data-table-body2">
                            </tbody>
                            <tr class="text-center" style="font-weight: bold;width=100px">
                                <th style="vertical-align: middle;"></th>
                                <th style="vertical-align: middle;">TOTAL</th>
                                <th style="vertical-align: middle;"></th>
                                <th style="vertical-align: middle;" id="amount"></th>
                                <th style="vertical-align: middle;" id="voucher"></th>
                            </tr>
                            <tr class="text-center" style="font-weight: bold;width=100px">
                                <th style="vertical-align: middle;"></th>
                                <th style="vertical-align: middle;" id="th-diskon"></th>
                                <th style="vertical-align: middle;"></th>
                                <th style="vertical-align: middle;" id="diskon"></th>
                                <th style="vertical-align: middle;"></th>
                            </tr>
                            <tr class="text-center" style="font-weight: bold;width=100px">
                                <th style="vertical-align: middle;"></th>
                                <th style="vertical-align: middle;">TOTAL BAYAR</th>
                                <th style="vertical-align: middle;"></th>
                                <th style="vertical-align: middle;" id="last_amount"></th>
                                <th style="vertical-align: middle;"></th>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="button" class="btn btn-primary me-sm-3 me-1 btn-save"
                            onclick="save()">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <script>
        let jumlah_baris = 1;

       $('.btn-search').off('click').on('click', function() {
                var idcard = $('#id_card').val();
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

                $.ajax({
                    url: "{{ asset('test/getdatauser') }}/",
                    type: "post",
                    data: {
                        idcard: idcard
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
                            btn_choose = `<button type="button" class="btn btn-primary me-sm-3 me-1 btn-transaction" 
                            onclick="Transaction(${item.id},'${item.name}')">Transaction</button>`;
                            var row = $("<tr></tr>");
                            row.append("<td>" + i + "</td>");
                            row.append("<td>" + item.id + "</td>");
                            row.append("<td>" + item.name +
                                "</td>");
                            row.append("<td>" + item.email +
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

        function Transaction(id,name) {
                $('#modal-form').modal('show');
                $('#iduser').val(id);
                $('#modalToggleLabel').text('Transaction By '+name);
            }

            function formatRupiah(price) {
                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(price).replace('IDR', 'Rp.');
            }
            function getDataItem() {
                $('#last_amount').text('');
                $('#diskon').text('');
                var itemid = $('#item_id').val();
                var modalData = $('#mdl_table').serialize();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                // $("#data-table-body2").empty();

                $.ajax({
                    url: "{{ asset('test/getitem') }}/",
                    type: "post",
                    data: {
                        itemid: itemid
                    },
                    success: function (data) {
                        console.log(data);
                        var tableBody = $("#data-table-body2");
                        // var jumlah_baris = 1;

                        data.result.forEach(function (item) {
                            var tr = `
                                <tr row="${jumlah_baris}">
                                    <td>${item.itemid}</td>
                                    <td>${item.item_name}</td>
                                    <td>
                                        <input type='number' x-model='qty' name='qty' id='qty_${jumlah_baris}' value='1' class='txt tdjumlah' onkeyup="updateTotal(this)" />
                                    </td>
                                    <td id="new_price2_${jumlah_baris}" hidden>${item.price}
                                        <input type='hidden' x-model='price' name='price' id='price_${jumlah_baris}' value='${item.price}' class='txt' />
                                        </td>
                                    <td id="new_price_${jumlah_baris}">${formatRupiah(item.price)}</td>
                                    <td class='text-center'>
                                        <button type="button" class="btn btn-danger me-sm-3 me-1 btn-transaction" onclick="hapus_kategori(this);">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                            tableBody.append(tr);
                            jumlah_baris++;
                        });

                        updateTotalAmount();
                        $('#item_id').val('');
                    },
                    error: function (xhr, text) {
                        $("#modal_search").modal('hide');
                        Swal.fire(String(xhr.responseJSON.code), String(xhr.responseJSON.message), 'error');
                        console.log((xhr));
                        console.log(text);
                    }
                });
            }
            function hapus_kategori(element) {
                $(element).closest('tr').remove();
            }

            function updateTotalAmount() {
                var totalAmount = 0;

                // Loop through each row in the table
                $('#data-table-body2 tr').each(function () {
                    var priceCell = $(this).find('td:eq(3)'); // Assuming price is in the fourth column (index 3)
                    var price = parseFloat(priceCell.text().replace(/[^0-9.-]+/g, '')); // Remove non-numeric characters
                    totalAmount += price;
                });

                // Display the total amount without rounding decimals
                $('#amount').text(formatRupiah(totalAmount, 2));
                if (totalAmount >= 1000000) {
                    // Update the HTML content using .html() instead of .text()
                    // Also, use template literals for better readability
                    $('#voucher').html(`
                        <button id="voucherButton" type="button" class="btn btn-warning me-sm-3 me-1 btn-transaction" 
                            onclick="Voucher(${totalAmount})">Claim Voucher</button>
                    `);
                } else {
                    // Clear the HTML content if totalAmount is less than 1000000
                    $('#voucher').html('');
                }
            }

            function updateTotal(id) {
                var row = id.closest("tr").getAttribute("row");
                
                var qty = $(`#qty_${row}`).val();
                var price = $(`#price_${row}`).val();
                var total = qty * price;
                $(`#new_price_${row}`).text(formatRupiah(total));
                $(`#new_price2_${row}`).html(`${total} <input type='text' x-model='price' name='price' id='price_${row}' value='${price}' class='txt' />`);
                updateTotalAmount();
                $('#last_amount').text('');
                $('#diskon').text('');
            }

            function Voucher(total){
                var qtydis = total/1000000;
                var diskon = parseInt(qtydis, 10);
                
                var total_bayar = total - (diskon * 10000);
                $('#th-diskon').text('Total Diskon');
                $('#last_amount').text(formatRupiah(total_bayar));
                $('#diskon').text('- '+ formatRupiah(diskon * 10000));
                var voucherButton = document.getElementById('voucherButton');
                voucherButton.disabled = true;
            }


    </script>
@endsection
