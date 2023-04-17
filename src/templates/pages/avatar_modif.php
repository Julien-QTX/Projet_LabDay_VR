<?php 

require_once __DIR__ . '/../../init.php';

$head_metas = "<link rel=stylesheet href=www/assets/CSS/avatar_modif.css>";

if (!isset($_SESSION['user_id'])) {
    header('Location: /?page=login');
}

$page_title = "Appel";

ob_start();

$getAvatar = $db->prepare('SELECT * FROM avatars WHERE user_id = ?');
$getAvatar->execute([$_SESSION['user_id']]);
$result = $getAvatar->fetch();

//echo $result['skin_color'];
//echo $result['shirt_color'];
//echo $result['pants_color'];
//echo $result['hair_color'];


?>

<script src="https://aframe.io/releases/1.4.0/aframe.min.js"></script>

<a href="/?page=profile">Retour</a>

<a-scene>

    <a-camera wasd-controls-enabled="false" look-controls-enabled="false"></a-camera>

    <a-entity id="a-frame-user-2" position="0 0.9 -2" scale="1 1 1" rotation="0 45 0">
        <a-entity position="0 1.6 0">
        <a-box color="<?= $result['skin_color'] ?>" position="0 -0.4 0" depth="0.1" height="0.2" width="0.2" class="skin"></a-box>
        <!--<a-box color="red" position="0 -0.08 0" scale="0.5 0.5 0.5"></a-box>-->
        <a-entity position="0 -0.08 0" scale="0.5 0.5 0.5" id="head">
              <a-entity>
              <a-entity
                  position="0 0.5 0"
                  rotation="-90 0 0"
                  geometry="primitive: plane; width: 1; height: 1"
                  material="color: <?= $result['hair_color'] ?>; side: double"
                  class="hair"
              ></a-entity>
              <a-entity
                  position="0 -0.5 0"
                  rotation="90 0 0"
                  geometry="primitive: plane; width: 1; height: 1"
                  material="color: <?= $result['skin_color'] ?>; side: double"
                  class="skin"
              ></a-entity>
              <a-entity
                  position="0 0 0.5"
                  rotation="0 0 0"
                  geometry="primitive: plane; width: 1; height: 1"
                  material="color: black; side: double; src:#user-2"
              ></a-entity>
              <a-entity
                  position="0 0 -0.5"
                  rotation="0 180 0"
                  geometry="primitive: plane; width: 1; height: 1"
                  material="color: <?= $result['hair_color'] ?>; side: double"
                  class="hair"
              ></a-entity>
              <a-entity
                  position="-0.5 0 0"
                  rotation="0 -90 0"
                  geometry="primitive: plane; width: 1; height: 1"
                  material="color: <?= $result['hair_color'] ?>; side: double"
                  class="hair"
              ></a-entity>
              <a-entity
                  position="0.5 0 0"
                  rotation="0 90 0"
                  geometry="primitive: plane; width: 1; height: 1"
                  material="color: <?= $result['hair_color'] ?>; side: double"
                  class="hair"
              ></a-entity>
              </a-entity>
      
            </a-entity>
        </a-entity>
        <a-entity id="torso" rotation="0 90 0" position="0 1.2 0">
        <a-box color="<?= $result['shirt_color'] ?>" position="0 -0.4 0" depth="0.5" height="0.8" width="0.3" class="shirt"></a-box>
        </a-entity>
        <a-entity id="left-arm" position="-0.5 1.3 0">
        <a-box color="<?= $result['skin_color'] ?>" position="0 -0.5 0" depth="0.3" height="0.8" width="0.3" class="skin"></a-box>
        </a-entity>
        <a-entity id="right-arm" position="0.5 1.3 0">
        <a-box color="<?= $result['skin_color'] ?>" position="0 -0.5 0" depth="0.3" height="0.8" width="0.3" class="skin"></a-box>
        </a-entity>
        <a-entity id="left-leg" position="-0.2 0.4 0">
        <a-box color="<?= $result['pants_color'] ?>" position="0 -0.5 0" depth="0.3" height="1" width="0.3" class="pants"></a-box>
        </a-entity>
        <a-entity id="right-leg" position="0.2 0.4 0">
        <a-box color="<?= $result['pants_color'] ?>" position="0 -0.5 0" depth="0.3" height="1" width="0.3" class="pants"></a-box>
        </a-entity>
    </a-entity>

</a-scene>

<form>
    <div class="color-input">
        <label for="skin">Couleur de peau</label>
        <input type="color" name="skin" id="skin-color">
    </div>
    
    <div class="color-input">
        <label for="shirt">Couleur du T-shirt</label>
        <input type="color" name="shirt" id="shirt-color">
    </div>
    
    <div class="color-input">
        <label for="pants">Couleur du pantalon</label>
        <input type="color" name="pants" id="pants-color">
    </div>

    <div class="color-input">
        <label for="hair">Couleur des cheveux</label>
        <input type="color" name="hair" id="hair-color">
    </div>
</form>

<script src="www/assets/JS/avatar_modif.js"></script>

<?php
$page_content = ob_get_clean();
?>