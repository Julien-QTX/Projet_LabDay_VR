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
                        <label for="invite_link">Id du salon</label>
                    </div>

                    <div class="user_box" id="bg-slct">
                    <label for="background">Choix de l'environnement</label>
                        <select name="background" id="background_selection">
                            <option value="default">--</option>

                        </select>
                    </div>

                    <input type="submit" value="Rejoindre le salon">
                </form>
            </div>

        </div>

    </main>
    
</body>

<script>
    let form = document.getElementById('join-form')
    let background_selection = document.getElementById('background_selection')
    
    form.addEventListener('submit', (e) => {
        e.preventDefault()
        let inviteCode = e.target.invite_link.value
        let background = background_selection.value
        window.location = `/?page=call&room=${inviteCode}&background=${background}`
    })

    let validBackgrounds = ["contact", "egypt", "checkerboard", "forest", "goaland", "yavapai", "goldmine", "threetowers", "poison", "arches", "tron", "japan", "dream", "volcano", "starry", "osiris", "moon"]

    for (let i = 0; i < validBackgrounds.length; i++) {
        
        let cases = document.createElement('option')
        cases.setAttribute('value', validBackgrounds[i])
        let string = validBackgrounds[i]
        string = string.charAt(0).toUpperCase() + string.slice(1);
        cases.innerText = string
        background_selection.append(cases)
        
    }

</script>

<?php
$page_content = ob_get_clean();
?>