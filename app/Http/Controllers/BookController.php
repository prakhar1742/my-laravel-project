<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('books.wel', [
            'book' => Book::paginate(20)

            // where(
            //     'author','=',"John Doe")
            //    ->get()
          ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book=new Book();
        
        $book->title=strtolower($request->title);
        $book->author=strtolower($request->author);
        $book->published_year=(int)$request->publish_year;
        $book->save();
        return redirect()->back()->with('success', 'Book created successfully!');
        // ->route('booklist');
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $book=Book::where("title","=",strtolower($request->name))->first();
        if(!$book){
            return "No such book found";
        }
        // print_r($book);

        return redirect()->Route("updated",["id"=>$book->title]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
    public function stare(){
        return view("books.form");
    }
    public function updated($id,$page)
{

    $book = Book::where('_id', '=', $id)->first();
    return view("books.update", [
        "book" => $book,
        "page" => $page, 
    ]);
}

        public function delete($id){
            $book=Book::where("_id","=",$id)->delete();
            return redirect()->back();
        }
        public function update1(Request $req, $id,$page)
{
    $book = Book::findOrFail($id); // Use findOrFail to throw 404 if book is not found
    $book->title = $req->title;
    $book->author = $req->author;
    $book->published_year = $req->published_year;
    $book->save();

    $currentPage = $req->input('page', 1);
    
    return redirect()->route('booklist', ['page' => $page]);
}

        public function search(Request $req){
            $sea=$req->search;
            if($sea==""){
                return redirect('/');
            }
            else{
                $book=Book::where("title","like","%$sea%")->orWhere("author","like","%$sea%")->orWhere("published_year","=",(int)$sea)->get();
            }
            return view("books.search",['book'=>$book,"search"=>$req->search]);

        }
    }
