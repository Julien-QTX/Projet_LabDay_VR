<?php

session_start();
session_unset();
session_destroy();

// logouts the user
header('Location: /?page=home')

?>