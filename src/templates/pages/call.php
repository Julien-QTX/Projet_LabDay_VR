<?php 

require_once __DIR__ . '/../../init.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: /?page=login');
}

$page_title = "Appel";

ob_start();

?>
<link rel="stylesheet" href="assets/CSS/call.css">
<script src="https://aframe.io/releases/1.4.0/aframe.min.js"></script>
<!--   used for the pretty environment   -->
<script src="https://unpkg.com/aframe-environment-component@1.3.2/dist/aframe-environment-component.min.js"></script>

    <div id="videos">
        <video class="video-player" id="user-1" autoplay playsinline></video>
        <!--<video class="video-player" id="user-2" autoplay playsinline></video>-->
    </div>

    <div id="controls">

        <div class="control-container" id="camera-btn">
            <img src="assets/images/camera2.png" width="70">
        </div>

        <div class="control-container" id="mic-btn">
            <img src="assets/images/mic2.png" width="70">
        </div>

        <a href="/?page=call">
            <div class="control-container" id="leave-btn">
                <img src="assets/images/phone2.png" width="70">
            </div>
        </a>

    </div>

    <a-scene>
        <a-asset>
            <video src="" id="user-2" autoplay playsinline></video>
        </a-asset>
        <a-video src="#user-2" id="a-frame-user-2" width="16" height="9" position="3 5 -20" rotation="0 180 0"></a-video>
        <a-camera id="camera" position="0 10 0"></a-camera>
        
        <a-entity environment="preset:forest;"></a-entity>
        <!--<a-box id="box-n-1" position="3 5 -10" rotation="0 0 0"></a-box>-->
    </a-scene>

    <script src="assets/JS/agora-rtm-sdk-1.5.1.js"></script>
    <script src="assets/JS/peerConnection.js" defer></script>
    <!--<script src="assets/JS/trois.js"></script>-->

<?php
$page_content = ob_get_clean();
?>