<?php

session_set_cookie_params(0);
session_start();

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';

//fonctions utilitaires
require_once __DIR__ . '/utils/errors.php';

//pages existantes sur notre site internet
$pages = ['home', 'login', 'register', 'profile', 'call', 'lobby', 'vrtest'];

//init variables vides pour le template
$head_metas = "";
$page_content = "";
$page_scripts = "";