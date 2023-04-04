<?php 

require_once __DIR__ . '/../../init.php';

$head_metas = "<link rel=stylesheet href=assets/CSS/lobby.css>";

if (!isset($_SESSION['user_id'])) {
    header('Location: /?page=login');
}

$usr_info = $db->prepare("SELECT pseudo FROM users WHERE user_id=?");
$usr_info->execute([$_SESSION['user_id']]);
$info = $usr_info->fetch();

$page_title = "room";

ob_start();

?>

<link rel="stylesheet" href="assets/CSS/room.css">
<link rel="stylesheet" href="assets/CSS/main.css">


    <header id="nav">
       <div class="nav--list">
            <button id="members__button">
               <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M24 18v1h-24v-1h24zm0-6v1h-24v-1h24zm0-6v1h-24v-1h24z" fill="#ede0e0"><path d="M24 19h-24v-1h24v1zm0-6h-24v-1h24v1zm0-6h-24v-1h24v1z"/></svg>
            </button>
       </div>

       <p id="user_pseudo"><?= $info['pseudo'] ?></p>

        <div id="nav__links">
            <button id="chat__button"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" fill="#ede0e0" clip-rule="evenodd"><path d="M24 20h-3v4l-5.333-4h-7.667v-4h2v2h6.333l2.667 2v-2h3v-8.001h-2v-2h4v12.001zm-15.667-6l-5.333 4v-4h-3v-14.001l18 .001v14h-9.667zm-6.333-2h3v2l2.667-2h8.333v-10l-14-.001v10.001z"/></svg></button>
        </div>
    </header>

    <main class="container">
        <div id="room__container">

            <section id="members__container">

            <div id="members__header">
                <p>Participants</p>
                <strong id="members__count">0</strong>
            </div>

            <div id="member__list">
                
            </div>

            </section>

            <section id="stream__container">

                <div id="stream__box"></div>

                <div id="streams__container">
                    
                </div>
                <div id="controls">
                    <!--<button id="camera-btn" class="active">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M5 4h-3v-1h3v1zm10.93 0l.812 1.219c.743 1.115 1.987 1.781 3.328 1.781h1.93v13h-20v-13h3.93c1.341 0 2.585-.666 3.328-1.781l.812-1.219h5.86zm1.07-2h-8l-1.406 2.109c-.371.557-.995.891-1.664.891h-5.93v17h24v-17h-3.93c-.669 0-1.293-.334-1.664-.891l-1.406-2.109zm-11 8c0-.552-.447-1-1-1s-1 .448-1 1 .447 1 1 1 1-.448 1-1zm7 0c1.654 0 3 1.346 3 3s-1.346 3-3 3-3-1.346-3-3 1.346-3 3-3zm0-2c-2.761 0-5 2.239-5 5s2.239 5 5 5 5-2.239 5-5-2.239-5-5-5z"/></svg>
                    </button>
                    <button id="mic-btn" class="active">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c1.103 0 2 .897 2 2v7c0 1.103-.897 2-2 2s-2-.897-2-2v-7c0-1.103.897-2 2-2zm0-2c-2.209 0-4 1.791-4 4v7c0 2.209 1.791 4 4 4s4-1.791 4-4v-7c0-2.209-1.791-4-4-4zm8 9v2c0 4.418-3.582 8-8 8s-8-3.582-8-8v-2h2v2c0 3.309 2.691 6 6 6s6-2.691 6-6v-2h2zm-7 13v-2h-2v2h-4v2h10v-2h-4z"/></svg>
                    </button>
                    <button id="leave-btn" style="background-color: #FF5050;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16 10v-5l8 7-8 7v-5h-8v-4h8zm-16-8v20h14v-2h-12v-16h12v-2h-14z"/></svg>
                    </button>
                    <div id="controls">-->

                    <div class="control-container" id="camera-btn">
                        <img src="assets/images/camera2.png" width="70">
                    </div>

                    <div class="control-container" id="mic-btn">
                        <img src="assets/images/mic2.png" width="70">
                    </div>

                    <a href="/?page=lobby">
                        <div class="control-container" id="leave-btn">
                            <img src="assets/images/phone2.png" width="70">
                        </div>
                    </a>


                </div>

            </section>

            <section id="messages__container">

                <div id="messages">
                    
                </div>

                <form id="message__form">
                    <input type="text" name="message" placeholder="Send a message...." />
                </form>

            </section>
        </div>
    </main>
    
<script type="text/javascript" src="assets/js/AgoraRTC_N-4.17.0.js"></script>
<script type="text/javascript" src="assets/js/agora-rtm-sdk-1.5.1.js"></script>
<script type="text/javascript" src="assets/js/room.js"></script>
<script type="text/javascript" src="assets/js/room_rtm.js"></script>
<script type="text/javascript" src="assets/js/room_rtc.js"></script>

<?php

$page_content = ob_get_clean();

?>