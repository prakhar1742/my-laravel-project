<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>course search result</title>


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
    <a href="{{ url('/coursesubmit') . '/' . $idd .'/'.$searchh}}"><p >{{$count}} found in {{$idd}}</p></a>
@endforeach
@endif
    </div>
    <div class="container">
        <a href="{{url('/course')}}"> <button> back </button></a>
        @forelse($data as $d)
            <div class="card">
                <h2>Exam name {{ $d->exam_name }}</h2>
                <!-- <p>ID: {{ $d->id }}</p> -->
                <p>package name: {{ $d->package_name }}</p>
                <p>phase name: {{ $d->phase_name }}</p>
                <p>subject name: {{$d->subject_name}}</p>   
                <p>chapter name : {{$d->chapter_name}}</p>
                <p>title : {{$d->title}}</p>
                <p>content : {{$d->content}}</p>
                <p>lang id : {{$d->lang_id}}</p>
                <p>type order : {{$d->type_order}}</p>    
                <p>id : {{$d->id}}</p>
            </div>
        @empty
            <p class="empty-message">No data found.</p>
        @endforelse
    </div>
    
</body>
</html>