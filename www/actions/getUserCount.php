<?php

require_once __DIR__ . "/../../src/init.php";

$usr_cnt = $db->prepare("SELECT COUNT(user_id) FROM users");
$usr_cnt->execute();
$info = $usr_cnt->fetch();

echo $info[0];
?>