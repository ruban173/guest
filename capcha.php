<?php

class Captcha{

    private $text;
    private $collection;
    private $width;
    private $height;
    private $image;
    private $object;

    function __construct()
    {
        $this->object=$this;
    }

    private function geterate($count=5){
      for ($i=0;$i< $count;$i++)
          $this->text.= $this->collection[rand(0,count($this->collection))];
      return $this;
    }

    public function upper(){
        $array=range('A','Z');
         $this->collection=(empty( $this->collection))?$array:array_merge_recursive($this->collection,$array);
         return $this;
    }
    public function lower(){
        $array=range('a','z');
        $this->collection=(empty( $this->collection))?$array:array_merge_recursive($this->collection,$array);
        return $this;
    }
    public function number(){
        $array=range(0,9);
        $this->collection=(empty( $this->collection))?$array:array_merge_recursive($this->collection,$array);
        return $this;
    }
    public function getCollection(){
        return  $this->collection;
    }

    public function create($width=120,$height=40){
        $this->geterate();
        header("Content-Type: image/png");
        $this->image = imagecreate($width,$height);
        imagecolorallocate($this->image, 160, 160, 160);
        $color = imagecolorallocate($this->image, 150, 0, 91);
        for ($i=0;$i<strlen($this->text);$i++){
            $font=rand(4,5);
            $x+=rand(15,25);
            $y=rand(5,20);
            imagechar($this->image, $font, $x, $y,  $this->text{$i}, $color);
        };

        $pixel_color = imagecolorallocate($this->image, 0,160,255);
        for($i=0;$i<500;$i++) {
            imagesetpixel($this->image,rand()%200,rand()%50,$pixel_color);
        }


        imagepng($this->image);
        imagedestroy($this->image);
    }

}

(new Captcha)->upper()
                ->lower()
                ->number()
                ->create();

/*
$captcha=new Captcha();
$captcha->upper()
         ->lower()
         ->number();
$captcha->create();



/*echo '<pre>';
print_r( $captcha->geterate()) ;
*/
/*
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
*/

?>
