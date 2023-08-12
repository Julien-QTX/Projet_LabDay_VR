<?php 

require_once __DIR__ . '/../../init.php';

$head_metas = "<link rel=stylesheet href=www/assets/CSS/avatar_modif.css>";

if (!isset($_SESSION['user_id'])) {
    header('Location: /?page=login');
}

$page_title = "Aframe";

ob_start();

?>

<!-- <script src="https://aframe.io/releases/1.4.0/aframe.min.js"></script> -->
<!-- <script src="https://unpkg.com/aframe-particle-system-component@1.0.x/dist/aframe-particle-system-component.min.js"></script>
<script src="https://unpkg.com/aframe-extras.ocean@%5E3.5.x/dist/aframe-extras.ocean.min.js"></script>
<script src="https://unpkg.com/aframe-gradient-sky@1.4.2/dist/gradientsky.min.js"></script> -->

<script src="https://aframe.io/releases/0.5.0/aframe.min.js"></script>
    <script src="https://unpkg.com/aframe-animation-component@3.2.1/dist/aframe-animation-component.min.js"></script>
    <script src="https://unpkg.com/aframe-particle-system-component@1.0.x/dist/aframe-particle-system-component.min.js"></script>
    <script src="https://unpkg.com/aframe-extras.ocean@%5E3.5.x/dist/aframe-extras.ocean.min.js"></script>
    <script src="https://unpkg.com/aframe-gradient-sky@1.0.4/dist/gradientsky.min.js"></script>
    <script src="https://unpkg.com/aframe-extras.tube@%5E3.5.x/dist/aframe-extras.tube.min.js"></script>

<a href="/?page=home">Retour</a>

<a-scene>

    <a-entity id="rain" particle-system="preset: rain; color: #24CAFF; particleCount: 5000"></a-entity>

    <a-entity id="sphere" geometry="primitive: sphere"
                material="color: #EFEFEF; shader: flat"
                position="0 0.15 -5"
                light="type: point; intensity: 5"
                animation="property: position; easing: easeInOutQuad; dir: alternate; dur: 1000; to: 0 -0.10 -5; loop: true"></a-entity>

      <a-entity id="ocean" ocean="density: 20; width: 50; depth: 50; speed: 4"
                material="color: #9CE3F9; opacity: 0.75; metalness: 0; roughness: 1"
                rotation="-90 0 0"></a-entity>
      
      <a-entity id="sky" geometry="primitive: sphere; radius: 5000"
                material="shader: gradient; topColor: 235 235 245; bottomColor: 185 185 210"
                scale="-1 1 1"></a-entity>
      
      <a-entity id="light" light="type: ambient; color: #888"></a-entity>

    <!-- <a-box position="-1 0.5 -3" rotation="0 45 0" color="#4CC3D9"></a-box>
    <a-sphere position="0 1.25 -5" radius="1.25" color="#EF2D5E"></a-sphere>
    <a-cylinder position="1 0.75 -3" radius="0.5" height="1.5" color="#FFC65D"></a-cylinder>
    <a-plane position="0 0 -4" rotation="-90 0 0" width="4" height="4" color="#7BC8A4"></a-plane>
    <a-sky color="#ECECEC"></a-sky> -->

</a-scene>

<?php
$page_content = ob_get_clean();
?>