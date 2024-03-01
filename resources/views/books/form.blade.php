<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
}

.alert-success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
}

        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        input[type="text"],
        input[type="number"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add Book to DataBase</h1>
        <form action="{{ url('/') }}/store" method="post">
            @csrf
            <div>
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" placeholder="Enter title" required>
            </div>
            <div>
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" placeholder="Enter author name" required>
            </div>
            <div>
                <label for="publish_year">Publish Year:</label>
                <input type="number" id="publish_year" name="publish_year" placeholder="Enter year" required>
            </div>
            <input type="submit" value="Add Data">
        </form>
    </div>
    <div style="text-align: center;">
    <a href="{{url('/')}}" style="text-decoration: none;">
        <button style="background-color: #007bff; color: white; padding: 15px 30px; border: none; border-radius: 8px; cursor: pointer; font-size: 18px; transition: background-color 0.3s;">
            See Book List
        </button>
    </a>
</div>


    <div>
    @if (session('success'))
    <div class="alert alert-success" >
        {{ session('success') }}
    </div>
@endif

    </div>
</body>
</html>
