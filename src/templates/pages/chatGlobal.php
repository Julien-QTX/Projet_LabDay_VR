<?php 

require_once __DIR__ . '/../../init.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: /?page=login');
}

$usr_info = $db->prepare("SELECT pseudo FROM users WHERE user_id=?");
$usr_info->execute([$_SESSION['user_id']]);
$info = $usr_info->fetch();

$page_title = "Chat Global";

ob_start();

?>
<link rel="stylesheet" href="assets/CSS/chatGlobal.css">

<p style="display:none" id="user-pseudo"><?= $info['pseudo'] ?></p>

<div id="chat">
    <div id="chatBox"></div>

    <?php

    include_once __DIR__ . '/../../utils/alert_errors.php';

    ?>
    
    <form id="formSendMessage">
        <!-- <label for="sendMessage" id="sendMessagePH">Envoyer un message</label> -->
        <input type="text" id="sendMessage" name="sendMessage">
        <button id="submit">Envoyer</button>
    </form>

</div>

<script>
    let autoScrollEnabled = true;
    let lastDataLength = 0;
    let pseudo = document.getElementById('user-pseudo').innerHTML;

    setInterval(() => {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', '/actions/getChatGlobal.php');
        xhr.onload = () => {
            // Parse le JSON data
            const jsonData = JSON.parse(xhr.responseText);

            /* console.log(jsonData) */
            if (jsonData.length !== lastDataLength) {

                // Clear the chat box
                document.getElementById('chatBox').innerHTML = '';

                // Loop through the data and display it
                for (let i = 0; i < jsonData.length; i++) {

                    let newDiv = document.createElement('div');
                    

                    if(jsonData[i].pseudo === pseudo) {
                        newDiv.className = 'you-messageBox';
                        newDiv.innerHTML = `<div class="you">Vous</div>`;
                        newDiv.innerHTML += `<div class="you-message">${jsonData[i].message}</div>`;
                    }
                    else {
                        newDiv.className = 'other-messageBox';
                        newDiv.innerHTML = `<div class="other">${jsonData[i].pseudo}</div>`;
                        newDiv.innerHTML += `<div class="other-message">${jsonData[i].message}</div>`;
                    }
                    document.getElementById('chatBox').appendChild(newDiv);
                }

                if (autoScrollEnabled) {
                    const chatBoxElement = document.getElementById("chatBox");
                    chatBoxElement.scrollTop = chatBoxElement.scrollHeight;
                }
            }

            lastDataLength = jsonData.length;

        };
        xhr.send();
    }, 1000);

    document.getElementById("chatBox").addEventListener("click", () => {
    autoScrollEnabled = !autoScrollEnabled;
    });

    let form = document.getElementById('formSendMessage');

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        let message = document.getElementById('sendMessage').value;
        let user_id = <?= $_SESSION['user_id'] ?>;

        const xhr2 = new XMLHttpRequest();
        xhr2.open('POST', '/actions/sendMessages.php');
        xhr2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr2.send(`message=${encodeURIComponent(message)}&user_id=${encodeURIComponent(user_id)}`);

        document.getElementById('sendMessage').value = '';
    });

    //let submitButton = document.getElementById('submit');

</script>

<?php

$page_content = ob_get_clean();

?>