<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Relatorio Jade API",
 *     description="API Documentation for Relatorio Jade",
 *     @OA\Contact(
 *         email="support@example.com"
 *     )
 * )
 * 
 * @OA\Server(
 *     url="http://localhost:8080",
 *     description="Local development server"
 * )
 * 
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */
class Swagger extends ResourceController
{
    public function index()
    {
        try {
            // Enable error reporting for debugging
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            // Define the paths to scan
            $paths = [
                APPPATH . 'Controllers',
                APPPATH . 'Models'
            ];

            // Log the paths being scanned
            log_message('debug', 'Scanning paths: ' . implode(', ', $paths));

            // Generate OpenAPI documentation
            $openapi = \OpenApi\Generator::scan($paths);

            if (!$openapi) {
                throw new \Exception('Failed to generate OpenAPI documentation');
            }

            // Convert to array
            $json = json_decode(json_encode($openapi), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('JSON encoding error: ' . json_last_error_msg());
            }

            // Set headers
            $this->response->setHeader('Content-Type', 'application/json');
            $this->response->setHeader('Access-Control-Allow-Origin', '*');
            $this->response->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
            $this->response->setHeader('Access-Control-Allow-Headers', 'Content-Type');

            return $this->response->setJSON($json);

        } catch (\Exception $e) {
            log_message('error', 'Swagger generation error: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            
            return $this->response->setStatusCode(500)
                                ->setJSON([
                                    'error' => true,
                                    'message' => 'Error generating API documentation: ' . $e->getMessage()
                                ]);
        }
    }

    public function ui()
    {
        return view('swagger-ui');
    }
} 