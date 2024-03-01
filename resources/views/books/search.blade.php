<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title >search result</title>
    @vite('resources/css/app.css')
    <!-- <script>
        document.getElementsByClassName('page-item').style.display="flex";
        </script> -->
</head>
<body style="font-family: Arial, sans-serif; background-color: #f3f3f3; padding: 20px;">


<div class="flex justify-between items-center bg-slate-200 p-4 mb-8">
    <a href="{{url('/')}}">
        <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded cursor-pointer ">Refresh</button>
    </a>
    <h1 class="text-center text-4xl text-black font-extrabold">Search Result of {{$search}}</h1>
    <a href="{{route('add.user')}}">
        <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded cursor-pointer ">Add User</button>
    </a>
</div>

<div>
    <form action="{{route('search')}}" method="get" class="flex justify-center space-x-3 m-4">
        <input value="{{$search}}" class="w-screen px-2"type="search" name="search" placeholder="search by title or author" class="rounded-md"/>
        <input type="submit" value="search" class="bg-blue-300 hover:bg-blue-500 text-white font-bold w-28 text-xl rounded-xl cursor-pointer" />
    </form>
</div>

<div class="container" style="max-width: 800px; margin: 0 auto;">
    @forelse ($book as $b)
        <div class="book-card hover:scale-110 delay-100  transform transition duration-150" style="background-color: #ffffff; border-radius: 5px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); padding: 20px; margin-bottom: 20px;">
            <h2 style="margin-bottom: 10px;">{{ ucwords($b->title) }}</h2>
            <p style="margin: 5px 0;">Author: {{ ucwords($b->author) }}</p>
            <p style="margin: 5px 0;">Published Year: {{$b->published_year }}</p>
            <div class="flex justify-between"><a href="{{route('delete',['id'=>$b->_id])}}"> <button class="bg-red-400 px-2 py-1 hover:bg-red-700 rounded-lg shadow-lg "> Delete book</button> </a>
            <a href="{{route('update',['id'=>$b->_id,'page'=>1])}}"> <button class="bg-blue-400 px-2 py-1 hover:bg-blue-200 rounded-lg shadow-lg "> Update book</button> </a>
</div>
            
            
        </div>




        @empty <h2 class="text-center text-2xl">No Book Found </h2>
    @endforelse
</div>
<div class="container" style="max-width: 800px; margin: 0 auto;">
    <!-- Your book list items here -->




</body>
</html>
