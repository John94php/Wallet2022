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
        </tr>
        </thead>
    </table>
@endsection
@section('js')
    <script>
        var billsTable =         $("#billsTable").DataTable({
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
                {data: 'category'},
                {data: 'amount'},
                {data: 'month'},
                {data: 'payment_date'},
                {data: 'status'}

            ],
            ajax: {
                url: '/getAllBills',
                type: 'GET',
                dataType: 'json',
                success: function(categories)
                {
                    billsTable.rows.add(categories).draw();
                }
            }
        });
    </script>
@endsection
