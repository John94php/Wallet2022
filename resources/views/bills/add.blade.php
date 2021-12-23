@extends('adminlte::page')
@section('content')
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="{{asset('/vendor/adminlte/dist/img/Wallet2022Logo.png')}}" height="60px"
                 width="80px"/>
        </div>
    </div>
    <a href="{{route('bills.index')}}" class="btn btn-outline-dark m-1"><i class="fas fa-arrow-alt-circle-left"></i> Go
        back</a>
        <div class="card-body">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Add new bill</h3>
                </div>
                <div class="card-body">
                    <form id="addBillForm" class="form-horizontal">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <select name="category" id="billCategory" class="form-control"></select>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="payment_date" class="col-sm-2 col-form-label">Payment date</label>
                            <div class="col-sm-10">
                                <input id="payment_date" name="payment_date" data-target="#payment_date"
                                       data-toggle="datetimepicker" class="form-control datetimepicker"
                                       value="{{date('Y-m-d')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="amount" class="col-sm-2 col-form-label">Amount</label>
                            <div class="col-sm-10">
                                <input type="text" name="amount" id="amount" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select name="status" id="billStatus" class="form-control"></select>

                            </div>
                        </div>
                        <input type="hidden" name="month"/>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>

                </div>
            </div>


        </div>

@endsection
@section('js')
    <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

    <script>

    $(document).ready(function () {
            $("#payment_date").datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $("#payment_date").on('blur', function () {
                const monthNames = ["Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec",
                    "Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień"
                ];

                let date = $(this).val();
                let d = new Date(date);
                $("input[name='month']").val(monthNames[d.getMonth()]);

            })

            $("#addBillForm").on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: '/saveBill',
                    type: 'POST',
                    data: $(this).serializeArray(),
                    success: function (data) {
                        Swal.fire({
                            type: data.icon,
                            title: data.title,
                            html: data.message,
                            timer: 3000,
                            showConfirmButton: false
                        })
                    }
                })
            })

        });
        $.ajax({
            url: '/getAllCategories',
            dataType: 'json',
            success: function (data) {
                let i;
                for (i = 0; i < data.length; i++) {
                    $("#billCategory").append('<option value="' + data[i].id + '">' + data[i].name + '</option>');

                }
            }
        });
        $.ajax({
            url: '/getAllStatuses',
            dataType: 'JSON',
            success: function (data)
            {
                let i;
                for(i = 0; i < data.length;i++)
                {
                    $("#billStatus").append('<option value="' + data[i].id + '">' + data[i].name + '</option>');

                }
            }
        })
    </script>
@endsection
