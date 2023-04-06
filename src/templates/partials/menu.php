<ul>
    <li class="boutton"><a href="/?page=home">Accueil</a></li>

    <?php if (!isset($_SESSION['user_id'])) { ?>

        <div class="side_btns">
            <li><a href="/?page=register">Inscription</a></li>
            <li><a href="/?page=login">Connexion</a></li>
        </div>

    <?php } else { ?>

        <li><a href="/?page=profile">Profil</a></li> 
        <li><a href="/?page=lobby">Appel</a></li>
        <li><a href="/?page=chatGlobal">Chat global</a></li>

        <div class="side_btns">
            <li class="logout_btn"><a href="/www/actions/logout.php">Déconnexion</a></li>
        </div>
    
    <?php    } ?>
   
</ul>
