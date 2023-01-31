<?php
$head_metas = "<link rel=stylesheet href=assets/CSS/header.css>";
?>

<ul>
    <li><a href="/?page=home">Home</a></li>

    <?php if (!isset($_SESSION['user_id'])) { ?>

        <li><a href="/?page=register">SignUp</a></li>
        <li><a href="/?page=login">Login</a></li>

    <?php } else { ?>
        

        <li><a href="/?page=profile">Profil</a></li> 
        <li><a href="/?page=call">Call</a></li>      
        <li><a href="/actions/logout.php">Logout</a></li>
    
    <?php    } ?>
   
</ul>