<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $client;

    public function __construct(\Solarium\Client $client)
    {
        $this->client = $client;
    }

    public function ping(Request $req)
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

        return view("courseresult", ["data" => $data, "facet" => $facet, "searchh" => $searchh]);

    } catch (\Solarium\Exception $e) {
        return response()->json('ERROR', 500);
    }
    }

    
    
    public function addData(Request $req){
        $data=["id"=>$req->id,"name"=>$req->name,"address"=>$req->address,"username"=>$req->username];
        $update=$this->client->createUpdate();
        $doc=$update->createDocument($data);
        $update->addDocument($doc); 
        $result=$this->client->update($update);
        return redirect()->back();
    }

    public function search(Request $req, $idd, $searchh) {
        try {
            $query = $this->client->createSelect();
            $data = [];
            $facet = [];
    
            $facetField = $query->getFacetSet()->createFacetField('subject_name');
            $facetField->setField('subject_name')->setMinCount(1);
    
            $search = explode(" ", $searchh);
    
            foreach ($search as $sea) {
                // Check if $sea is not a number
                if (!is_numeric($sea)) {
                    // Query for non-numeric $sea
                    $query->setQuery("(exam_name:\"$sea\" OR chapter_name:\"$sea\" OR title:\"$sea\") AND subject_name:\"$idd\"");
                } else {
                    // Query for numeric $sea
                    $query->setQuery("(exam_name:*$sea* OR chapter_name:*$sea* OR lang_id:$sea) AND subject_name:\"$idd\"");
                }
    
                // Execute the query
                $result = $this->client->select($query);
    
                // Get documents and facets
                $data += $result->getDocuments();
                $facetSet = $result->getFacetSet();
                $categoryFacet = $facetSet->getFacet('subject_name');
                $facet += $categoryFacet->getValues();
            }
    
            // Return the results
            return view("courseresult", ["data" => $data, "facet" => $facet, "searchh" => $searchh]);    
        } catch (\Solarium\Exception $e) {
            // Handle exceptions
            return response()->json('ERROR', 500);
        }
    }
       
}