<?php

require_once __DIR__ . "/../../src/init.php";
//delete messages older than 1 hour
$usr_cnt = $db->prepare("DELETE from ChatGlobal WHERE date < now() - INTERVAL 1 HOUR");
$usr_cnt->execute();

?>