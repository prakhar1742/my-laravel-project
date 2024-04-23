<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Query</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        form {
            display: flex;
            justify-content: center;
            padding: 20px;
        }
        #textInput {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        #textInput:focus {
            border-color: #007bff;
            outline: none;
        }
        input[type="submit"] {
            padding: 10px 20px;
            margin-left: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        #response, #suggestion {
            padding: 20px;
            text-align: center;
        }
        #response a {
            display: block;
            margin-bottom: 10px;
            text-decoration: none;
            color: #007bff;
        }
        #response a:hover {
            text-decoration: underline;
        }
        #suggestion {
            cursor: pointer;
            color: #007bff;
        }
        #suggestion:hover {
            text-decoration: underline;
        }
        
    </style>
</head>
<body>
    <form method="get" action="{{url('/courseresult')}}">
        @csrf
        <input type="text" name="param" id="textInput" placeholder="Enter your query"/>
        <input type="submit" value="search"/>
    </form>
    <div id="response">search result</div>
    <div id="suggestionsContainer"></div>
    <p id="suggestion" onClick="document.getElementById('textInput').value=document.getElementById('suggestion').innerText"></p>
    <script>
        $(document).ready(function() {
            let timeId;
            $('#textInput').on('input', function() {
                clearTimeout(timeId);
                var inputText = $(this).val();
                if (inputText.trim() !== '') {
                    timeId=setTimeout(() => {
                        $.ajax({
                        url: "/api/spellcheck",
                        type: 'POST', 
                        data: {
                            param: inputText
                        },
                        success: function(response) {
                            $("#suggestion").html(" "); 
                            $("#suggestion").html(response["spellCheck"]); 
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                    }, 500);
                } else {
                    $('#response').html('');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            let timeId;
            $('#textInput').on('input', function() {
                clearTimeout(timeId);
                var inputText = $(this).val();
                if (inputText.trim() !== '') {
                    timeId=setTimeout(() => {
                        $.ajax({
                        url: "/api/api",
                        type: 'POST', 
                        data: {
                            param: inputText
                        },
                        success: function(response) {
                            $("#response").html(" ");  
                            var searchh = response["searchh"] ? response["searchh"] : null;
                            for(var key in response["facet"]){
                                url="{{url('/coursesubmit')}}/"+encodeURIComponent(key)+"/"+encodeURIComponent(searchh);
                                $("#response").append("<a href="+url+"><p>"+response["facet"][key]+ " in "+key+"</p></a>");
                            }
                            if(response["facet"].length==0){$("#response").html("OOPs nothing found");}
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                    }, 500);
                } else {
                    $('#response').html('');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            let timeId;
            $('#textInput').on('input', function() {
                clearTimeout(timeId);
                var inputText = $(this).val();
                if (inputText.trim() !== '') {
                    timeId=setTimeout(() => 
                    {
                        $.ajax({
                        url: "/api/suggester",
                        type: 'POST', 
                        data: {
                            param: inputText
                        },
                        success: function(response) {
                            $("#suggestionsContainer").html("");
                            for(var key in response){
                                
                                console.log(response[key]["term"]);
                                $("#suggestionsContainer").append(response[key]["term"]);
                                $("#suggestionsContainer").append("<br/>");
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                    }, 500);
                } else {
                    $('#response').html('');
                }
            });
        });
    </script>
</body>
</html>
