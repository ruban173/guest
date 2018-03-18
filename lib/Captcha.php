<?php

class Captcha{

    private $text;
    private $collection;
    private $image;
    private $object;

    const FONT_FILE='fonts/arial.ttf';
    const FONT_SIZE=30;
    const SESSION_NAME='text';

    function __construct()
    {
        $this->object=$this;
    }

    private function geterate($count=5){
        for ($i=0;$i< $count;$i++)
            $this->text.= $this->collection[rand(0,count($this->collection)-1)];
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
    public function  createSession(){
        session_start();
        $_SESSION[self::SESSION_NAME] = $this->text;
    }
    public function  destroySession(){
        session_destroy();
    }
    private function pixelBackground(){
        $color = imagecolorallocate($this->image, 0,160,255);
        for($i=0;$i<500;$i++) {
            imagesetpixel($this->image,rand()%200,rand()%50,$color);
        }
    }
    private function lineBackground($width,$height,$count=2){
        for ($i=0;$i<$count;$i++){
            $red=rand(0,255);
            $green=rand(0,255);
            $blue=rand(0,255);

            $color = imagecolorallocate($this->image, $red,$green,$blue);
            $x1=rand(0,10);
            $y1=rand(0,$height);
            $x2=$width-rand(0,10);
            $y2=rand(0,$height);
            imageline ($this->image , $x1 , $y1 , $x2 , $y2 , $color );
        }

    }
    public function create($width=180,$height=60){

        $this->geterate();
        header("Content-Type: image/png");
        $this->image = imagecreate($width,$height);
        imagecolorallocate($this->image, 160, 160, 160);
        $color = imagecolorallocate($this->image, 150, 0, 91);

        for ($i=0;$i<strlen($this->text);$i++){
            $font=self::FONT_SIZE+rand(0,3);
            $x+=rand(15,$font);
            $y=$font+rand(5,15);
            $angle=rand(-30,30);

            imagettftext ( $this->image ,  $font,  $angle ,   $x, $y,   $color , self::FONT_FILE , $this->text{$i} );
        };

        $this->pixelBackground();
        $this->lineBackground($width,$height);

        $this->createSession();
        imagepng($this->image);
        imagedestroy($this->image);

    }

}
