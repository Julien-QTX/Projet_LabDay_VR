<?php 

$page_title = "Connexion";

$head_metas = "<link rel=stylesheet href=assets/CSS/login.css>";

ob_start();

?>

<h1>Connexion</h1>

<div id="center">

<form action="/actions/login.php" method="post" id="login_form">

    <?php
    //include_once __DIR__ . '/../partials/alert_errors.php';
    //include_once __DIR__ . '/../partials/alert_success.php';
    ?>

    <div class="form_input">
        <label for="email">Email</label>
        <input type="text" id="email" name="email">
    </div>
    <div class="form_input">
        <label for="password">Mot de Passe</label>
        <input type="password" id="password" name="password">
    </div>

    <button type="submit">Login</button>

</form>

</div>

<?php

$page_content = ob_get_clean();
