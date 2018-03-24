<?php

class Mail {

    public static function send($to, $subject, $messages, $from) {

        $subject = "=?EUC-KR?B?".base64_encode(iconv( 'UTF-8', 'EUC-KR', $subject))."?=\r\n";

        $headers = "From: " . $from . "\n";
        $headers .= "Reply-To : " . $from . "\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\n";

        mail($to, $subject, $messages, $headers);
    }
}
?>