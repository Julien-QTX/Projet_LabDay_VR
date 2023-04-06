<?php

session_set_cookie_params(0);
session_start();

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';

//utility functions
require_once __DIR__ . '/utils/errors.php';

//existing pages on the website
$pages = ['home', 'login', 'register', 'profile', 'call', 'lobby', 'profile_modif', 'chatGlobal'];

//init variables empty for the template by default
$head_metas = "";
$page_content = "";
$page_scripts = "";