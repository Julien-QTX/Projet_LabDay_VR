<?php
require_once "../../src/init.php";

if($_GET['action'] == "delete"){
    $query= $db->prepare("DELETE FROM amis WHERE username_1 = ? AND username_2 = ? OR username_1 = ? AND username_2 = ?");
    $query->execute([
        $_GET['other'],
        $_GET['you'],
        $_GET['you'],
        $_GET['other']
    ]);
    header("Location: /?page=profile");
    //$db->query("DELETE FROM amis WHERE id= " . $_GET['id']);
}

if($_GET['action'] == "add"){

    $query= $db->prepare("SELECT user_id FROM users WHERE pseudo = ?");
    $query->execute([
        $_GET['other']
    ]);
    $other_id = $query->fetch();

    if($query->rowCount() == 0){
        die();
        display_errors('hello', '/?page=profile');
    }

    $query= $db->prepare("SELECT * FROM amis WHERE username_1=? AND username_2=? OR username_1=? AND username_2=?");
    $query->execute([
        $_SESSION['user_id'],
        $other_id['user_id'],
        $other_id['user_id'],
        $_SESSION['user_id'],
    ]);

    if($query->rowCount() != 0){
        die();
        display_errors('hello', '/?page=profile');
    }

    $query = $db->prepare("INSERT INTO amis(username_1, username_2, is_pending) VALUES (?, ?, ?)");
    $query->execute([
        $_SESSION['user_id'],
        $other_id['user_id'],
        1
    ]);

    echo $other_id['user_id'];
}

if($_GET['action'] == "accepte"){
    $query= $db->prepare("UPDATE amis SET is_pending = 0 WHERE username_1 = ? AND username_2 = ?");
    $query->execute([
        $_GET['other'],
        $_GET['you']
    ]);
    header("Location: /?page=profile");
}
?>