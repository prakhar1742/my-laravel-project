<?php

namespace App\Http\Controllers;

use App\Models\login;
use Illuminate\Http\Request;


class AjaxController extends Controller
{
    protected $client;

    public function __construct(\Solarium\Client $client)
    {
        $this->client = $client;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("ajax-view");
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ajax  $ajax
     * @return \Illuminate\Http\Response
     */
    public function show(Ajax $ajax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ajax  $ajax
     * @return \Illuminate\Http\Response
     */
    public function edit(Ajax $ajax)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ajax  $ajax
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ajax $ajax)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ajax  $ajax
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ajax $ajax)
    {
        //
    }
    public function data(Request $req)
{
    $searchh = $req->param ?? "*:*";
    
    try {
        $query = $this->client->createSelect();

        // Create facet field outside the loop
        $facetField = $query->getFacetSet()->createFacetField('subject_name');
        $facetField->setField('subject_name')->setMinCount(1)->setLimit(5);

        if ($searchh != "*:*") {
            $data = [];
            $facet = [];
            $sea = '"' . $searchh . '"'; // Enclose search term within double quotes
            $query->setQuery("exam_name:" . $sea . " OR subject_name:" . $sea . " OR chapter_name:" . $sea . " OR title:" . $sea);

            // Execute the query
            $result = $this->client->select($query);

            // Collect facet values for this search term
            $da = $result->getDocuments();
            $facetSet = $result->getFacetSet();
            $categoryFacet = $facetSet->getFacet('subject_name');
            $facet += $categoryFacet->getValues();
            $data = array_merge($data, $da);
        } else {
            // If search is empty, execute the query directly
            $facet = "Enter search term";
        }

        return response()->json(["facet" => $facet, "searchh" => $searchh]);

    } catch (\Solarium\Exception $e) {
        return response()->json('ERROR', 500);
    }
}

    public function api(Request $req){
        $login=login::where("_id",'=',$req->username)->first();

        if(!$login){
            return response()->json(["signup_message"=>"You are not a member.Please sign up fisrt"]);
        }
        if($login->password!==$req->password){
            return response()->json(["message"=>"password incorrect"]);
        }
        if($login->email !== $req->email){
            return response()->json(["message"=>"email incorrect"]);
        }
        else{
            session()->forget('username');
            session()->forget("admin");
            session()->put('username',$req->username);
            
            // dd(session()->get("username"));
            if($login->admin){
                
                session()->put("admin",1);
            }
            return response()->json(["message"=>"logged","admin status"=>session()->get("admin")]);
        }
    }
    public function get(Request $req){
            return response()->json(["all users"=>login::all()]);
    }
}
