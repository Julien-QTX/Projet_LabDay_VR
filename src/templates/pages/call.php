<?php 

require_once __DIR__ . '/../../init.php';

$page_title = "Appel";

ob_start();

?>
<link rel="stylesheet" href="assets/CSS/call.css">

<h1 class="apell">Appel</h1>

<h1 class="destinataire">Nom du participant</h1>

<div class="call">

    
    
    <img src="assets/images/Decrocher.png" alt="decrocher" class="decrocher"><a href="JavaScript"></a></img>
    

    
    <img src="assets/images/Raccrocher.png" alt="raccrocher" class="decrocher"><a href="JavaScript"></a></img>
    

</div>


<?php
$page_content = ob_get_clean();
?>