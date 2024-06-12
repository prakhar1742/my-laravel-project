<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #0056b3;
        }
        ul#suggestions {
            list-style-type: none;
            padding-left: 0;
            margin-top: 20px;
        }
        li {
            padding: 10px;
            border-bottom: 1px dashed #ddd;
        }
        li:last-child {
            border-bottom: none;
        }
        #submitButton{
            display:none;
        }
        #suggestions{
            display:none;
        }
    </style>
</head>
<body>

<form action="{{url('/')}}/submitlink" method="post" id="linkForm">
    @csrf
    <label for="textInput">Enter key:</label><br>
    <input type="text"  placeholder="enter search terms" id="textInput" name="textInput"><br>
    <button type="submit" id="submitButton">Submit</button>
</form>


<ul id="suggestions">

</ul>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
   $(document).ready(function(){
    $("#linkForm").on("keypress",function(event){
        if(event.key=="Enter"){
            event.preventDefault();
        }
    })
    console.log("api started");
    $("#textInput").attr("autocomplete","off");

    let debounceTimeout;

    $('#textInput').on('input', function(event){
        clearTimeout(debounceTimeout);

        debounceTimeout = setTimeout(function(){
            var formData = {
                param: $('#textInput').val().trim()
            };

            if($("#textInput").val().trim()!=""){
                $.ajax({
                url: "{{url('/')}}/api/linksuggester",
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response){    
                    $("#suggestions").html("");
                    for(var key in response){
                        $("#suggestions").append("<li onclick='linkClicked(this)'>"+response[key]["term"] + "</li><br>");
                    }
                    if(response.length==0){
                        $("#suggestions").append("<li>No result found, try something else</li><br>");
                    }
                    $("#suggestions").css("display","block");
                },
                error: function(xhr, status, error){
                    $('#suggestions').html('<p>An error occurred: ' + error + '</p>');
                }
            });
            }
            else{
                $("#suggestions").css("display","none");
                $("#suggestions").html("");
            }
        }, 1000); 
    });
});
function linkClicked(element){
    let value = $(element).text();
    console.log(value);
    document.getElementById("textInput").value=value;
    document.getElementById("submitButton").click();
}

    </script>

</body>
</html>
