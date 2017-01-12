<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'controllers/employee.php';

$app = new \Slim\App;

# http://localhost:8080/api/v1/employees
$app->get('/api/v1/employees', function (Request $request, Response $response) {	
	$employee = new Employee();
	$result = $employee->getAll();
    $response = $response->withJson($result);
    return $response;
});

# http://localhost:8080/api/v1/employees/574daa378cb97f935a5c8e2e
$app->get('/api/v1/employees/{id}', function (Request $request, Response $response) {
	$id = $request->getAttribute('id');
	$employee = new Employee();
	$result = $employee->getById($id);
    $response = $response->withJson($result);
    return $response;
});

# http://localhost:8080/api/v1/searchs/employee?email=chasitycarver@fanfare.com
$app->get('/api/v1/searchs/employee', function (Request $request, Response $response) {
	$email = $request->getParam('email');
	$employee = new Employee();
	$result = $employee->getByEmail($email);
    $response = $response->withJson($result);
    return $response;
});

$app->run();
