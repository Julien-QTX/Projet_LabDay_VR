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
                <form id="join-form">

                    <div class="user_box">
                        <input type="text" name="invite_link" required>
                        <label for="invite_link">Id de la salle</label>
                    </div>

                    <input type="submit" value="Rejoindre le salon">
                </form>
            </div>

        </div>

    </main>
    
</body>

<script>
    let form = document.getElementById('join-form')
    
    form.addEventListener('submit', (e) => {
        e.preventDefault()
        let inviteCode = e.target.invite_link.value
        window.location = `/?page=call&room=${inviteCode}`
    })


</script>

<?php
$page_content = ob_get_clean();
?>