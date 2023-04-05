<?php

require_once __DIR__ . "/../../src/init.php";

$langue = $_POST['langue'];

$usr_cnt = $db->prepare("SELECT * from ChatGlobal WHERE date >= now() - INTERVAL 1 HOUR AND langue = ?;");
$usr_cnt->execute([$langue]);
$info = $usr_cnt->fetchAll();

$json_data = json_encode($info);

header('Content-Type: application/json');

echo $json_data;

?>