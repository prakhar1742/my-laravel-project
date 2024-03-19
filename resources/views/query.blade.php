<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Query</title>
</head>
<body>
    <form method="get" action="{{url('/ping')}}">
        @csrf
        <input type="text" name="param"/>
        <input type="submit" value="search"/>
</form>
    
</body>
</html>