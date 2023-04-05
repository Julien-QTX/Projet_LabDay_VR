<?php

require_once __DIR__ . "/../../src/init.php";

$usr_cnt = $db->prepare("DELETE from ChatGlobal WHERE date < now() - INTERVAL 1 HOUR");
$usr_cnt->execute();

?>