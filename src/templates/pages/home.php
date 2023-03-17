<?php 

require_once __DIR__ . '/../../init.php';

$page_title = "Accueil";

ob_start();

?>
<link rel="stylesheet" href="assets/CSS/home.css">

<h1>Bienvenue sur VRC </h1>

<script>
setInterval(() => {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '/actions/getUserCount.php');
    xhr.onload = () => {
        document.getElementById("utilis").innerHTML = `utilisateurs: ${xhr.responseText}`;
    };
    xhr.send();
}, 1000);
</script>



<h3 id="utilis"></h3>

<button class="appel" onclick="window.location = '/?page=lobby'"><a href="/?page=lobby" class="lien">Lancer un appel VR</a></button>


<?php
$page_content = ob_get_clean();
?>