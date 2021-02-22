<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
@if($check == 1)
<div class="alert alert-dismissible alert-danger">
    <h4 class="alert-heading">Warning!</h4>
    <p class="mb-0">{{$ERROR}}</p>
</div>
@endif
<br>
<form action="{{ action('Store@login_action') }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="container">
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" value="{{$EMAIL}}" required>

        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" value="{{$PASSWORD}}" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <label>
            <input type="checkbox"
                   name="autologin" value="1">
        </label>
        Remember me?
    </div>
</form>
</body>
</html>