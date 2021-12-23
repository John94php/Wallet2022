@extends('adminlte::page')
@section('content')
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="{{asset('/vendor/adminlte/dist/img/Wallet2022Logo.png')}}" height="60px"
                 width="80px"/>
        </div>
    </div>

    <table id="billsTable" class="table table-responsive-sm table-striped">
        <thead>
        <tr>
            <th>Lp.</th>
            <th>Name</th>
            <th>Category</th>
            <th>Amount</th>
            <th>Month</th>
            <th>Payment Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
    </table>
    <div class="modal fade" id="editBillModal" tabindex="-1" role="dialog" aria-labelledby="BillNameLabel"
         aria-hidden="true">

        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="BillNameLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="table table-responsive-sm">
                        <table class="table table-striped">
                            <tr>
                                <td>
                                    Name
                                </td>
                                <td><input type="text" id="billName" class="form-control"/></td>
                                <td>
                                    <button class="btn btn-outline-warning btn-sm">Save</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Category</td>
                                <td id="billCategory">
                                    <select name="billCategory" id="billCategorySelect" class="form-control">

                                    </select>
                                </td>
                                <td>
                                    <button class="btn btn-outline-warning btn-sm">Save</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Amount</td>
                                <td><input type="text" id="billAmount" class="form-control"/></td>
                                <td>
                                    <button class="btn btn-outline-warning btn-sm">Save</button>
                                </td>

                            </tr>
                            <tr>
                                <td>Payment date</td>
                                <td>
                                    <input id="payment_date" name="payment_date" data-target="#payment_date"
                                           data-toggle="datetimepicker" class="form-control datetimepicker">
                                </td>
                                <td>
                                    <button class="btn btn-outline-warning btn-sm">Save</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        var billsTable = $("#billsTable").DataTable({
            paging: true,
            lengthChange: false,
            searching: false,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,
            columns: [
                {data: 'id'},
                {data: 'name'},
                {
                    data: 'category', render: function (data, type) {
                        let name = '';
                        if (data == 1) {
                            name = 'Czynsz';
                        } else if (data == 2) {
                            name = 'Play';
                        } else if (data == 3) {
                            name = 'Prąd';
                        } else if (data == 4) {
                            name = 'UPC';
                        } else if (data == 5) {
                            name = 'Karta miejska';
                        } else if (data == 6) {
                            name = 'Karta Kredytowa';
                        } else if (data == 7) {
                            name = 'Rata za telefon';
                        }
                        return '<span class="badge bg-dark">' + name + '</span>';
                    }
                },
                {
                    data: 'amount', render: function (data, type, row) {
                        return data + "&nbsp;zł";
                    }
                },
                {data: 'month'},
                {data: 'payment_date'},
                {
                    data: 'status', render: function (data, type) {
                        let name = '';
                        let color = 'info';
                        if (data == 1) {
                            name = 'Wprowadzony'
                            color = 'info';
                        } else if (data == 2) {
                            name = 'Zbliża się termin zapłaty';
                            color = 'warning';
                        } else if (data == 3) {
                            name = 'Zapłacono';
                            color = 'success';
                        } else if (data == 4) {
                            name = 'Termin przekroczony';
                            color = 'danger';

                        }
                        return '<span class="badge bg-' + color + '">' + name + '</span>';
                    }
                },
                {
                    data: null, render: function () {
                        return '<button type="button" class="btn btn-sm btn-outline-warning" data-toggle="modal" data-target="#editBillModal"><i class="fas fa-edit"></i> Edit</button><button class="btn btn-sm btn-outline-success">Mark as paid</button>';
                    }
                }


            ],
            ajax: {
                url: '/getAllBills',
                type: 'GET',
                dataType: 'json',
                success: function (bills) {
                    billsTable.rows.add(bills).draw();
                }
            },
        });
        $("#billsTable tbody").on('click', 'button', function (e) {
            e.preventDefault();
            var data = billsTable.row($(this).parents('tr')).data();
            let name = data.name;
            let amount = data.amount;
            let payemnt_date = data.payment_date;
            $("#payment_date").datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $("#payment_date").val(payemnt_date);
            $("#billName").val(name);
            $("#BillNameLabel").html(name);
            $("#billAmount").val(amount);
            $.ajax({
                url: '/getAllCategories',
                dataType: 'json',
                success: function (category) {
                    let i;
                    for (i = 0; i < category.length; i++) {
                        $("#billCategorySelect").append('<option id=' + category[i].id +'>' + category[i].name + '</option>');
                    }
                }
            })

        })
    </script>
@endsection
