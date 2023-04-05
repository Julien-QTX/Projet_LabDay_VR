<?php
require_once "../../src/db.php";

if($_GET['action'] == "delete" || $_GET['action'] == "deny"){
    $db->query("DELETE FROM amis WHERE id= " . $_GET['id']);
    header('Location:../../src/templates/pages/profile.php');
}
if($_GET['action'] == "add"){
    $query= $db->prepare("INSERT INTO amis(username_1, username_2, is_pending) VALUE :username_1, :username_2, :is_pending");
    $query->execute([
        "username_1" => $_SESSION['user_id'],
        "username_2" => $_SESSION['pseudo'],
        "is_pending" => 1
    ]);
    header('Location:../../src/templates/pages/profile.php');
}
if($_GET['action'] == "accepte"){
    $db->query("UPDATE amis SET is_pending = 0 WHERE id=" . $_GET['id']);
    header('Location:../../src/templates/pages/profile.php');
}
?>