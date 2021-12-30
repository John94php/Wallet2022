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
            <th>Category</th>
        </tr>
        </thead>
    </table>


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
                    data: 'category', render: function (data, type, row) {
                        let icon = '';
                        let name = '';
                        if (data == '1') {
                            icon = 'fas fa-hamburger';
                            name = 'Food & drinks';
                        } else if (data == '2') {
                            name = 'Pharmacy'
                            icon = 'fas fa-pills'
                        } else if (data == '3') {
                            icon = 'fas fa-bolt';
                            name = 'Electronic equipment'
                        } else if (data == '4') {
                            icon = 'fas fa-gifts'
                            name = 'Presents / Gifts'
                        } else if (data == '5') {
                            icon = 'fas fa-gamepad'
                            name = 'Entertaiment'
                        } else if (data == '6') {
                            icon = 'fas fa-bus-alt'
                            name = 'Public transport'
                        }
                        return '<i class="' + icon + ' img-fluid mb-2" ></i>&nbsp;<label class="badge bg-dark">' + name + "</label>";

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
            for (let i = 0; i < items.length; i++) {
                let dom = "<pre>" + items[i].name + "&nbsp;" + items[i].price + " zł</pre>";
                $(".ShoppingProductsList").append(dom);
            }
            let total = data.total;
            $(".ShoppingTotal").html(total + "&nbsp;zł");

        })
    </script>
@endsection
