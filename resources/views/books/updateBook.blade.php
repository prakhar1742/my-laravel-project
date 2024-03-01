<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Found</title>
    <form  action="{{Route('')}}">
        <!-- <input type="text" name="name" value=/> -->
        <!-- @forelse ($book as $b)
        {{$b->title}}

        @empty <h2>No user </h2>
    @endforelse -->
    {{session()->get("username")}}
    @forelse($book as $b)
        Title:<input type="text" value="{{$b->title}}" name="name"/><BR/>
        Author:
        <input type="text" value="{{$b->author}}" name="author"/><br/>
        Published Year: <input type="number" value="{{$b->published_year}}" name="published_year"/>

    
    @empty No such user
    @endforelse
</form>
</head>
<body>
    
</body>
</html>