<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Solarium\Client as SolariumClient;

class TechProductsController extends Controller
{
    public function adminlist(){
        $solrConfig = [
            'endpoint' => [
                'localhost' => [
                    'host' => '127.0.0.1',
                    'port' => 8984,
                    'path' => '/solr/',
                    'core' => 'techproducts', // Replace with your Solr core name
                ]
            ]
        ];

        $client = new SolariumClien($solrConfig);
        $query=$client->createSelect();
        $query->setQuery("*:*");
        $resultSet=$client->select($query);
        $admins=$resultSet->getIterator();
        return $admins;

    }
    
}
