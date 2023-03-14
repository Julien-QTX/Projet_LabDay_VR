<?php

require_once __DIR__.'/../../src/init.php';

if (empty($_POST['fullname']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['cpassword'])) {
    display_errors("Veuillez remplir tous les champs", "/?page=register");
}

if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
    display_errors("L'email n'est pas valide", "/?page=register");
}

if (strlen($_POST['password']) < 8) {
    display_errors("Le mot de passe est trop court (il doit faire au moins 8 caractères)", "/?page=register");
}

if ($_POST['password'] != $_POST['cpassword']) {
    display_errors("Les deux mots de passe sont différents", "/?page=register");
}

$email_used = $db->prepare("SELECT email FROM users WHERE email=?");
$email_used->execute([$_POST['email']]);

if ($email_used->rowCount() != 0) {
    display_errors("Cet email est déjà utilisé", "/?page=register");
}

$pseudo_used = $db->prepare("SELECT pseudo FROM users WHERE pseudo=?");
$pseudo_used->execute([$_POST['pseudo']]);

if ($pseudo_used->rowCount() != 0) {
    display_errors("Ce pseudo est déjà utilisé", "/?page=register");
}

$fullname = htmlspecialchars($_POST['fullname'], ENT_QUOTES, null, true);
$pseudo = htmlspecialchars($_POST['pseudo'], ENT_QUOTES, null, true);
//$fullname = htmlspecialchars($_POST['fullname'], ENT_QUOTES);
    
if (empty($_FILES['profile_pic']['name'])) {
    $target_file = './../assets/images/def.jpeg';

    $hashed_password = hash('sha256', $_POST['password']);

    $create_user = $db->prepare("INSERT INTO users(`name`, pseudo, email, `password`, img) VALUES(?, ?, ?, ?, ?)");
    $create_user->execute([
        $fullname, $pseudo, $_POST['email'], $hashed_password, $target_file
    ]);

}

else {
    $filename = $_FILES['profile_pic']['name'];
    $target_file = './../assets/users_pfp/'.$filename;

    // file extension
    $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
            
    $file_extension = strtolower($file_extension);

    // Valid image extension
    $valid_extension = array("png","jpeg","jpg", "svg", "webp");

    if(in_array($file_extension, $valid_extension)) {

        // Upload file
        if(move_uploaded_file($_FILES['profile_pic']['tmp_name'],$target_file)) {

            $hashed_password = hash('sha256', $_POST['password']);

            $create_user = $db->prepare("INSERT INTO users(`name`, pseudo, email, `password`, img) VALUES(?, ?, ?, ?, ?)");
            $create_user->execute([
                $fullname, $pseudo, $_POST['email'], $hashed_password, $target_file
            ]);

        }
        else {
            display_errors($target_file, "/?page=register");
        }
    }

}

$_SESSION['user_id'] = $db->lastInsertId();

header('Location: /?page=home')

?>