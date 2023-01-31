<?php

require_once __DIR__.'/../../src/init.php';

$profile_picture = $db->prepare("SELECT * FROM users WHERE user_id=?");
$profile_picture->setFetchMode(PDO::FETCH_ASSOC);
$profile_picture->execute([$_SESSION['user_id']]);
$tab = $profile_picture->fetchAll();

//display_errors('hello', "/?page=profile");

//display_errors($tab[0]['img'], "/?page=profile");

if (!$tab[0]['img'] == '') {
    echo $tab[0]['img'];
}
else {
    echo file_get_contents(__DIR__.'/../assets/images/def.jpeg');
}

//echo $tab[0]['img'];

?>