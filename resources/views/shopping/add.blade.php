@extends('adminlte::page')
@section('content')
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="{{asset('/vendor/adminlte/dist/img/Wallet2022Logo.png')}}" height="60px"
                 width="80px"/>
        </div>
    </div>
    <a href="{{route('shopping.index')}}" class="btn btn-outline-dark m-1"><i class="fas fa-arrow-alt-circle-left"></i>
        Go
        back</a>
    <div class="card-body">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Add new shopping bill</h3>
            </div>
            <div class="card-body">
                <form id="shoppingBilForm" class="form-horizontal">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input name="name" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group-row">
                        <label class="col-sm-2 col-form-label"><strong>Products:</strong></label>

                        <div class="col-sm-10">
                            <div class="button-group float-right">
                                <button class="btn btn-sm btn-success addProductBtn"><i class="fas fa-plus"></i>Add new
                                    product
                                </button>
                                <button class="btn btn-sm btn-danger removeLastItem"><i class="fas fa-ban"></i>Remove
                                    last item
                                </button>
                            </div>

                        </div>
                    </div>
                    <div class="form-group-row">
                        <table class="table table-responsive-sm" id="shoppingTable">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Pieces</th>
                                <th>Price</th>
                                <th>Sum</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="data0">
                                <td><input type="text" name="items[0][name]" class="form-control" required/></td>
                                <td><input type="number" name="items[0][piece]" class="form-control piece" required/>
                                </td>
                                <td>
                                    <input type="text" name="items[0][price]" class="form-control amount"
                                           required/>
                                </td>
                                <td><p class="form-control-plaintext shoppingsum0"></p></td>
                            </tr>
                            </tbody>
                        </table>

                    </div>

                    <div class="card-footer">
                        <div class="float-right">
                            <label>Sum:</label>
                            <span  id="shoppingSum" class="badge badge-dark"></span>
                        </div>
                        <input type="hidden" name="total" class="form-control-plaintext"></div>


                    <button type="submit" class="btn btn-success">Submit</button>

                </form>

            </div>
        </div>


    </div>

@endsection
@section('js')
    <script type='text/javascript'
            src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

    <script>
        $(document).ready(function () {
            $(".amount").inputmask(
                {
                    'alias': 'currency',
                    'prefix': '',
                    'suffix': ' zł'
                }
            );
            $(".amount").change(function () {
                let amount = parseFloat($(this).val());
                let piece = $("tr.data" + 0 + "").find(".piece").val();
                let total = amount * piece;
                $(".shoppingsum" + 0).html(total + " zł");
                $("#shoppingSum").html(total + "zł");
                // $(this).parent('td').closest('.shoppingsum').html(total);
            })

            $(".addProductBtn").each(function (index) {

                index = 1;
                $(this).on('click', function (e) {


                    e.preventDefault();

                    $("table tbody").append('<tr class="data' + index + '" >' +
                        '<td><input type="text" name="items[' + index + '][name]" class="form-control" /></td>' +
                        '<td><input type="text" name="items[' + index + '][piece]" class="form-control piece" /></td>' +
                        '<td><input type="text" name="items[' + index + '][price]" class="form-control amount"/>' +
                        '<td><p class="form-control-plaintext shoppingsum' + index + '" ></p></td>' +
                        '</td>' +
                        '</tr>');
                    $(".amount").change(function () {
                        let amount = parseFloat($(this).val());
                        let piece = $("tr.data" + index + "").find(".piece").val();
                        let total = amount * piece;
                        $(".shoppingsum" + index).html(total + " zł");
                        let sum = $("#shoppingSum").text();
                        let summary = parseFloat(sum) + total
                        $("#shoppingSum").html(summary + "&nbsp;zł");
                    })

                    $(".amount").inputmask(
                        {
                            'alias': 'currency',
                            'prefix': '',
                            'suffix': ' zł'
                        }
                    );


                })
                // index++

            });
            var formatter = new Intl.NumberFormat('pl-PL', {
                style: 'currency',
                currency: 'PLN'
            });

            $("#shoppingBilForm").on('submit', function (e) {
                e.preventDefault();

                // $.ajax({
                //     url: '/saveShopping',
                //     type: 'POST',
                //     data: $(this).serializeArray(),
                //     success: function (data) {
                //         Swal.fire({
                //             type: data.icon,
                //             title: data.title,
                //             html: data.message,
                //             timer: 3000,
                //             showConfirmButton: false
                //         })
                //     }
                // })


            })

        })

    </script>
@endsection
