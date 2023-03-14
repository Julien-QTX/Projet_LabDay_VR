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

    <div id="videos">
        <!--<video class="video-player" id="user-1" autoplay playsinline></video>-->
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
            <video src="" id="user-1" autoplay></video>
            <video src="" id="user-2" autoplay></video>
        </a-asset>

        <a-entity id="cubeP1" rotation="0 0 0" position="5 1.7 -10">
            <a-plane id="front" material="shader: flat; src: #user-1" height="1" width="1" position="0 0 0.5"></a-plane>
            <a-plane id="back" material="shader: flat; color: red" height="1" width="1" position="0 0 -0.5" rotation="0 180 0"></a-plane>
            <a-plane id="left" material="shader: flat; color: blue" height="1" width="1" position="-0.5 0 0" rotation="0 -90 0"></a-plane>
            <a-plane id="right" material="shader: flat; color: yellow" height="1" width="1" position="0.5 0 0" rotation="0 90 0"></a-plane>
            <a-plane id="top" material="shader: flat; color: green" height="1" width="1" position="0 0.5 0" rotation="-90 0 0"></a-plane>
            <a-plane id="bottom" material="shader: flat; color: purple" height="1" width="1" position="0 -0.5 0" rotation="-90 0 0"></a-plane>
        </a-entity>

        <a-entity id="cubeP2" rotation="0 0 0" position="3 1.7 -10">
            <a-plane id="front" material="shader: flat; src: #user-2" height="1" width="1" position="0 0 0.5"></a-plane>
            <a-plane id="back" material="shader: flat; color: red" height="1" width="1" position="0 0 -0.5" rotation="0 180 0"></a-plane>
            <a-plane id="left" material="shader: flat; color: blue" height="1" width="1" position="-0.5 0 0" rotation="0 -90 0"></a-plane>
            <a-plane id="right" material="shader: flat; color: yellow" height="1" width="1" position="0.5 0 0" rotation="0 90 0"></a-plane>
            <a-plane id="top" material="shader: flat; color: green" height="1" width="1" position="0 0.5 0" rotation="-90 0 0"></a-plane>
            <a-plane id="bottom" material="shader: flat; color: purple" height="1" width="1" position="0 -0.5 0" rotation="-90 0 0"></a-plane>
        </a-entity>
    </a-scene>

    <script src="assets/JS/agora-rtm-sdk-1.5.1.js"></script>
    <script src="assets/JS/peerConnection.js"></script>

<?php
$page_content = ob_get_clean();
?>