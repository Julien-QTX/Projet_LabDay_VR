<?php
//display errors
if (isset($_SESSION['error_message'])) {
    ?>
    <p class="alert alert-error" style="color:red; font-size:16px; text-align:center;">
        <?= $_SESSION['error_message'] ?>
    </p>
    <?php
    unset($_SESSION['error_message']);
}

?>