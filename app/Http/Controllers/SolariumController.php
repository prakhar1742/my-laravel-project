<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class SolariumController extends Controller
{
    protected $client;

    public function __construct(\Solarium\Client $client)
    {
        $this->client = $client;
    }

    public function ping(Request $req)
    {
        $search=$req->param;

        // execute the ping query
        try {
            $query = $this->client->createSelect();

        // Execute the query
        $query->setQuery("name:".$search." OR username:".$search." OR address:".$search);
        $result = $this->client->select($query);

        // Get search results
        $data = $result->getDocuments();

        // Return response
        return response()->json($data);
        } catch (\Solarium\Exception $e) {
            return response()->json('ERROR', 500);
        }
    }
}