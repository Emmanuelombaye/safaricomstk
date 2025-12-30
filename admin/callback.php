<?php
// Receive Safaricom callback
$callbackData = file_get_contents('php://input');

// Save response for records
file_put_contents("mpesa_callback_log.txt", $callbackData . PHP_EOL, FILE_APPEND);

// You can expand this later (WhatsApp, DB, Email)
?>
