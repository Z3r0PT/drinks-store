<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Happiness Store</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link href="{{asset('css/templatemo_style.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
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
            @if($check == 0)
            <li class="nav-item">
                <a class="nav-link" href="{{url('/register')}}">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/login')}}">Login <span class="sr-only">(current)</span></a>
            </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/user_area')}}">{{$NAME}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/logout')}}">Logout <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/orders')}}">My orders <span class="sr-only">(current)</span></a>
                </li>
            @endif
        </ul>
        <a style="float: right" href="{{url('/cart_items')}}"><i class="fa fa-shopping-cart" style="font-size:18px;"></i> ({{$COUNT}})</a>
    </div>
</nav>
<br>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card text-white bg-primary mb-3" style="max-width: 20rem;">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{url('/store')}}" style="color: #1c1c1b"><h6>Categories</h6></a>
                    </li>
                    @foreach($cats as $cat)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{url('/store', ['cat'=>$cat->id])}}" style="color: #1c1c1b;">{{$cat->name}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-10">
            <div class="container">
                <div class="jumbotron">
                    @foreach($products as $product)
                    <div class="card mb-3">
                        <h3 class="card-header">{{$product->name}}</h3>
                        <div class="card-body">
                            <h5 class="card-title">{{$product->description}}</h5>
                        </div>
                        <img src="{{asset($product->image)}}" alt="image" height="100" width="100" />
                        <div class="card-body">
                            <h3>{{$product->price}}€</h3>
                            <a href="{{url('/addtoCart', ['id'=>$product->id])}}" style="color: #2a88bd">Buy Now</a>
                        </div>
                    </div>
                    @endforeach
                        <div class="pagination" style="color: #1f648b;">
                            {{ $products->render() }}
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>