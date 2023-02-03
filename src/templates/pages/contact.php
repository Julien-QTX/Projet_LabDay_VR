<?php 
session_start();
require_once __DIR__ . '/../../init.php';

$query = $db->prepare("SELECT * FROM friends WHERE username_1 = :username_1 OR username_2 = :username_2");

$query->execute([

    "username_1" -> $_SESSION['user'],
    "username_2" -> $_SESSION['user'],
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

        if($data[$i]['is_pending'] == false && $data[$i]['username_2'] == $_SESSION['user']){
            echo $data[$i]['username_1'] . "<a href='#'>Accepté </a>";
        }
    }
?>



<h2>Liste d'amis :</h2>

<?php 
    for ($i = 0; $i < sizeof($data); $i++){

        if($data[$i]['username_1'] == $_SESSION['user']){
            echo $data[$i]['username_2'];

            if($data[$i]['is_pending'] == true){
                echo "En attente d'être accepté";
            }
        }else {
            if($data[$i]['is_pending'] == false){
                echo $data[$i]['username_1'];
            }
        }
    }
?>

<h2>Autre utilisateur :</h2>

<?php
$page_content = ob_get_clean();
?>