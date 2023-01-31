<?php
$user = true;
require_once __DIR__ . '/../../init.php';

$page_title = "Accueil";

ob_start();

?>
<link rel="stylesheet" href="assets/CSS/profile.css">
<h1>PROFILE</h1>

<?php

    include_once __DIR__ . '/../../utils/alert_errors.php';

    $usr_info = $db->prepare("SELECT * FROM users WHERE user_id=?");
    $usr_info->execute([$_SESSION['user_id']]);
    $info = $usr_info->fetch();
?>
<div id="infos">
    <div id="pfp">
        <img src="actions/show_img.php" alt="profile picture" id="pic">
        <!--<img src="assets/images/def.jpeg" alt="profile picture" id="pic">-->
    </div>

    <h2>Name: <?= $info['name']; ?></h2>
    <h2>Username: <?= $info['pseudo']; ?></h2>
    <h2>Email: <?= $info['email']; ?></h2>
</div>
<?php

$page_content = ob_get_clean();

?>