<?php

if (isset($_SESSION['error_message'])) {
    ?>
    <p class="alert alert-error" style="color:red;">
        <?= $_SESSION['error_message'] ?>
    </p>
    <?php
    unset($_SESSION['error_message']);
}

?>