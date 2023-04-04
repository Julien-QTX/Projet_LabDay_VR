<?php

require_once __DIR__ . "/../../src/init.php";

$messageToSend = htmlspecialchars($_POST['sendMessage']);





header('Location: /?page=home');