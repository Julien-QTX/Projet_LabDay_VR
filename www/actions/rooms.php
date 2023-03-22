<?php

require_once __DIR__.'/../../src/init.php';


function getRooms($db) {
    $usr_info = $db->prepare("SELECT * FROM rooms");
    $usr_info->execute();
    return $usr_info->fetchAll();
}

function addRoom($db, $users, $room_id, $bg) {
    $create_room = $db->prepare("INSERT INTO rooms(`users`, room_id, background) VALUES(?, ?, ?)");
    $create_room->execute([$users, $room_id, $bg]);
}

function delRoom($db, $room_id) {
    $delete_room = $db->prepare("DELETE FROM rooms WHERE room_id = ?");
    $delete_room->execute([$room_id]);
}

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'add') {
        addRoom($db, 1, $_GET['room'], $_GET['background']);
        header('Location: /?page=call&room='.$_GET['room'].'&background='.$_GET['background']);
    }
    else if ($_GET['action'] == 'show'){
        getRooms($db);
    }
    else if ($_GET['action'] == 'delete') {
        delRoom($db, $_GET['room']);
        header('Location: /?page=lobby');
    }
}

