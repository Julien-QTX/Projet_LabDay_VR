<?php
require_once "../../src/init.php";

function update($db) {
    $update_avatar = $db->prepare('UPDATE avatars SET skin_color=?, shirt_color=?, pants_color=?, hair_color=? WHERE user_id = ?');
    $update_avatar->execute(['#' . $_GET['skin'], '#' . $_GET['shirt'], '#' . $_GET['pants'], '#' . $_GET['hair'] , $_SESSION['user_id']]);
}

function get($db) {

    $get_name = $db->prepare('SELECT * FROM users WHERE pseudo = ?');
    $get_name->execute([$_GET['name']]);
    $name = $get_name->fetch();

    $get_avatar = $db->prepare('SELECT * FROM avatars WHERE user_id=?');
    $get_avatar->execute([$name['user_id']]);
    $avatar = $get_avatar->fetch();

    $json_data = json_encode($avatar);

    echo $json_data;
}

if($_GET['action'] == 'update') {
    update($db);
}
if($_GET['action'] == 'get') {
    get($db);
}