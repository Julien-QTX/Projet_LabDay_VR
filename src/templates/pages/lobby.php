<?php 

require_once __DIR__ . '/../../init.php';

$head_metas = "<link rel=stylesheet href=assets/CSS/lobby.css>";

if (!isset($_SESSION['user_id'])) {
    header('Location: /?page=login');
}

$page_title = "Appel";

ob_start();

?>

<main id="lobby-container">

        <div id="form-container">

            <div id="form_container_header">
                <h2>Créer ou rejoindre un salon</h2>
            </div>

            <div id="form_content_wrapper">

                <div id="create-join">
                    <button id="create">Créer</button>
                    <button id="join">Rejoindre</button>
                </div>

                <form id="join-form">

                    <p id="p"></p>

                    <?php

                    //echo __DIR__;
                    include_once __DIR__ . '/../../utils/alert_errors.php';

                    ?>

                    <div class="user_box" id="room-id">
                        <input type="text" name="invite_link" required maxlength="6" minlength="6">
                        <label for="invite_link">Id du salon</label>
                    </div>

                    <div class="user_box" id="bg-slct">
                    <label for="background">Choix de l'environnement</label>
                        <select name="background" id="background_selection">
                            <option value="default">--</option>

                        </select>
                    </div>

                    <input type="submit" value="Créer un salon" id="submit-btn">
                </form>
            </div>

        </div>

    </main>
    
</body>

<script src="assets/JS/lobby.js"></script>

<?php
$page_content = ob_get_clean();
?>