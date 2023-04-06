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

<div id="divLangue">
    <label for="langue">Choix de langue</label>

    <select name="langue" id="langue">
        <option value="FR" selected>Francais</option>
        <option value="EN">Anglais</option>
        <option value="DE">Allemand</option>
        <option value="ES">Espagnol</option>
        <option value="PO">Portugais</option>
    </select>
</div>

<div id="chat">
    <div id="chatBox"></div>
    
    <form id="formSendMessage">
        <input type="text" id="sendMessage" name="sendMessage">
        <button id="submit">Envoyer</button>
    </form>

</div>

<script>
    let autoScrollEnabled = true;
    let lastDataLength = 0;
    let pseudo = document.getElementById('user-pseudo').innerHTML;
    let langueSelected = document.getElementById('langue').value;

    document.getElementById('langue').addEventListener('change', () => {
        langueSelected = document.getElementById('langue').value;
    });

    setInterval(() => {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '/actions/getChatGlobal.php');
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = () => {
            // Parse le JSON data
            const jsonData = JSON.parse(xhr.responseText);

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

                // Scroll to the bottom of the chat box
                if (autoScrollEnabled) {
                    const chatBoxElement = document.getElementById("chatBox");
                    chatBoxElement.scrollTop = chatBoxElement.scrollHeight;
                }
            }

            // deletes messages older than 1 hour
            const del = new XMLHttpRequest();
            del.open('POST', '/actions/deleteMessage.php');
            del.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            del.send();

            lastDataLength = jsonData.length;

        };
        xhr.send(`langue=${encodeURIComponent(langueSelected)}`);
    }, 100);

    // Toggle auto scroll
    document.getElementById("chatBox").addEventListener("click", () => {
    autoScrollEnabled = !autoScrollEnabled;
    });

    let form = document.getElementById('formSendMessage');

    // Send message
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        let message = document.getElementById('sendMessage').value;
        let user_id = <?= $_SESSION['user_id'] ?>;

        const xhr2 = new XMLHttpRequest();
        xhr2.open('POST', '/actions/sendMessages.php');
        xhr2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr2.send(`message=${encodeURIComponent(message)}&user_id=${encodeURIComponent(user_id)}&langue=${encodeURIComponent(langueSelected)}`);

        document.getElementById('sendMessage').value = '';
    });

</script>

<?php

$page_content = ob_get_clean();

?>