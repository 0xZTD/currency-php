<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->get("/currency", function (Request $request, Response $response, $args) {
    $ch = curl_init();
    $today = date('d/m/Y');
    curl_setopt($ch, CURLOPT_URL, "https://www.cbr.ru/scripts/XML_dynamic.asp?date_req1=$today&date_req2=$today&VAL_NM_RQ=R01235");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    $xmlobj = new SimpleXMLElement($output);
    $json = json_encode($xmlobj);
    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json');
});
$app->run();