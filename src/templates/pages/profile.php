<?php
$user = true;
require_once __DIR__ . '/../../init.php';

$page_title = "Accueil";

ob_start();

?>
<link rel="stylesheet" href="assets/CSS/profile.css">
<h1>PROFILE</h1>

<div id="pfp"></div>

<?php

$usr_info = $db->prepare("SELECT * FROM users WHERE user_id=?");
$usr_info->execute([$_SESSION['user_id']]);
$info = $usr_info->fetch();

?>

<h2>Name: <?= $info['name']; ?></h2>
<h2>Username: <?= $info['pseudo']; ?></h2>
<h2>Email: <?= $info['email']; ?></h2>

<?php

$page_content = ob_get_clean();

?>