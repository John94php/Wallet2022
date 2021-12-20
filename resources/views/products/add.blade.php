@extends('adminlte::page')
@section('content')
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="{{asset('/vendor/adminlte/dist/img/Wallet2022Logo.png')}}" height="60px"
                 width="80px"/>
        </div>
    </div>
    <a href="{{route('products.index')}}" class="btn btn-outline-dark m-1"><i class="fas fa-arrow-alt-circle-left"></i> Go back</a>
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Add new product</h3>
        </div>
        <div class="card-body">
            <form id="addProductForm" class="form-group">
                @csrf
                <label class="badge bg-gradient-gray-dark" for="product_name">Name of category</label>
                <input type="text" class="form-control-plaintext border border-width-2" name="product_name">
                <button type="submit" class="btn btn-outline-info">Submit</button>
            </form>

        </div>
    </div>

@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#addProductForm").on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: '/saveProduct',
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

        })
    </script>
@endsection
