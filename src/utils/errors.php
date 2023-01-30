<?php

function display_errors($message, $url) {
    $_SESSION['error_message'] = $message;
    header('Location:' . $url);
    die();
}

?>