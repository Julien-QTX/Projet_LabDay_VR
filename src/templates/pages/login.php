<?php 

$page_title = "Connexion";

$head_metas = "<link rel=stylesheet href=assets/CSS/login.css>";

ob_start();






if (isset($_SESSION['user_id'])) {
    echo "Session id = " . $_SESSION['user_id'][0];
}

?>


<div id="center" class="login-box">
  <h2>Login</h2>
  <form form action="/actions/login.php" method="post" id="login_form">
        <?php

        include_once __DIR__ . '/../../utils/alert_errors.php';

        ?>

    
        <div class="user-box">
            <label for="email">Email</label>
            <input type="text" id="email" name="email">
        </div>
        <div class="user-box">
            <label for="password">Mot de Passe</label>
            <input type="password" id="password" name="password">
        </div>
        <a href="#">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        Submit
        </a>
  </form>
</div>


</div>

<?php

$page_content = ob_get_clean();
