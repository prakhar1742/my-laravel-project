<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration Form</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f5f9; /* Light blueish background */
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        background-color: #ffffff; /* White container background */
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 300px;
    }

    h2 {
        color: #2b6cb0; /* Blueish heading color */
        margin-bottom: 20px;
        text-align: center;
    }

    label {
        color: #2b6cb0; /* Blueish label color */
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ced4da; /* Light gray border */
        border-radius: 5px;
    }

    input[type="submit"] {
        background-color: #2b6cb0; /* Blueish submit button background */
        color: #ffffff; /* White text color */
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
        width: 100%;
    }

    input[type="submit"]:hover {
        background-color: #1e4e84; /* Darker blueish hover background */
    }
</style>
</head>
<body>
    

<div class="container">
    @if($message)
    <div style="background-color: #ffe5b2; padding: 10px; border: 1px solid #ffcc80; border-radius: 5px;">

        {{ $message }}
        </div>

    @endif

    <h2>Log In</h2>
    <form action="{{Route('login')}}" method="post">
        @csrf
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Submit">
    </form>
</div>

</body>
</html>
