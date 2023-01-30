<?php 

require_once __DIR__ . '/../../init.php';

$page_title = "Appel";

ob_start();

?>
<link rel="stylesheet" href="assets/CSS/call.css">

<h1>Appel</h1>

<?php
//echo '<p>'.var_dump($user).'</p>';

/*if (isset($_SESSION['user_id'])) {
    echo '<p>'.$_SESSION['user_id'].'</p>';
}*/
?>



<?php
$page_content = ob_get_clean();
?>