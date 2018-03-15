<?php
function generateStr( $count=1){

    $array_a = range('a','z');
    $array_A = range('A','Z');
    $array_0 = range('0','9');
    $array=array_merge_recursive($array_a,$array_A,$array_0);
    $result=array_rand($array,$count);
    if($count!=1)
         foreach ($result as $value) $str.=  $array[$value] ;
    else
        $str=$array[$result];
    return $str;
}

$string=generateStr(5);


$im = imagecreate(120, 40);
 header("Content-Type: image/png");
$background_color = imagecolorallocate($im, 160, 160, 160);
$text_color = imagecolorallocate($im, 150, 0, 91);

for ($i=0;$i<strlen($string);$i++){
     $font=4;
     $x+=20;
     $y=rand(5,20);
     imagechar($im, $font, $x, $y,  $string{$i}, $text_color);

};
$pixel_color = imagecolorallocate($im, 0,160,255);
for($i=0;$i<500;$i++) {
    imagesetpixel($im,rand()%200,rand()%50,$pixel_color);
}


imagepng($im);


imagedestroy($im);


 //print_r(generateStr(1));


?>
