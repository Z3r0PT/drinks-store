<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<body style="background-color: #8c8c8c">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{url('/store')}}">Happiness Store</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{url('/store')}}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/register')}}">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/login')}}">Login <span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>
<br>
    <div class="container">
        <h4 class="display-5">My Shopping Cart</h4>
        <hr class="my-4">
        <ul class="list-group">
            @foreach($CART as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{str_replace(["[","]","\""], ' ',$item->pluck('name'))}}
                    <span class="badge badge-primary badge-pill">{{str_replace(["[","]","\""], ' ',$item->pluck('price'))}}€</span>
                </li>
            @endforeach
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Total price
                <span class="badge badge-primary badge-pill">{{$TOTAL}}€</span>
            </li>
                @if($TOTAL != 0)
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <form action="{{ action('Store@cancel_order') }}" method="get">
                    <button type="submit" class="btn btn-danger">Cancel order</button>
                    </form>

                    <form action="{{ action('Store@order_items') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="total" value="{{$TOTAL}}">
                    <button type="submit" class="btn btn-primary">Order items</button>
                    </form>
                        @endif
                </div>
        </ul>

    </div>
</body>
</html>