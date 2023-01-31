<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $page_title; ?></title>
	<?= $head_metas ;?>
	<link rel="stylesheet" href="assets/CSS/header.css">
	<link rel="stylesheet" href=assets/CSS/footer.css>
  </head>
  <body>
     
	<div>
		<?php include_once __DIR__ . '/partials/menu.php'; ?>
	</div>
	
	<?= $page_content ;?>
	<?= $page_scripts ;?>

	<div>
		<?php include_once __DIR__ . '/partials/footer.php'; ?>
	</div>
	
	</body>
</html>