<?php
session_start();

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';

//fonctions utilitaires
require_once __DIR__ . '/utils/errors.php';

//pages existantes sur notre site internet
$pages = ['home', 'login', 'signup', 'operations', 'account_verification', 'operations/deposit', 'operations/withdraw', 'operations/transaction', 'operations/conversion',
'operations/conversion', 'operation_verification', 'profile'
];

//init variables vides pour le template
$head_metas = "";
$page_content = "";
$page_scripts = "";