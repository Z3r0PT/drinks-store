<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orders</title>
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
        </ul>
    </div>
</nav>
<br>
<div class="container">
    <h4 class="display-5">My Orders</h4>
    <hr class="my-4">
    <ul class="list-group">
        @foreach($ORDERS as $order)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{$order->created_at}}
                <span class="badge badge-primary badge-pill">{{$order->total}}€</span>
            </li>
        @endforeach
    </ul>

</div>
</body>
</html>