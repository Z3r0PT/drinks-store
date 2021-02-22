<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$NAME}} profile</title>
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
        </ul>
    </div>
</nav>
<br>
<form action="{{ action('Store@update_username') }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="user_id" value="{{$USER_ID}}">
    <div class="container">
        <div class="form-group">
            <label for="Name" style="color: #fcf88e">Name:</label>
            <textarea class="form-control" id="Name" name="Name" rows="1" placeholder="Enter name" required>{{$NAME}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-danger">Clear</button>
    </div>
</form>
<p></p>
<form action="{{ action('Store@delete_account') }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="user_id" value="{{$USER_ID}}">
        <div class="container">
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete Account</button>
    </div>
    </div>
</form>
</body>
</html>