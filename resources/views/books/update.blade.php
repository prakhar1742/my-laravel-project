<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex justify-center items-center h-screen">
@if(isset($book))
    <div class="bg-white p-8 rounded shadow-md max-w-md w-full">
    <form action="{{ route('updatebook', ['id' => $book->_id, 'page' => $page]) }}" method="post">

            @csrf
            @method('PUT')
          
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold mb-2">Book Name:</label>
                <input type="text" value="{{ $book->title }}" name="title" id="title" class="w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="author" class="block text-gray-700 font-bold mb-2">Author Name:</label>
                <input type="text" value="{{ $book->author }}" name="author" id="author" class="w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>
            
            <div class="mb-4">
                <label for="published_year" class="block text-gray-700 font-bold mb-2">Published Year:</label>
                <input type="text" value="{{ $book->published_year }}" name="published_year" id="published_year" class="w-full border-gray-300 rounded-md  focus:border-blue-500">
            </div>
            
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Update</button>
        </form>
    </div>
    @else
    <p>No book ID passed.</p>

    @endif
</body>
</html>
