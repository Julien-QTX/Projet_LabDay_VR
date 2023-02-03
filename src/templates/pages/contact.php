<?php 
require_once __DIR__ . '/../../init.php';

if(!empty($_POST['pseudo'])){

    $query = $db->prepare("SELECT pseudo FROM users WHERE name = ? AND pseudo = ?");

    $query->execute([
        $_POST['name'],
        $_POST['pseudo']
    ]);

    $data = $query->fetchAll();
}

$query = $db->prepare("SELECT * FROM friends WHERE user1 = ? OR user2 = ?");

$query->execute([
    $_SESSION['user_id'],
    $_SESSION['user_id']
]);

$data = $query->fetchAll();

$page_title = "Contact";

ob_start();

?>
<link rel="stylesheet" href="assets/CSS/contact.css">

<h1>Contact</h1>
<?php
//echo '<p>'.var_dump($user).'</p>';

/*if (isset($_SESSION['user_id'])) {
    echo '<p>'.$_SESSION['user_id'].'</p>';
}*/
?>

<h2>Demande d'amis :</h2>

<?php 
    for ($i = 0; $i < sizeof($data); $i++){

        if($data[$i]['is_pending'] == false && $data[$i]['user2'] == $_SESSION['user_id']){
            echo $data[$i]['user1'] . "<a href='#'>  Accepté </a>";
        }
    }
?>



<h2>Liste d'amis :</h2>

<?php 
    for ($i = 0; $i < sizeof($data); $i++){

        if($data[$i]['user1'] == $_SESSION['user_id']){
            echo $data[$i]['user2'];

            if($data[$i]['is_pending'] == true){
                echo "En attente d'être accepté";
            }
        }else {
            if($data[$i]['is_pending'] == false){
                echo $data[$i]['user1'];
            }
        }
    }
?>

<h2>Autre utilisateur :</h2>

<?php
$page_content = ob_get_clean();
?>