<?php

require_once __DIR__.'/../../src/init.php';

if (empty($_POST['fullname']) || empty($_POST['pseudo'])) {
    display_errors("Veuillez remplir tous les champs", "/?page=profile_modif");
}

$pseudo_used = $db->prepare("SELECT pseudo FROM users WHERE pseudo=?");
$pseudo_used->execute([$_POST['pseudo']]);

$usr_info = $db->prepare("SELECT * FROM users WHERE user_id=?");
$usr_info->execute([$_SESSION['user_id']]);
$info = $usr_info->fetch();

if ($_POST['pseudo'] != $info['pseudo']) {

    if ($pseudo_used->rowCount() != 0) {
        display_errors("Ce pseudo est déjà utilisé", "/?page=profile_modif");
    }

}

$fullname = htmlspecialchars($_POST['fullname'], ENT_QUOTES, null, true);
$pseudo = htmlspecialchars($_POST['pseudo'], ENT_QUOTES, null, true);
    
if (empty($_FILES['profile_pic']['name'])) {

    $target_file = $info['img'];

    $create_user = $db->prepare("UPDATE users SET `name` = ?, `pseudo` = ?, img = ? WHERE user_id = ? ");
    $create_user->execute([
        $fullname, $pseudo, $target_file, $_SESSION['user_id']
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

            $create_user = $db->prepare("UPDATE users SET `name` = ?, `pseudo` = ?, img = ? WHERE user_id = ? ");
            $create_user->execute([
                $fullname, $pseudo, $target_file, $_SESSION['user_id']
            ]);

        }
        else {
            display_errors($target_file, "/?page=profile_modif");
        }
    }

}

header('Location: /?page=profile')

?>