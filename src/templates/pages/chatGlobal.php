<?php 

require_once __DIR__ . '/../../init.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: /?page=login');
}

$page_title = "Appel";

ob_start();

?>
<link rel="stylesheet" href="assets/CSS/chatGlobal.css">

<div id="chat">
    <div id="chatBox"></div>
    
    <form id="formSendMessage" method="post" action="/actions/sendMessages.php">
        <!-- <label for="sendMessage" id="sendMessagePH">Envoyer un message</label> -->
        <input type="text" id="sendMessage" name="sendMessage">
        <button id="submit">Envoyer</button>
    </form>

</div>

<script>
    let autoScrollEnabled = true;
    let lastDataLength = 0;

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
                    newDiv.className = 'messageBox';
                    newDiv.innerHTML = `<div class="Pseudo">${jsonData[i].pseudo}</div>`;
                    newDiv.innerHTML += `<div class="message">${jsonData[i].message}</div>`;
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
</script>

<?php

$page_content = ob_get_clean();

?>