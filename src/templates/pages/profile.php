<?php
$user = true;
require_once __DIR__ . '/../../init.php';
require_once __DIR__ . '/../../db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: /?page=login');
}

$page_title = "Accueil";

ob_start();

?>
<link rel="stylesheet" href="www/assets/CSS/profile.css">
<?php
    // Get user info
    include_once __DIR__ . '/../../utils/alert_errors.php';

    $usr_info = $db->prepare("SELECT * FROM users WHERE user_id=?");
    $usr_info->execute([$_SESSION['user_id']]);
    $info = $usr_info->fetch();

    if($_SESSION['user_id']){

        $user_check[] = $_SESSION['user_id'];

    }
    
?>
<div id="infos">
    <h1>PROFIL</h1>

    <div id="pfp">
        <img src="<?= $info['img'] ?>" alt="profile picture" id="pic">
    </div>

    <h3><?= $info['name']; ?></h3>
    <h3 id="username"><?= $info['pseudo']; ?></h3>
    <h3><?= $info['email']; ?></h3>

    <a href="/?page=profile_modif"><i class="fa-solid fa-pen"></i></a>
</div>

<form class="bar">

    <label for="search">Ajouter un ami :</label>
    <span id="p"></span>
    <div id="research">
        <div class="user-box">
            <input type="text" name="search" id="search" required>
            <label for="search">Pseudo</label>
        </div>
        <button type="submit">Rechercher</button>
    </div>
    
</form>

<div id="ami">

    <h3>Amis</h3>

    <?php 

    $usr_info = $db->prepare("SELECT * FROM amis WHERE username_1 = :username_1 OR username_2 = :username_1 AND is_pending=0");
    $usr_info->execute([
        "username_1" => $_SESSION['user_id']
    ]);

    $data = $usr_info->fetchAll();
    
    for($i=0; $i < sizeof($data); $i++){

        $usr_info = $db->prepare("SELECT * FROM users WHERE user_id=?");
        if($data[$i]['username_1'] == $_SESSION['user_id']) {
            $usr_info->execute([
            $data[$i]['username_2']
            ]);
        }
        else {
            $usr_info->execute([
            $data[$i]['username_1']
            ]);
        }
        
        $other_name = $usr_info->fetch();

        if(!$data[$i]['is_pending']) {

        echo '<div class="friend">';

        echo "<div id='pfp'>";
        echo '<img src="'. $other_name['img'] .'" alt="profile picture" id="pic">';
        echo  "</div>";
        echo $other_name['pseudo'];
        //echo "<a href='../../../www/actions/amis.php?action=delete&you=".$_SESSION['user_id'] . "&other=". $data[$i]['username_1'] ."'> Supprimer</a>";
        echo '</div>';
        echo '<br />';
        }

        
}

    ?>
        
</div>

<div class="demandeAmi">

    <h3>Demandes d'amis</h3>

    <h4>Demandes Reçues</h4>

    <?php 

    $usr_info = $db->prepare("SELECT * FROM amis WHERE username_2 = :username_2 AND is_pending=1");
    $usr_info->execute([
        "username_2" => $_SESSION['user_id']
    ]);

    $data = $usr_info->fetchAll();

    for($i=0; $i < sizeof($data); $i++){ 

        $usr_info = $db->prepare("SELECT pseudo FROM users WHERE user_id=?");
        $usr_info->execute([
            $data[$i]['username_1']
        ]);
        $other_name = $usr_info->fetch();

        if($data[$i]['is_pending'] == true && $data[$i]['username_2'] == $_SESSION['user_id']){

            echo "<div class='friend-request'>";

            echo "<p>Demande de ". $other_name['pseudo']; "</p>";
            echo "<a href='www/actions/amis.php?action=accepte&you=" . $_SESSION['user_id'] . "&other=". $data[$i]['username_1'] ."'> <i class='fa-solid fa-check'></i></a>";
            echo "<a href='www/actions/amis.php?action=delete&you=" . $_SESSION['user_id'] . "&other=". $data[$i]['username_1'] . "'><i class='fa-solid fa-xmark' id='chat-hider'></i></a>";

            echo "</div>";

        }    
        
    }
    ?>

    <h4>Demandes Envoyées</h4>

    <?php

    $usr_info = $db->prepare("SELECT * FROM amis WHERE username_1 = :username_1 AND is_pending=1");
    $usr_info->execute([
        "username_1" => $_SESSION['user_id']
    ]);

    $data = $usr_info->fetchAll();

    for($i=0; $i < sizeof($data); $i++){ 

        $usr_info = $db->prepare("SELECT pseudo FROM users WHERE user_id=?");
        $usr_info->execute([
            $data[$i]['username_2']
        ]);
        $other_name = $usr_info->fetch();

        //if($data[$i]['username_1'] == $_SESSION['user_id']){
    
          //  if($data[$i]['is_pending']) {

                echo "<div class='friend-request'> <p>";
                echo $other_name['pseudo'];
                echo " (En attente d'être accepté) ";
                echo "<a href='www/actions/amis.php?action=delete&you=".$_SESSION['user_id'] . "&other=". $data[$i]['username_2'] ."'> Annuler</a>";
                echo "</p></div>";

            //}
       //}
    }
    
    ?>

</div>

<script src="www/assets/JS/ami.js"></script>

<?php

$page_content = ob_get_clean();

?>