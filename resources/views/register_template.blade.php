<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<body style="background-color: #4b4743">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" style="color: #fcf88e" href="{{url('/store')}}">Happiness Store</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" style="color: #969547" href="{{url('/store')}}">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color: #969547" href="{{url('/register')}}">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color: #969547" href="{{url('/login')}}">Login</a>
            </li>
        </ul>
    </div>
</nav>
<br>
@if($check == 1)
<div class="alert alert-dismissible alert-danger">
    <h4 class="alert-heading">Warning!</h4>
    <p class="mb-0">{{$ERROR}}</p>
</div>
@endif
<form action="{{ action('Store@register_action') }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="container">
        <div class="form-group">
            <label for="Name" style="color: #fcf88e">Name:</label>
            <textarea class="form-control" id="Name" name="Name" rows="1" placeholder="Enter name" required>{{$NAME}}</textarea>
        </div>
        <div class="form-group">
            <label for="Email" style="color: #fcf88e">Email:</label>
            <input type="email" class="form-control" id="Email" name="Email" aria-describedby="email" placeholder="Enter email" value="{{$EMAIL}}" required>
        </div>
        <div class="form-group">
            <label for="Password" style="color: #fcf88e">Password:</label>
            <input type="password" class="form-control" id="Password" name="Password" placeholder="Enter Password" required>
        </div>
        <div class="form-group">
            <label for="Password_Confirm" style="color: #fcf88e">Password:</label>
            <input type="password" class="form-control" id="Password_Confirm" name="Password_Confirm" placeholder="Enter Password Again" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-danger">Clear</button>
    </div>
</form>
</body>
</html>