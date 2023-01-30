<?php
$user = true;
require_once __DIR__ . '/../../init.php';

$page_title = "Accueil";

ob_start();

?>
<link rel="stylesheet" href="assets/CSS/profile.css">
<h1>PROFILE</h1>

<div id="pfp"></div>

<h2>name: </h2>
<h2>username: </h2>
<h2>email: </h2>

<?php

//echo '<p>'.var_dump($user).'</p>';



/*if (isset($_SESSION['user_id'])) {
    echo '<p>'.$_SESSION['user_id'].'</p>';
}*/

$page_content = ob_get_clean();

?>