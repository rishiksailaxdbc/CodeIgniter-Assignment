<?php

// echo "hello world";

$password1 = "This is password1";
$hashedPassword1 = password_hash($password1, PASSWORD_BCRYPT);

$password2 = "This is password2";
$hashedPassword2 = password_hash($password2, PASSWORD_BCRYPT);

echo "Hased Passwords:\n";
echo $hashedPassword1."\n";
echo $hashedPassword2."\n\n";

$result = password_verify($password1, $hashedPassword1) && password_verify($password2, $hashedPassword2);
echo "Result: ".$result;

// $secret = getenv('SECRET');
// $secret = env('SECRET');
// echo $secret;


?>