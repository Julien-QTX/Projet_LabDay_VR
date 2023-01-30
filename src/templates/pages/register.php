<?php

$page_title = "Inscription";

$head_metas = "<link rel=stylesheet href=assets/CSS/register.css>";

ob_start();

?>

<h1>Inscription</h1>

<?php

if (isset($_SESSION['user_id'])) {
    echo "Session id = " . $_SESSION['user_id'];
}

?>

<div id="center">

    <form action="actions/register.php" method="post">

        <?php

        include_once __DIR__ . '/../../utils/alert_errors.php';

        ?>

        <label for="fullname">Nom complet</label>
        <input type="text" name="fullname" id="fullname">

        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo">

        <label for="email">Email</label>
        <input type="email" name="email" id="email">

        <label for="fullname">Mot de Passe</label>
        <input type="password" name="password" id="password">

        <label for="fullname">Confirmation du Mot de Passe</label>
        <input type="password" name="cpassword" id="cpassword">

        <button type="submit">Inscription</button>

    </form>
    
</div>

<?php

$page_content = ob_get_clean();