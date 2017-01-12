<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'controllers/employee.php';
require 'functions/functions.php';

$app = new \Slim\App;

$container = $app->getContainer();

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('templates', [
        'cache' => 'templates/cache'
    ]);
    
    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};

# http://localhost:8080/api/v1/employees
$app->get('/api/v1/employees', function (Request $request, Response $response) {	
	$employee = new Employee();
	$result = $employee->getAll();
    return $this->view->render($response, 'index.html', [
        'employees' => $result
    ]);
});

# http://localhost:8080/api/v1/employees/574daa378cb97f935a5c8e2e
$app->get('/api/v1/employees/{id}', function (Request $request, Response $response) {
	$id = $request->getAttribute('id');
	$employee = new Employee();
	$result = $employee->getById($id);
    return $this->view->render($response, 'detail.html', [
        'employee' => $result, 'id' => $id
    ]);
});

# http://localhost:8080/api/v1/searchs/employee?email=chasitycarver@fanfare.com
$app->get('/api/v1/searchs/employee', function (Request $request, Response $response) {
	$email = $request->getParam('email');
	$employee = new Employee();
	$result = $employee->getByEmail($email);
    return $this->view->render($response, 'search.html', [
        'employee' => $result
    ]);
});

# http://localhost:8080/api/v1/searchs/salary?min=100&max=1,291.57
$app->get('/api/v1/searchs/salary', function (Request $request, Response $response) {
	$min = $request->getParam('min');
	$max = $request->getParam('max');
	$employee = new Employee();
	$result = $employee->getBySalary($min, $max);
	$xml = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"utf-8\" ?><Salaries></Salaries>");
	$node = $xml->addChild('request');

	array_to_xml($result, $node);

	$response = $response->withHeader('Content-type', 'text/xml');
    $response->getBody()->write($xml->asXML());
    return $response;
});

$app->run();
