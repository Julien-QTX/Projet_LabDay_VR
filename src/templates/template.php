<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="www/assets/images/vr.png" type="image/x-icon">
	<link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
    <title><?= $page_title; ?></title>
	<?= $head_metas ;?>
	<?php
	if (!strpos($_SERVER['REQUEST_URI'], 'call')) {
			echo '<link rel="stylesheet" href="www/assets/CSS/header.css">';
			echo '<link rel="stylesheet" href=www/assets/CSS/footer.css>';
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