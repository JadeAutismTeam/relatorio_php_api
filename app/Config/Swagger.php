<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Swagger extends BaseConfig
{
    public $openapi = '3.0.0';
    public $info = [
        'title' => 'Relatorio Jade API',
        'description' => 'API Documentation',
        'version' => '1.0.0',
    ];
    public $servers = [
        [
            'url' => 'http://localhost:8080',
            'description' => 'Local development server',
        ],
    ];
    public $paths = [];
    public $components = [
        'schemas' => [],
        'securitySchemes' => [
            'bearerAuth' => [
                'type' => 'http',
                'scheme' => 'bearer',
                'bearerFormat' => 'JWT',
            ],
        ],
    ];
} 