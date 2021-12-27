@extends('adminlte::page')
@section('content')
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="{{asset('/vendor/adminlte/dist/img/Wallet2022Logo.png')}}" height="60px"
                 width="80px"/>
        </div>
    </div>

    <table id="shopcatTable" class="table table-responsive-sm table-striped">
        <thead>
        <tr>
            <th>Lp.</th>
            <th>Name</th>
            <th>Icon</th>
        </tr>
        </thead>
    </table>


@endsection
@section('js')
    <script>
        var shopcatTable = $("#shopcatTable").DataTable({
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
                {data: 'icon',render: function (data) {
                    return "<i class='"+data + " ' style='font-size: 2rem'></i>";
                    }}


            ],
            ajax: {
                url: '/getAllShopCat',
                type: 'GET',
                dataType: 'json',
                success: function (shopping) {
                    shopcatTable.rows.add(shopping).draw();
                }
            },
        });

    </script>
@endsection
