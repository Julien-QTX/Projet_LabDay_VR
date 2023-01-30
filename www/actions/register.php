<?php

require_once __DIR__.'/../../src/init.php';

if (empty($_POST['fullname']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['cpassword'])) {
    echo "Veuillez remplir tous les champs";
}

if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
    echo "L'email n'est pas valide";
}

if (strlen($_POST['password']) < 8) {
    echo "Le mot de passe est trop court (il doit faire au moins 8 caractères)";
}

if ($_POST['password'] != $_POST['cpassword']) {
    echo "Les deux mots de passe sont différents";
}

$s = $db->prepare("SELECT email FROM users WHERE email=?");
$s->execute([$_POST['email']]);

if (!$s->rowCount() == 0) {
    echo "Cet email est déjà utilisé";
}

$s = $db->prepare("SELECT pseudo FROM users WHERE pseudo=?");
$s->execute([$_POST['pseudo']]);

if (!$s->rowCount() == 0) {
    echo "Ce pseudo est déjà utilisé";
}


?>