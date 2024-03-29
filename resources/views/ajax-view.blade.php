<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax-call</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Add CSRF token meta tag -->
</head>
<body>
    <form id="form">
        @csrf
        <input type="text" name="query" id="query"/>
        <input type="submit" value="search data"/>
    </form>
    <p id="ajax"></p>
    <button id="button">Click here to call</button>
    <script>
        $(document).ready(function(){
            $("#form").submit(function(event){
                event.preventDefault(); // Prevent default form submission

                var formdata=new fommData();
                formdata.append()

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('/ajax/show') }}",
                    type: "POST",
                    data:data,
                    processData: false,
                    contentType: false,
                    success: function(response){
                        $("#ajax").text(response.name);
                    },
                    error: function(xhr, status, error){
                        $("#ajax").text("Error in fetching data: " + error);
                    }
                });
            });

            $("#button").click(function(){
                // Your AJAX button click event handling code here
            });
        });
    </script>
</body>
</html>
