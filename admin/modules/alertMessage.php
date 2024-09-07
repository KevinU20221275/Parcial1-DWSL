
<?php
$message = isset($_SESSION['message']) ? $_SESSION['message'] : "";
$message_header = isset($_SESSION['message_header']) ? $_SESSION['message_header'] : "";
$message_type = isset($_SESSION['message_type']) ? $_SESSION['message_type'] : "";

$_SESSION['message'] = null;
$_SESSION['message_header'] = null;
$_SESSION['message_type'] = null;

unset($_SESSION['message']);
unset($_SESSION['message_header']);
unset($_SESSION['message_type']);

if ($message != "" && $busqueda == "") { ?>
    <div class='alert alert-warning alert-dismissible fade show ms-2 rounded mt-2 p-2 bg-secondary position-absolute end-0 mx-3' style="width:450px !important; border:solid 1px #000;" role='alert'>
                <h6 class='fw-normal mb-0'> <?= $message_header ?> </h6>
                <small class="text-<?= $message_type ?>"><?= $message ?> </small>
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>
<?php } ?>