<?php 

require_once __DIR__ . '/../../init.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: /?page=login');
}

$page_title = "Appel";

ob_start();

?>
<link rel="stylesheet" href="assets/CSS/call.css">

    <div id="videos">
        <video class="video-player" id="user-1" autoplay playsinline></video>
        <video class="video-player" id="user-2" autoplay playsinline></video>
    </div>

    <div id="controls">

        <div class="control-container" id="camera-btn">
            <img src="assets/images/cameraIcon.png" width="70">
        </div>

        <div class="control-container" id="mic-btn">
            <img src="assets/images/micIcon.png" width="70">
        </div>

        <a href="/?page=call">
            <div class="control-container" id="leave-btn">
                <img src="assets/images/phoneIcon.png" width="70">
            </div>
        </a>

    </div>

<?php
$page_content = ob_get_clean();
?>