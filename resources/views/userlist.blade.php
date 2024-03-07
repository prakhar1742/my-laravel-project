<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
        }
        .info {
            margin-bottom: 20px;
        }
        .label {
            font-weight: bold;
        }
        .value {
            margin-left: 10px;
        }
    </style>
</head>
<body>
<h2>Users Information</h2>
@forelse ($users as $user)
    <div class="container">
        
       
        <div class="info">
            <span class="label">Name:</span>
            <span class="value">{{$user->_id}}</span>
        </div>
        <div class="info">
            <span class="label">Password:</span>
            <span class="value">{{$user->password}}</span>
        </div>
        <div class="info">
            <span class="label">Email:</span>
            <span class="value">{{$user->email}}</span>
        </div>
       
        
    </div>
    @empty
        No users Found
    @endforelse

    <div>
        @include("layouts.footer")
    </div>
</body>
</html>
