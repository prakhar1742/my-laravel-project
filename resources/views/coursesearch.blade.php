<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Query</title>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <form method="get" action="{{url('/courseresult')}}">
        @csrf
        <input type="text" name="param" id="textInput"/>
        <input type="submit" value="search"/>
</form>
<div id="response">search result</div>
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
                            
                          try{
                            $("#suggestion").html(" ");  
                           for(var key in response["spellCheck"]["spellcheck"]["suggestions"]){
                            
                            try{
                               $("#suggestion").append(response["spellCheck"]["spellcheck"]["suggestions"][key]["suggestion"][0]["word"]);
                               $("#suggestion").append(" ");
                           

                           }
                            
                            catch(err){
                                
                            }
                        }
                            
                          }
                          catch(err){

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
                    timeId=setTimeout(() => {
                        $.ajax({
                        url: "/api/suggester",
                        type: 'POST', 
                        data: {
                            param: inputText
                        },
                        success: function(response) {
                           for(var key in response){
                            console.log(response[key]["term"]);
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