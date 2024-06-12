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

            $sea = '"' . $searchh . '"'; 

            $query->setQuery("exam_name:" . $sea . " OR subject_name:" . $sea . " OR chapter_name:" . $sea . " OR title:" . $sea);
 
           

            $result = $this->client->select($query);
 
           

            $da = $result->getDocuments();

            $facetSet = $result->getFacetSet();

            $categoryFacet = $facetSet->getFacet('subject_name');

            $facet += $categoryFacet->getValues();

            $data = array_merge($data, $da);

        } else {


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
    
            // Check if the search term is numeric
            if (!is_numeric($searchh)) {
                // Query for non-numeric search term
                $query->setQuery("(exam_name:\"$searchh\" OR chapter_name:\"$searchh\" OR title:\"$searchh\") AND subject_name:\"$idd\"");
            } else {
                // Query for numeric search term
                $query->setQuery("(exam_name:*$searchh* OR chapter_name:*$searchh* OR lang_id:$searchh) AND subject_name:\"$idd\"");
            }
    
            // Execute the query
            $result = $this->client->select($query);
    
            // Get documents and facets
            $data = $result->getDocuments();
            $facetSet = $result->getFacetSet();
            $categoryFacet = $facetSet->getFacet('subject_name');
            $facet = $categoryFacet->getValues();
    
            // Return the results
            return view("courseresult", ["data" => $data, "facet" => $facet, "searchh" => $searchh]);    
        } catch (\Solarium\Exception $e) {
            // Handle exceptions
            return response()->json('ERROR', 500);
        }
    }

    public function spellCheck(Request $req){

        $query = $this->client->createSpellcheck();
$query->setQuery($req->param);
$query->setDictionary('default');
$query->setCount(5); // number of suggestions to return

// execute the query and get the result
$result = $this->client->execute($query);;
$suggestions = $result->getResults();
$query_arr=explode(" ",$req->param);
$out="";

if(!empty($suggestions)){   
    foreach($query_arr as $arr){
        if(array_key_exists($arr,$suggestions)){
            
            $out=$out.$suggestions[$arr]->getSuggestions()[0]["word"]." ";
        }
        else{
            $out=$out.$arr." ";
        }
    } 
}


        // $query = $this->client->createSelect();
        // $queryTerm = $req->param; 
        // $query->setQuery($queryTerm);
        // $query->setHandler('spell');

        // $spellcheck = $query->getSpellcheck();
        // $spellcheck->setDictionary('default'); 
        // $spellcheck->setCount(5);      

        // $result = $this->client->select($query);
        // $spell=$result->get
        return response()->json(["spellCheck"=>$out]);

        
        
    }

    public function suggester(Request $req){
        $query = $this->client->createSuggester();
$query->setQuery($req->param);
$query->setDictionary('FuzzySuggester');
$query->setCount(5);

$resultset = $this->client->suggester($query);
$suggestions=array();
foreach ($resultset as $term => $termResult) {
    foreach ($termResult as $result) {
        array_push($suggestions,$result);
    }
    

}


$suggestions = $suggestions[0]->getSuggestions();



        return response()->json($suggestions, 200 );
    }

  
 public function linksubmit(Request $req){
        
        try {
            $this->client->getEndpoint('localhost')->setCore('prakhar');

            $query = $this->client->createSelect();
    
            
            $data=[];
            
            $sea='"'.$req->textInput.'"';
            $query->setQuery("tags:".$sea."OR title:".$sea);
            
            // Execute the query
            $result = $this->client->select($query);
    
            // Get documents and facets
            $data = $result->getDocuments();
            return redirect($data[0]->link);
            // Return the results
            // return view("submitlink", ["data" => $data]);    
        } catch (\Solarium\Exception $e) {
            // Handle exceptions
            return response()->json('ERROR', 500);
        }

    }

    public function linksuggester(Request $req){
        $this->client->getEndpoint('localhost')->setCore('prakhar');

            $query = $this->client->createSuggester();
            $sQuery=$req->param." ".$req->package_id;
            $query->setQuery($sQuery);
    $query->setDictionary('mySuggester');
    $query->setCount(5);
    
    $resultset = $this->client->suggester($query);
    $suggestions=array();
    foreach ($resultset as $term => $termResult) {
        foreach ($termResult as $result) {
            
            array_push($suggestions,$result);
        }
        
    
    }
    
    
    $suggestions = $suggestions[0]->getSuggestions();
    
    
    
            return response()->json($suggestions, 200 );
        }
    


    
    
       
}