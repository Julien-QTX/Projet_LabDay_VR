<?php
$user = true;
require_once __DIR__ . '/../../init.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: /?page=login');
}

$page_title = "Accueil";

ob_start();

?>
<link rel="stylesheet" href="assets/CSS/profile.css">
<?php
    // Get user info
    include_once __DIR__ . '/../../utils/alert_errors.php';

    $usr_info = $db->prepare("SELECT * FROM users WHERE user_id=?");
    $usr_info->execute([$_SESSION['user_id']]);
    $info = $usr_info->fetch();
    
?>
<div id="infos">
    <h1>PROFIL</h1>

    <div id="pfp">
        <img src="<?= $info['img'] ?>" alt="profile picture" id="pic">
    </div>

    <h3><?= $info['name']; ?></h3>
    <h3><?= $info['pseudo']; ?></h3>
    <h3><?= $info['email']; ?></h3>

    <a href="/?page=profile_modif"><i class="fa-solid fa-pen"></i></a>
</div>
<?php

$page_content = ob_get_clean();

?>