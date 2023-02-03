<?php 

$page_title = "Connexion";

$head_metas = "<link rel=stylesheet href=assets/CSS/login.css>";


ob_start();


/*if (isset($_SESSION['user_id'])) {
    echo "Session id = " . $_SESSION['user_id'][0];
}*/

?>

<div class="center">

   
    <div id="center" class="login-box">
    <h2>Connexion</h2>
    


    <form form action="/actions/login.php" method="post" id="login_form">
        
    
        
            <?php

            include_once __DIR__ . '/../../utils/alert_errors.php';

            ?>

        
            <div class="user-box">
                <input type="text" id="email" name="email" required>
                <label for="email">Email</label>
                
                
            </div>
            <div class="user-box">
                <input type="password" id="password" name="password" required>
                <label for="password">Mot de Passe</label>
                
            </div>
        
                <button class="sub" type="submit">connexion</button>
            
    </form>
    </div>


    </div>
</div>
<?php

$page_content = ob_get_clean();
