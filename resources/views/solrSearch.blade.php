<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solr Search Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .card {
            background-color: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .card h2 {
            margin-top: 0;
        }

        .card p {
            margin-bottom: 0;
        }

        .empty-message {
            text-align: center;
            font-style: italic;
            color: #666;
            margin-top: 20px;
        }
        em{
            bachground-color:red;
        }
    </style>
</head>
<body>
    @if($facet !=null)
    <div style="text-align: left;position: fixed;">
@foreach($facet as $idd=>$count)
    <a href="{{ url('/submit') . '/' . $idd .'/'.$searchh}}"><p >{{$count}} found with subject ID {{$idd}}</p></a>
@endforeach
@endif
    </div>
    <div class="container">
        <a href="{{url('/query')}}"> <button> back </button></a>
        @forelse($data as $d)
            <div class="card">
                <h2>Sub ID {{ $d->sub_id }}</h2>
                <!-- <p>ID: {{ $d->id }}</p> -->
                <p>subject name: {{ $d->subject }}</p>
                <p>subject name hindi: {{ $d->subject_hindi }}</p>
                <p>subject ID: {{$d->subject_ID}}</p>
            </div>
        @empty
            <p class="empty-message">No data found.</p>
        @endforelse
    </div>
</body>
</html>
