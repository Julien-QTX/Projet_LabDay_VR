<?php

require_once __DIR__ . "/../../src/init.php";
//delete messages older than 1 hour
$usr_cnt = $db->prepare("DELETE FROM ChatGlobal WHERE `date` < DATE_SUB(NOW(), INTERVAL 1 HOUR)");
$usr_cnt->execute();

?>