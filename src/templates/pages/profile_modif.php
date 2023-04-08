<?php
$user = true;
require_once __DIR__ . '/../../init.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: /?page=login');
}

$page_title = "Profile";

ob_start();

?>
<link rel="stylesheet" href="www/assets/CSS/profile_modif.css">
<?php
    // Get user info
    $usr_info = $db->prepare("SELECT * FROM users WHERE user_id=?");
    $usr_info->execute([$_SESSION['user_id']]);
    $info = $usr_info->fetch();

    $getAvatar = $db->prepare('SELECT * FROM avatars WHERE user_id = ?');
    $getAvatar->execute([$_SESSION['user_id']]);
    $result = $getAvatar->fetch();

    //echo $result['skin_color']
?>

<div class="center">
    <div class="login-box">
        <form action="www/actions/edit.php" method="post" enctype="multipart/form-data">

            <?php

            include_once __DIR__ . '/../../utils/alert_errors.php';

            ?>

            <h2>Modification du profil</h2>

            <div class="user-box">
                <input type="text" name="fullname" id="fullname" required value="<?= $info['name']?>">
                <label for="fullname">Nom complet</label>
            </div>

            <div class="user-box">
                <input type="text" name="pseudo" id="pseudo" required value="<?= $info['pseudo']?>">
                <label for="pseudo">Pseudo</label>
            </div>

            <div id="php">
                <img src="<?= $info['img']?>" alt="" id="pic">
            </div>

            <div class="user-box">
                <input type="file" name="profile_pic" id="profile_pic" accept="image/*" value="<?= $info['img']?>">
                <label for="profile_pic">Image de Profil</label>
            </div>

            <button type="submit">Sauvegarder</button>

        </form>

    </div>
</div>
<?php

$page_content = ob_get_clean();

?>