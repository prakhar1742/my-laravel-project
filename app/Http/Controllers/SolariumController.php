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
    //     $search=$req->param ?? "*:*";
        

    //     try {
    //         $query = $this->client->createSelect();

    //    if($search != "*:*"){
    //     $query->setQuery("subject:*".$search."* OR subject_hindi:*".$search."* OR sub_id:".(int)$search." OR subject_ID:".(int)$search);
    //    }
    //    else{
    //     $query->setQuery($search);
    //    }
    //     $result = $this->client->select($query);

    //     $data = $result->getDocuments();
    //     // return response()->json($data);
    //     return view("solrSearch",["data"=>$data]);    

    //     } catch (\Solarium\Exception $e) {
    //         return response()->json('ERROR', 500);
    //     }
    $searchh=$req->param ?? "*:*";
        

        try {
            $query = $this->client->createSelect();

       if($searchh != "*:*"){
        $data=[];
        $facet=[];
        $search=explode(" ",$searchh);
        foreach($search as $sea){
            if((int)$sea==0){
                $query->setQuery("subject:".$sea." OR subject_hindi:".$sea." OR subject:*".$sea."* OR subject_hindi:*".$sea);
                $query->getFacetSet()->createFacetField('subject_ID')->setField('subject_ID');
            }
            else{
                $query->setQuery("subject:*".$sea."* OR subject_hindi:*".$sea."* OR sub_id:".(int)$sea." OR subject_ID:".(int)$sea);
                $query->getFacetSet()->createFacetField('subject_ID')->setField('subject_ID');
            }
            $result = $this->client->select($query);
            $da = $result->getDocuments();
            $facetSet = $result->getFacetSet();
            $categoryFacet = $facetSet->getFacet('subject_ID');
            $facet+=$categoryFacet->getValues();
            // dd($da);
            // dd($categoryFacet->getValues());
            // $facet=array_merge($facet,$categoryFacet->getValues());
            $data=array_merge($data,$da);

        }
       }
       else{
        $query->setQuery($searchh);
        $result = $this->client->select($query);
        $data=$result->getDocuments();
        $facet=null;
       }
       
        // return response()->json($data);
        // $arr=["name"=>"prakhar"];
        // $categoryFace=$categoryFacet->getvalues();
        // $categoryFace=array_merge($arr,$categoryFace);        
        // dd($categoryFace    );

        // dd($facet);
        return view("solrSearch",["data"=>$data,"facet"=>$facet,"searchh"=>$searchh]);    

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

    public function search(Request $req,$idd,$searchh){
        try {
            $query = $this->client->createSelect();
        $data=[];
        $facet=[];
        $search=explode(" ",$searchh);
        foreach($search as $sea){
            if((int)$sea==0){
                $query->setQuery("subject:".$sea." OR subject_hindi:".$sea."* AND subject_ID:".$idd);
                $query->getFacetSet()->createFacetField('subject_ID')->setField('subject_ID');
            }
            else{
                $query->setQuery("subject:*".$sea."* OR subject_hindi:*".$sea."* OR sub_id:".(int)$sea." AND subject_ID:".$idd);
                $query->getFacetSet()->createFacetField('subject_ID')->setField('subject_ID');
            }
            $result = $this->client->select($query);
            $da = $result->getDocuments();
            $facetSet = $result->getFacetSet();
            $categoryFacet = $facetSet->getFacet('subject_ID');
            $facet+=$categoryFacet->getValues();
            $data=array_merge($data,$da);

       }

        return view("solrSearch",["data"=>$data,"facet"=>$facet,"searchh"=>$searchh]);    

        } catch (\Solarium\Exception $e) {
            return response()->json('ERROR', 500);
        }
    }
}