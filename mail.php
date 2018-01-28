<?php
function send_mail($to, $from, $subject, $text_message) {
    $reply = 'no-reply@always.net';
    $headers = 'From: Name <' . $from . '>' . "\n";
    $headers .= 'Return-Path: <' . $reply . '>' . "\n";
    $headers .= 'Content-type: text/plain; charset=utf-8';
    $message = $text_message . "\n\n";
    mail($to, $subject, $message, $headers);
}