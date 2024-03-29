<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="{{url('/submit')}}" method="post">
            @csrf
            <label for="id">ID:</label><br>
            <input type="text" id="id" name="id" required><br>
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" required><br>
            <label for="address">Address:</label><br>
            <input type="text" id="address" name="address" required><br>
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
