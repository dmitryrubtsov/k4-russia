<?php

prepareSecurityNumber();
$str = getSecurityNumber();

$img = imagecreate($CONFIG['secureImageWidth'], $CONFIG['secureImageHeight']);
$background_color = imagecolorallocate($img, 255, 255, 255);

$f_x = $CONFIG['secureImageFontSize'];
$f_y = $CONFIG['secureImageFontSize'];
$f_s = $CONFIG['secureImageFontSize'];

$ri = rand(0,2);
for($i=0; $i<3; $i++)
{  $Col[$i] = ($i == $ri) ? rand(0,255) : 0;
}

$R = $Col[0];
$G = $Col[1];
$B = $Col[2];

$color = imagecolorallocate($img, $R, $G, $B);

$RestWidth = ($CONFIG['secureImageWidth']-20) / 2.5;
$CurrWidth = 5;
$count = strlen($str);
for($i=0; $i<$count; $i++)
{
  $RestHeight = $CONFIG['secureImageHeight'] / 2.5;
  if($i <= floor($count / 2))
  {    $RWidth = $RestWidth / 2;
  }
  else
  {  	$RWidth = $RestWidth;
  }
  $x = rand(0, $RWidth);
  $y = rand(0, $RestHeight) + $f_y + 5;
  //$font_file = __CFG_PATH_FONTS.".ttf";
  $font_file = __CFG_PATH_FONTS.rand(1,6).".ttf";
  //$font_angle = rand(0,60) - 30;

  imagefttext($img, $f_s, $font_angle, ($x + $CurrWidth), $y, $color, $font_file, $str[$i]);
  $RestWidth -= $x;
  $CurrWidth = $CurrWidth + $x + $f_x + 2;
}

// Noices as dotts
/*
for($i=1; $i<=5; $i++)
{
  imageline($img, rand(0, $CONFIG['secureImageWidth']), rand(0, $CONFIG['secureImageHeight']), rand(0, $CONFIG['secureImageWidth']), rand(0, $CONFIG['secureImageHeight']), $background_color);
}
for($i = $CONFIG['secureImageWidth'] * $CONFIG['secureImageHeight']/20; $i >= 0; $i--)
{
 ImageSetPixel($img, rand(0, $CONFIG['secureImageWidth']), rand(0, $CONFIG['secureImageHeight']), $background_color);
}
for($i=1; $i<=2; $i++)
{
  imageline($img, rand(0, $CONFIG['secureImageWidth']), rand(0, $CONFIG['secureImageHeight']), rand(0, $CONFIG['secureImageWidth']), rand(0, $CONFIG['secureImageHeight']), $color);
} */

header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Cache-Control: post-check=0,pre-check=0", false);
header("Cache-Control: max-age=0", false);
header("Pragma: no-cache");
header("Content-Type:image/gif");
imagegif($img);
imagedestroy ($img);
exit;

?>