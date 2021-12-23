@extends('adminlte::page')
@section('content')
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="{{asset('/vendor/adminlte/dist/img/Wallet2022Logo.png')}}" height="60px"
                 width="80px"/>
        </div>
    </div>

    <table id="shoppingTable" class="table table-responsive-sm table-striped">
        <thead>
        <tr>
            <th>Lp.</th>
            <th>Name</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
        </thead>
    </table>
    <div class="modal fade" id="viewShoppingModal" tabindex="-1" role="dialog" aria-labelledby="BillNameLabel"
         aria-hidden="true">

        <div class="modal-dialog " role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title ShoppingNameLabel" ></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-responsive-sm table-striped" style="width: 100%">
                        <tbody>
                        <tr>
                            <td><label>Name</label></td>
                            <td class="ShoppingNameLabel"></td>
                        </tr>
                        <tr>
                            <td><label>Products</label></td>
                            <td  class="ShoppingProductsList"></td>
                        </tr>
                        <tr>
                            <td><label>Total:</label></td>
                            <td class="ShoppingTotal"></td>
                        </tr>
                        </tbody>
                    </table>
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
        var shoppingTable = $("#shoppingTable").DataTable({
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
                    data: 'total', render: function (data, type, row) {
                        return data + "&nbsp;zł";
                    }
                },
                {
                    data: null, render: function () {
                        return '<button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#viewShoppingModal"><i class="fas fa-eye"></i> View</button>';
                    }
                }


            ],
            ajax: {
                url: '/getAllShopping',
                type: 'GET',
                dataType: 'json',
                success: function (shopping) {
                    shoppingTable.rows.add(shopping).draw();
                }
            },
        });
        $("#shoppingTable tbody").on('click', 'button', function (e) {
            $("#viewShoppingModal table  label").addClass('badge badge-dark');
            e.preventDefault();
            var data = shoppingTable.row($(this).parents('tr')).data();
            console.log(data);
            $(".ShoppingNameLabel").html(data.name);
            let items = data.items;
            for(let i = 0; i< items.length;i++)
            {
                 let dom = "<pre>" + items[i].name + "&nbsp;" + items[i].price + " zł</pre>";
                $(".ShoppingProductsList").append(dom);
            }
            let total = data.total;
            $(".ShoppingTotal").html(total + "&nbsp;zł");

        })
    </script>
@endsection
