<?php

$page_title = "Inscription";

$head_metas = "<link rel=stylesheet href=assets/CSS/register.css>";

ob_start();

?>
<div class="center">
<div class="login-box">
    <h2>Inscription</h2>

    <form action="actions/register.php" method="post" enctype="multipart/form-data">

        <?php

        include_once __DIR__ . '/../../utils/alert_errors.php';

        ?>

    <div class="user-box">
        <input type="text" name="fullname" id="fullname" required>
        <label for="fullname">Nom complet</label>
    </div>

    <div class="user-box">
        <input type="text" name="pseudo" id="pseudo" required>
        <label for="pseudo">Pseudo</label>
    </div>

    <div class="user-box">
        <input type="text" name="email" id="email" required>
        <label for="email">Email</label>
    </div>

    <div class="user-box pass-box">
        <input type="password" name="password" id="password" required>
        <label for="fullname">Mot de Passe</label>
        <img src="assets/images/ceye2.png" width="25" id="pass-eye">
    </div>

    <div class="user-box">
        <input type="password" name="cpassword" id="cpassword" required>
        <label for="fullname">Confirmation du Mot de Passe</label>
        <img src="assets/images/ceye2.png" width="25" id="cpass-eye">
    </div>

    <div class="user-box">
        <input type="file" name="profile_pic" id="profile_pic" accept="image/*">
        <label for="profile_pic">Image de Profil</label>
    </div>

        <button type="submit">Inscription</button>

    </form>
    
</div>
</div>

<script src="assets/JS/password.js"></script>

<?php

$page_content = ob_get_clean();