<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="assets/images/vr.png" type="image/x-icon">
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

	
		<?php 
		if (!strpos($_SERVER['REQUEST_URI'], 'call')) {
			include_once __DIR__ . '/partials/footer.php';
		}
		 ?>
	
	
	</body>

</html>