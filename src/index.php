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
// comment 3

$app->get('/api/users', function(Request $request, Response $response)
{
	$sql_query="SELECT * FROM users";
	try
	{
		$datab = connect_to_db();
		$stmt = $datab->query($sql_query);
		$users = $stmt->fetchAll(PDO::FETCH_OBJ);
		$datab=null;
		echo json_encode($users);
	}
	catch(PDOException $e)
	{
		echo '{"error":{"text":'.$e->getMessage().'}';
	}
});
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
$app->get('/api/login', function(Request $request, Response $response)
{
	$name = $request->getParam('name');
	$password = $request->getParam('password');
	$sql_query="SELECT * FROM users where NAME = '$name' and PASSWORD = '$password'";
	try
	{
		$datab = connect_to_db();
		$stmt = $datab->query($sql_query);
		$users = $stmt->fetchAll(PDO::FETCH_OBJ);
		$datab=null;
		echo json_encode($users);
	}
	catch(PDOException $e)
	{
		echo '{"error":{"text":'.$e->getMessage().'}';
	}
});
$app->get('/api/online', function(Request $request, Response $response)
{
	$sql_query="SELECT * FROM onlinenow";
	try
	{
		$datab = connect_to_db();
		$stmt = $datab->query($sql_query);
		$users = $stmt->fetchAll(PDO::FETCH_OBJ);
		$datab=null;
		echo json_encode($users);
	}
	catch(PDOException $e)
	{
		echo '{"error":{"text":'.$e->getMessage().'}';
	}
});
	
$app->post('/api/users/add', function (Request $request, Response $response)
{
	$name = $request->getParam('Name');
	$pass = $request->getParam('Password');
	$sql_query="INSERT INTO users (name,password)VALUES (:name,:pass)";
	try
	{
		$datab=connect_to_db();
		$stmt=$datab->prepare($sql_query);
		$stmt->bindParam(':name',$name);
		$stmt->bindParam(':pass',$pass);
		$stmt->execute();
		$datab=null;
		echo '{"Result:{"text":"User Added"}';
	}
	catch (PDOException $e)
	{
		echo '{"error":{"text":'.$e->getMessage().'}';
	}
});
$app->post('/api/online/add', function (Request $request, Response $response)
{
	$name = $request->getParam('Name');
	$id = $request->getParam('id');
	$sql_query="INSERT INTO onlinenow (id,name)VALUES (:id,:name)";
	try
	{
		$datab=connect_to_db();
		$stmt=$datab->prepare($sql_query);
		$stmt->bindParam(':id',$id);
		$stmt->bindParam(':name',$name);
		$stmt->execute();
		$datab=null;
		echo '{"Result:{"text":"User Added"}';
	}
	catch (PDOException $e)
	{
		echo '{"error":{"text":'.$e->getMessage().'}';
	}
});

$app->delete('/api/online/delete', function (Request $request, Response $response)
{
	$id = $request->getParam('id');
	$sql_query="DELETE FROM onlinenow where id = '$id'";
	try
	{
		$datab=connect_to_db();
		$stmt=$datab->prepare($sql_query);
		$stmt->execute();
		$datab=null;
		echo '{"Result:{"text":"User Deleted"}';
	}
	catch (PDOException $e)
	{
		echo '{"error":{"text":'.$e->getMessage().'}';
	}
});


$app->run();