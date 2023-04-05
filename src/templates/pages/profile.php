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
<link rel="stylesheet" href="assets/CSS/profile.css">
<?php

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
    <h3><?= $info['pseudo']; ?></h3>
    <h3><?= $info['email']; ?></h3>

    <a href="/?page=profile_modif"><i class="fa-solid fa-pen"></i></a>
</div>

<form class="bar">


    <?php
    
    $usr_info = $db->prepare("SELECT * FROM users");
    $data = $usr_info->fetchAll();

    for($i=0; $i < sizeof($data); $i++){

        if(!in_array($data[$i]['pseudo'], $user_check)){
            $data[$i]['pseudo'] . "<a href='../../../www/actions/amis.php?action=add&pseudo=" . $data[$i]['pseudo'] . "'>Inviter un ami</a>";
        }    
        
    }

     

    ?>




    <label for="search">Rechercher un utilisateur :</label>
    <input type="text" id="search" name="search">
    <button type="submit">Rechercher</button>
</form>

<div class="demandeAmi">

    <?php 

    $usr_info = $db->prepare("SELECT * FROM amis WHERE username_1 = :username_1 OR username_2 = :username_2");
    $usr_info->execute([
        "username_1" => $_SESSION['user_id'],
        "username_2" => $_SESSION['user_id']
    ]);

    $data = $usr_info->fetchAll();

    for($i=0; $i < sizeof($data); $i++){

        if($data[$i]['is_pending'] == true && $data[$i]['username_2'] == $_SESSION['user_id']){
            echo $data[$i]['username_1'] . "<a href='../../../www/actions/amis.php?action=accepte&id=" . $data[$i]['id'] . "'>Accepté</a> <a href='../../../www/actions/amis.php?action=delete&id=" . $data[$i]['id'] . "'>Refusé</a>";
            $user_check[] = $data[$i]['username_1'];
        }    
        
    }
    ?>

</div>


<div id="ami">

    <?php 
    
    for($i=0; $i < sizeof($data); $i++){

        if($data[$i]['username_1'] == $_SESSION['user_id']){

            echo $data[$i]['username_2']  . "<a href='../../../www/actions/amis.php?action=delete&id=" . $data[$i]['id'] . "'>Supprimer</a>";
            $user_check[] = $data[$i]['username_2'];

            if($data[$i]['is_pending'] == true){
                echo "(En attente d'être accepté)";
            }    
        }
        else{
            if($data[$i]['is_pending'] == false){
                echo $data[$i]['username_1']  . "<a href='../../../www/actions/amis.php?action=delete&id=" . $data[$i]['id'] . "'>Supprimer</a>";
                $user_check[] = $data[$i]['username_1'];
            } 
        }
        echo '<br />';
    }

    ?>
    <table cellpadding="25" style="text-align: center;">
        <thead>
            <th>ami(e)</th>
            <th>PP</th>
            <th>Pseudo</th>
        </thead>
        <tr>
            <td>
                <label class="container">
                    <input type="checkbox" checked="checked">
                    <span class="checkmark"></span>
                </label>
            </td>
            <td><img src="" alt=""></td> 
            <td> <?php //echo $_POST['pseudo']?> </td>
        </tr>
    </table>
        
</div>
<script src="./ami.js"></script>

<?php

$page_content = ob_get_clean();

?>