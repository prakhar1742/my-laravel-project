<?php

return [
    'endpoint' => [
        'localhost' => [
            'host' => env('SOLR_HOST', '127.0.0.1'),
            'port' => env('SOLR_PORT', '8984'),
            'path' => env('SOLR_PATH', '/'),
            'core' => env('SOLR_CORE', 'Pp')
        ]
    ]
];