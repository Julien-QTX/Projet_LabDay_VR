<?php

require_once __DIR__ . "/../../src/init.php";

if (!isset($_POST['email'], $_POST['password'])) {
	display_errors('Erreur du formulaire', '/?page=login');
}

if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
	display_errors('Email invalide.', '/?page=login');
}

// Verifier si utilisateur existe en DB
$email_used = $db->prepare("SELECT email FROM users WHERE email=?");
$email_used->execute([$_POST['email']]);

if ($email_used->rowCount() == 0) {
    display_errors("Cet email n'est pas enregistré", "/?page=login");
}


// Verifier le mot de passe
$pass_good = $db->prepare("SELECT password FROM users WHERE email=?");
$pass_good->execute([$_POST['email']]);
$pass = $pass_good->fetch();

if ($pass == hash('sha256', $_POST['password'])) {
    display_errors("Le mot de passe est faux", "/?page=login");
}

// on verra pourquoi on ne stock que l'id
$usr = $db->prepare("SELECT user_id FROM users WHERE email=?");
$usr->execute([$_POST['email']]);
$us = $usr->fetch();

$_SESSION['user_id'] = $us;

header('Location: /?page=home');