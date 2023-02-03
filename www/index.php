<?php
require_once __DIR__ . "/../src/init.php";

$page = 'home';

if (isset($_GET['page'])) {
    if (in_array($_GET['page'], $pages)) {
        $page = $_GET['page'];
    }
}

/*if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 300)) {
    // dernière activité de plus de 30 minutes
    session_unset();     // dégage toutes les variables de session
    session_destroy();   // détruit la session
}
$_SESSION['LAST_ACTIVITY'] = time(); // met à jour la dernière activité*/

include_once __DIR__ . "/../src/templates/pages/$page.php";
include_once __DIR__ . "/../src/templates/template.php";