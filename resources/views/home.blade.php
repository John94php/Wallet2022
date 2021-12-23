@extends('adminlte::page')

@section('content')
    <section class="content">
        <div class="wrapper">
                <div class="preloader flex-column justify-content-center align-items-center">
                    <img class="animation__wobble" src="{{asset('/vendor/adminlte/dist/img/Wallet2022Logo.png')}}" height="60px" width="80px"/>
                </div>
        </div>
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Dashboard') }}</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-danger with-border shadow-lg">
                        <div class="card-header">
                            <h3 class="card-title">Expenses</h3>
                            <div class="card-tools">
                                <button class="btn btn-tool" type="button" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            Chart 1
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-success with-border shadow-lg">
                        <div class="card-header">
                            <h3 class="card-title">Revenue</h3>
                            <div class="card-tools">
                                <button class="btn btn-tool" type="button" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>
                        <div class="card-body">
                            Chart 2
                        </div>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>100</h3>
                                <p>Total shopping bills</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <a class="small-box-footer" href="#">Show all</a>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box bg-indigo">
                            <div class="inner">
                                <h3 id="countBills"></h3>
                                <p>Total  bills</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-money-bill"></i>
                            </div>
                            <a class="small-box-footer" href="#">Show all</a>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box bg-gradient-danger">
                            <div class="inner">
                                <h3 id="expensesSum"></h3>
                                <p>Sum of Expenses[<i class="fas fa-dollar-sign"></i>]</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-arrow-alt-circle-down"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box bg-gradient-success">
                            <div class="inner">
                                <h3>100</h3>
                                <p>Sum of Revenue[<i class="fas fa-dollar-sign"></i>]</p>
                            </div>
                            <div class="icon">
                                <i class="fas fas fa-arrow-alt-circle-up"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box bg-gradient-success">
                            <div class="inner">
                                <h3 id="productsCount"></h3>
                                <p>Shop items in database</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-shopping-basket"></i>
                            </div>
                            <a class="small-box-footer" href="{{route('products.index')}}">Show all</a>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box bg-gradient-warning ">
                            <div class="inner">
                                <h3 id="categoriesCount"></h3>
                                <p>Categories in database</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-list"></i>
                            </div>
                            <a class="small-box-footer" href="#">Show all</a>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box bg-primary ">
                            <div class="inner">
                                <h3 id="shoppingAmount"></h3>
                                <p>Total amount of shopping bills</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-dollar-sign"></i>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box bg-gradient-warning ">
                            <div class="inner">
                                <h3 id="billsAmount"></h3>
                                <p>Total amount of bills</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-dollar-sign"></i>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                Created by Jan Zalesiński
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>

@endsection
@section('js')
    <script>
        $(document).ready(function () {
          $(".small-box").addClass('shadow-lg card-body');
          $.ajax({
              url: '/countProducts',
              dataType: 'json',
              success: function (data)
              {
                  $("#productsCount").html(data);
              }
          });
          $.ajax({
              url: '/countCategories',
              dataType: 'json',
              success: function (data)
              {
                  $("#categoriesCount").html(data);
              }
          });
          $.ajax({
              url: '/getAllBillsAmount',
              dataType: 'json',
              success: function (data)
              {

                  $("#billsAmount").html(data + "&nbsp;zł");
              }
          });
          $.ajax({
              url: '/getAllShoppingAmount',
              dataType: 'json',
              success: function (data)
              {

                  $("#shoppingAmount").html(parseFloat(data) + "&nbsp;zł")
              }
          });
          $.ajax({
              url: '/countAllExpenses',
              dataType: 'json',
              success: function (data)
              {

                let bills = parseFloat(data.bills);
                let shopping = parseFloat( data.shopping);
                $("#expensesSum").html(bills + shopping +"&nbsp;zł");

              }
          });
          $.ajax({
              url: '/countBills',
              dataType: 'json',
              success: function (data)
              {
                $("#countBills").html(data);
              }
          })

        })
    </script>
@endsection
