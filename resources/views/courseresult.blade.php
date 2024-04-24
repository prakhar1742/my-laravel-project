<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>course search result</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .facet-nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 200px; /* Fixed width for the facet navigation */
            height: 100%; /* Full height to stick to the left */
            background-color: #007bff; /* Blueish background */
            padding: 20px;
            overflow-y: auto; /* Enable scrolling if content overflows */
            z-index: 1000; /* Ensure it's above other content */
            box-shadow: 2px 0 4px rgba(0, 0, 0, 0.1); /* Shadow for depth */
        }

        .facet-nav a {
            display: block;
            text-align: left;
            color: #ffffff; /* White text for better contrast */
            text-decoration: none;
            padding: 10px 0;
            transition: background-color 0.3s ease;
        }

        .facet-nav a:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        .back-button {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #0056b3;
        }

        .card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
            margin-left: 220px; /* Adjusted margin to accommodate the facet navigation */
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card h2 {
            margin-top: 0;
            color: #333;
        }

        .card p {
            margin-bottom: 10px;
            color: #666;
        }

        .empty-message {
            text-align: center;
            font-style: italic;
            color: #666;
            margin-top: 20px;
        }

        em {
            background-color: red;
            color: white;
            padding: 2px 4px;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    <div class="container">
        <a href="{{url('/course')}}" class="back-button">Back</a>
        @forelse($data as $d)
            <div class="card">
                <h2>Exam name {{ $d->exam_name }}</h2>
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

@if($facet !=null)
    <div class="facet-nav">
@foreach($facet as $idd=>$count)
    <a href="{{ url('/coursesubmit') . '/' . $idd .'/'.$searchh}}"><p>{{$count}} found in {{$idd}}</p></a>
@endforeach
@endif
    </div>
    
</body>
</html>
