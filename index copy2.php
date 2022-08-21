<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
function connect_to_db()
{
	$dbconnection = new PDO('mysql:host=localhost;dbname=my_app','jm','pass123');
	return $dbconnection;
}

$app = new \Slim\App;

$app->get('/api', function(Request $request, Response $response)
{
	try
	{
		echo "test";
	}
	catch(PDOException $e)
	{
		echo '{"error":{"text":'.$e->getMessage().'}';
	}
});


$app->run();