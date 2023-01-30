<?php
session_start();

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';

//fonctions utilitaires
require_once __DIR__ . '/utils/errors.php';

//pages existantes sur notre site internet
$pages = ['home', 'login', 'register', 'profile', 'call'];

//init variables vides pour le template
$head_metas = "";
$page_content = "";
$page_scripts = "";