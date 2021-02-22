<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Post</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand">DAW Forum</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{url('/blog')}}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" >Welcome {{$NAME}}</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{url('/logout')}}">Logout</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
<div class="jumbotron">
    @if($OPEN == 0)
    <form action="{{url('/addPost')}}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="Insertpost"></label>
            <textarea class="form-control" id="Insertpost" name="Insertpost" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Go</button>
        <button type="button" class="btn btn-danger">Cancel</button>
    </form>
    @endif
    @if($OPEN == 1)
    <form action="{{url('/update_action')}}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="Updatepost"></label>
            <textarea class="form-control" id="Updatepost" name="Updatepost" rows="5">{{$CONTENT}}</textarea>
            <input type="hidden" id="post_id" name="post_id" value="{{$post_id}}">
        </div>
        <button type="submit" class="btn btn-success">Go</button>
        <button type="button" class="btn btn-danger">Cancel</button>
    </form>
    @endif
</div>
</body>
</html>