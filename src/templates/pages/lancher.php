<link rel="stylesheet" href="assets/CSS/call.css">

<h1>Appel</h1>

<?php
//echo '<p>'.var_dump($user).'</p>';

/*if (isset($_SESSION['user_id'])) {
    echo '<p>'.$_SESSION['user_id'].'</p>';
}*/
?>
<div class="participant"><h1>Nom du participant</h1></div>

<div class="call">

    
    
    <img src="assets/images/Decrocher.png" alt="decrocher" class="decrocher"><a href="JavaScript"></a></img>
    

    
    <img src="assets/images/Raccrocher.png" alt="raccrocher" class="decrocher"><a href="JavaScript"></a></img>
    

</div>


<?php
$page_content = ob_get_clean();
?>