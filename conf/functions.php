<?php
function set_message($header, $message, $type) {
    $_SESSION['message_header'] = $header;
    $_SESSION['message'] = $message;
    $_SESSION['message_type'] = $type;
}
