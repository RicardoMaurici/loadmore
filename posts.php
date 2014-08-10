<?php
header('Content-Type: application/json');
$pdo = new PDO("mysql:host=localhost; dbname= ;charset=UTF8", "", ""); //conexao com o banco

$posts = [];

$start = isset($_GET['start']) ? (int)$_GET['start'] - 1 : 0;
$count = isset($_GET['count']) ? (int)$_GET['count'] : 1;

$post = $pdo->query("SELECT SQL_CALC_FOUND_ROWS * FROM publicacao LIMIT {$start}, {$count}");

$postsTotal = $pdo->query("SELECT FOUND_ROWS() AS count")->fetch(PDO::FETCH_ASSOC)['count'];

if($postsCount = $post->rowCount()){
	$posts = $post->fetchAll(PDO::FETCH_OBJ);
}

echo json_encode(array(
	'items' => $posts,
	'last' => ($start+$count) >= $postsTotal ? true : false,
	'start' => $start,
	'count' => $count
)); 

?>