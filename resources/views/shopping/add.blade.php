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
                <h3 class="card-title">Add new shopping bill</h3>
            </div>
            <div class="card-body">
                <form id="addShoppingBillForm" class="form-horizontal">
                    @csrf
                    <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label"> date</label>
                        <div class="col-sm-10">
                            <input id="date" name="date" data-target="#date"
                                   data-toggle="datetimepicker" class="form-control datetimepicker"
                                   value="{{date('Y-m-d')}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="amount" class="col-sm-2 col-form-label">Amount</label>
                        <div class="col-sm-10">
                            <input type="text" name="total" id="amount" class="form-control">
                        </div>
                    </div>
                    <input type="hidden" name="month"/>
                    <div class="form-group row">
                        <label for="shopcat_id"  class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                            <select name="shopcat_id" id="shopcat" class="select2 form-control" style="width: 100%">
                            </select>

                        </div>

                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>

            </div>
        </div>


    </div>

@endsection
@section('js')
    <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script>
        $(document).ready(function() {
            //$(".select2").select2();

            $.ajax({
                url: '/getAllShopCat',
                dataType: 'json',
                success: function (data)
                {
                    let i;
                    for(i =0; i < data.length;i++)
                    {
                        let icon = '<i class="'+data[i].icon+'"></i>';
                        $("#shopcat").append("<option> " +  icon +     data[i].name +  "</option>");
                    }
                }
            });
            $("#date").datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $("#date").on('blur', function () {
                const monthNames = ["Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec",
                    "Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień"
                ];

                let date = $(this).val();
                let d = new Date(date);
                $("input[name='month']").val(monthNames[d.getMonth()]);

            })

            $("#addShoppingBillForm").on('submit',function (e) {
                e.preventDefault();

                $.ajax({
                    url: '/saveShopping',
                    type: 'POST',
                    data: $(this).serializeArray(),
                    success: function (data)
                    {
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
        })
    </script>
@endsection
