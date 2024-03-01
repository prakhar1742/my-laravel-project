<?php

namespace App\Http\Controllers;

use App\Models\login;
use Illuminate\Http\Request;
use session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $login=login::where("_id",'=',$req->username)->first();

        if(!$login){
            return view("books.signup")->with("signup_message","You are not a member.Please sign up fisrt");
        }
        if($login->password!==$req->password){
            return "password incorrect";
        }
        if($login->email !== $req->email){
            return 'email incorrect';
        }
        else{
            session()->put('username',$req->username);
            session()->put("key",1);
            // dd(session()->get("username"));
            return redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $check=login::where("_id",'=',$req->username)->first();
        if($check){
        return redirect('login');}
        $login=new login();
        $login->_id=$req->username;
        $login->email=$req->email;
        $login->password=$req->password;
        $login->save();
        return redirect('login');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\login  $login
     * @return \Illuminate\Http\Response
     */
    public function show(login $login)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\login  $login
     * @return \Illuminate\Http\Response
     */
    public function edit(login $login)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\login  $login
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, login $login)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\login  $login
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        session()->forget("username");
        return redirect("/login"); 
    }
}
