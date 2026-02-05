<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\Client;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// Create a logger
$log = new Logger('app');
$log->pushHandler(new StreamHandler(__DIR__ . '/../logs/app.log', Logger::DEBUG));

// Handle request
$request = Request::createFromGlobals();

// Simple routing
$path = $request->getPathInfo();

switch ($path) {
    case '/':
        $response = new Response('Welcome to the Sample PHP App!');
        break;
    
    case '/api/fetch':
        $client = new Client();
        try {
            $apiResponse = $client->get('https://api.example.com/data');
            $response = new Response($apiResponse->getBody(), 200, ['Content-Type' => 'application/json']);
        } catch (\Exception $e) {
            $log->error('API fetch failed: ' . $e->getMessage());
            $response = new Response(json_encode(['error' => 'Failed to fetch data']), 500);
        }
        break;
    
    case '/health':
        $response = new Response(json_encode(['status' => 'healthy']), 200, ['Content-Type' => 'application/json']);
        break;
    
    default:
        $response = new Response('Not Found', 404);
}

$log->info('Request handled', ['path' => $path, 'method' => $request->getMethod()]);
$response->send();
