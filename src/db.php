<?php

require_once __DIR__ . '/config.php';

//database connection
try {
    $dsn = 'mysql:host='.$config['db']['host'].';dbname='.$config['db']['name'].';port='.$config['db']['port'];
    $db = new PDO($dsn, $config['db']['user'], $config['db']['pass']);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (Exception $e){
    die('Erreur MySQL : ' . $e -> getMessage());
}

?>