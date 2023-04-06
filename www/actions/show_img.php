<?php

require_once __DIR__.'/../../src/init.php';

//get the user's profile picture
$profile_picture = $db->prepare("SELECT * FROM users WHERE user_id=?");
$profile_picture->setFetchMode(PDO::FETCH_ASSOC);
$profile_picture->execute([$_SESSION['user_id']]);
$tab = $profile_picture->fetchAll();

if (!$tab[0]['img'] == '') {
    echo $tab[0]['img'];
}
else {
    echo file_get_contents(__DIR__.'/../assets/images/def.jpeg');
}
