<?php
require_once __DIR__ . "/../../src/init.php";

//user message need here to be sent to the database
if (empty($_POST['message'])) {
    display_errors("Message vide", '/?page=chatGlobal');
}
$messageToDB = htmlspecialchars($_POST['message']);
$user_id = $_POST['user_id'];

$getUsername = $db->prepare("SELECT pseudo FROM users WHERE user_id=?");
$getUsername->execute([$user_id]);
$username = $getUsername->fetch();

$create_user = $db->prepare("INSERT INTO ChatGlobal(user_id, pseudo, `message`) VALUES(?, ?, ?)");
$create_user->execute([
    $user_id, $username[0], $messageToDB
]);