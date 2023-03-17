<?php 

require_once __DIR__ . '/../../init.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: /?page=login');
}

$usr_info = $db->prepare("SELECT pseudo FROM users WHERE user_id=?");
$usr_info->execute([$_SESSION['user_id']]);
$info = $usr_info->fetch();

$page_title = "Appel";

ob_start();

?>
<link rel="stylesheet" href="assets/CSS/call.css">
<script src="https://aframe.io/releases/1.4.0/aframe.min.js"></script>
<!--   used for the pretty environment   -->
<script src="https://unpkg.com/aframe-environment-component@1.3.2/dist/aframe-environment-component.min.js"></script>

<p id="user_pseudo"><?= $info['pseudo'] ?></p>

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
        <a-entity scale="3 3 3" id="text_entity">
            <a-text id="username" rotation="0 180 0"></a-text>
        </a-entity>
        
        <a-video src="#user-2" width="16" height="9" position="-100 -100 -100" rotation="0 0 0"></a-video>
        <a-camera id="camera" position="0 10 0"></a-camera>

        <a-entity id="a-frame-user-2" position="0 1.6 -2" scale="1 1 1">
          <a-entity id="head" position="0 1.6 0" sc>
            <a-box color="#FFE4C4" position="0 -0.4 0" depth="0.1" height="0.2" width="0.2"></a-box>
            <!--<a-box color="red" position="0 -0.08 0" scale="0.5 0.5 0.5"></a-box>-->
            <a-entity geometry="primitive:box;" material="src:#user-2" position="0 -0.08 0" scale="0.5 0.5 0.5"></a-entity>
          </a-entity>
          <a-entity id="torso" rotation="0 90 0" position="0 1.2 0">
            <a-box color="#6B8E23" position="0 -0.4 0" depth="0.5" height="0.8" width="0.3"></a-box>
          </a-entity>
          <a-entity id="left-arm" position="-0.5 1.3 0">
            <a-box color="#FFE4C4" position="0 -0.5 0" depth="0.3" height="0.8" width="0.3"></a-box>
          </a-entity>
          <a-entity id="right-arm" position="0.5 1.3 0">
            <a-box color="#FFE4C4" position="0 -0.5 0" depth="0.3" height="0.8" width="0.3"></a-box>
          </a-entity>
          <a-entity id="left-leg" position="-0.2 0.4 0">
            <a-box color="#0000CD" position="0 -0.5 0" depth="0.3" height="1" width="0.3"></a-box>
          </a-entity>
          <a-entity id="right-leg" position="0.2 0.4 0">
            <a-box color="#0000CD" position="0 -0.5 0" depth="0.3" height="1" width="0.3"></a-box>
          </a-entity>
        </a-entity>
        
        <a-entity environment="preset:arches;" id="environment"></a-entity>
        <!--<a-box id="box-n-1" position="3 5 -10" rotation="0 0 0"></a-box>-->
    </a-scene>

    <script src="assets/JS/agora-rtm-sdk-1.5.1.js"></script>
    <script src="assets/JS/peerConnection.js" defer></script>
    <!--<script src="assets/JS/trois.js"></script>-->

<?php
$page_content = ob_get_clean();
?>