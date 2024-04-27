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
        #suggestionsContainer {
    margin-top: 10px; 
  }

  #suggestionsContainer span {
    display: inline-block;
    padding: 5px 10px; 
    margin: 5px;
    background-color: #f0f0f0; 
    border-radius: 5px; 
    cursor: pointer; 
    transition: background-color 0.3s ease; 
  }

  #suggestionsContainer span:hover {
    background-color: #e0e0e0
  }
    </style>
</head>
<body>
    <form method="get" action="{{url('/courseresult')}}">
        @csrf
        <input type="text" name="param" id="textInput" placeholder="Enter your query"/>
        <input type="submit" value="search" id="searchButton"/>
    </form>
    <div id="response">search result</div>
    <div id="suggestionsContainer"></div>
    <div style="text-align: center;">
    <span id="suggestion" onClick="inputchange()" style="display: inline-block;"></span>
    </div>
    <script>
        function inputchange(){
            document.getElementById('textInput').value=document.getElementById('suggestion').innerText;
            const event = new Event('input', { bubbles: true });
            document.getElementById("textInput").dispatchEvent(event);
        }
        function suggestionClick(element){
            console.log(element.textContent);
            document.getElementById("textInput").value=element.textContent;
            document.getElementById("searchButton").click();
        }
    </script>
    <script>
        function spellCheck(inputText) {
    return $.ajax({
        url: "/api/spellcheck",
        type: 'POST',
        data: {
            param: inputText
        }
    });
}

function searchApi(inputText) {
    return $.ajax({
        url: "/api/api",
        type: 'POST',
        data: {
            param: inputText
        }
    });
}

function suggesterApi(inputText) {
    return $.ajax({
        url: "/api/suggester",
        type: 'POST',
        data: {
            param: inputText
        }
    });
}

    </script>
    <script>
    $(document).ready(function() {
    let timeId;
    $('#textInput').on('input', function() {
        clearTimeout(timeId);
        var inputText = $(this).val();
        if (inputText.trim() !== '') {
            timeId = setTimeout(() => {
                Promise.all([spellCheck(inputText), searchApi(inputText), suggesterApi(inputText)])
                .then(function(responses) {

                    $("#suggestion").html(" ");
                    $("#suggestion").html(responses[0]["spellCheck"]);

                    $("#response").html(" ");
                    var searchh = responses[1]["searchh"] ? responses[1]["searchh"] : null;
                    for(var key in responses[1]["facet"]){
                        var url = "{{url('/coursesubmit')}}/" + encodeURIComponent(key) + "/" + encodeURIComponent(searchh);
                        $("#response").append("<a href=" + url + "><p>" + responses[1]["facet"][key] + " in " + key + "</p></a>");
                    }
                    if(responses[1]["facet"].length == 0){
                        $("#response").html("OOPs nothing found");
                    }

                    $("#suggestionsContainer").html("");
                    for(var key in responses[2]){
                        console.log(responses[2][key]["term"]);
                        $("#suggestionsContainer").append("<span onClick='suggestionClick(this)'>" + responses[2][key]["term"] + "</span>");
                        $("#suggestionsContainer").append("<br/>");
                    }
                })
                .catch(function(error) {
                    console.error('Error:', error);
                });
            }, 500);
        } else {
            $('#suggestion').html('');
            $('#response').html('search result');
            $("#suggestionsContainer").html("");
        }
    });
});
</script>
</body>
</html>
