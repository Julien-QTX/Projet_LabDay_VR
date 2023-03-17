<?php 

require_once __DIR__ . '/../../init.php';

$page_title = "Accueil";

ob_start();

?>
<link rel="stylesheet" href="assets/CSS/home.css">

<h1>Bienvenue sur VRC </h1>

<?php
//echo '<p>'.var_dump($user).'</p>';

/*if (isset($_SESSION['user_id'])) {
    echo '<p>'.$_SESSION['user_id'].'</p>';
}*/
?>

<button class="appel" onclick="window.location = '/?page=lobby'"><a href="/?page=lobby" class="lien">Lancer un appel VR</a></button>


<?php
$page_content = ob_get_clean();
?>