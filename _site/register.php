<?php

$email = $_POST['email'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('Not valid E-Mail');
}

$time = date("Y-m-d H:i:s");

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
$ip = substr($ip, 0, 30);

$browser = substr($_SERVER['HTTP_USER_AGENT'], 0, 80);
$email = substr($email, 0, 250);

$line = sprintf("\n%s [%s, %s]: %s", $time, $ip, $browser, $email);

file_put_contents('/var/www/jarves.io/registrations.txt', $line, FILE_APPEND);


echo "Thanks.";