<?php
$count_chars = 3; //число символів в капчі;
$rand_size = rand(25, 30); //рандомний размір шрифта;
$rand_angle = rand(5, 45); //рандомний кут нахилу букв;
$x = 10;
$y = 60; // координати букв;
$shift_x = 35; //зміщення по осі x. 
$img   = imageCreateFromJPEG("../img/bg.jpg");
$color = imageColorAllocate($img, 0, 100, 100);
$captcha = substr(base64_encode(md5(md5(uniqid()))), 0, $count_chars);
session_start();
$_SESSION['captcha'] = $captcha;
    for ($i = 0; $i < $count_chars; $i++){
        imageTtfText($img, $rand_size, $rand_angle, $x, $y, $color, "../php/Schoolbell.ttf",
		$captcha{$i});
        $x += $shift_x;
    }
header('Content-Type: image/jpeg');
imageJPEG($img, null, 60);
?>

