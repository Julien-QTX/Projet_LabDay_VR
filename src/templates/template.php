<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $page_title; ?></title>
	<?= $head_metas ;?>
	<?php
	if (!strpos($_SERVER['REQUEST_URI'], 'call')) {
			echo '<link rel="stylesheet" href="assets/CSS/header.css">';
			echo '<link rel="stylesheet" href=assets/CSS/footer.css>';
		}
	?>
  </head>
  <body>
     
	<div>
		<?php
		if (!strpos($_SERVER['REQUEST_URI'], 'call')) {
			include_once __DIR__ . '/partials/menu.php';
		}
		?>
	</div>
	
	<?= $page_content ;?>
	<?= $page_scripts ;?>

	<div>
		<?php 
		if (!strpos($_SERVER['REQUEST_URI'], 'call')) {
			include_once __DIR__ . '/partials/footer.php';
		}
		 ?>
	</div>
	
	</body>
	<?php

	if (strpos($_SERVER['REQUEST_URI'], 'call')) {
			echo '<script src="assets/JS/agora-rtm-sdk-1.5.1.js"></script>';
			echo '<script src="assets/JS/main.js"></script>';
		}

	?>

</html>