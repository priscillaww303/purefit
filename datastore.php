<strong><span style="font-family:KaiTi_GB2312;font-size:18px;">
 
 <?php
  header("content-type:text/html charset=utf-8");
  
  //start session
  session_start();

  //canvas
  $im=imagecreatetruecolor(50,25);

  //colour
  $black=imagecolorallocate($im,0,0,0);
  $gray=imagecolorallocate($im,200,200,200);

  //background fill
  imagefill($im,0,0,$gray);

  //centre
  $x=(50-10*4)/2;
  $y=(25-5)/2+5;

  //add noise
  for($i=0;$i<50;$i++){
    imagesetpixel($im,mt_rand(0,50),mt_rand(0,25),$black);
  }

  //prepare alphs
  $arr=array_merge(range(0,9),range('a','z'),range('A','Z'));
  shuffle($arr);
  $str=implode(array_slice($arr,0,4));

  //put $str into session，for all pages calling
  $_SESSION['vstr']=$str;

  $file="../fonts/simsun.ttc";
  imagettftext($im,15,0,$x,$y,$black,$file,$str);


  //output to browser or save
  header("content-type:image/png");
  imagepng($im);

  //cloase canvas
  imagedestory($im);
?></span></strong>