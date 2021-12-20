@extends('adminlte::page')

@section('content')
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="{{asset('/vendor/adminlte/dist/img/Wallet2022Logo.png')}}" height="60px"
                 width="80px"/>
        </div>
    </div>

    <table id="productsTable" class="table table-responsive-sm table-striped">
        <thead>
        <tr>
            <th>Lp.</th>
            <th>Name</th>
        </tr>
        </thead>
    </table>
@endsection
@section('js')
    <script>
        var productsTable =         $("#productsTable").DataTable({
            paging: true,
            lengthChange: false,
            searching: false,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,
            columns: [
                {data:'id'},
                {data:'name'},
            ],
            ajax: {
                url: '/getAllProducts',
                type: 'GET',
                dataType: 'json',
                success: function(products)
                {
                    productsTable.rows.add(products).draw();
                }
            }
        });
    </script>

@endsection
