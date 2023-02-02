<ul>
    <li class="boutton"><a href="/?page=home">Home</a></li>

    <?php if (!isset($_SESSION['user_id'])) { ?>

        <div class="side_btns">
            <li><a href="/?page=register">SignUp</a></li>
            <li><a href="/?page=login">Login</a></li>
        </div>

    <?php } else { ?>
        

        <li><a href="/?page=profile">Profil</a></li> 
        <li><a href="/?page=call">Call</a></li>
        <div class="side_btns">
            <li class="logout_btn"><a href="/actions/logout.php">Logout</a></li>
        </div>
    
    <?php    } ?>
   
</ul>
