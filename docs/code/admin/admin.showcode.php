<?php


$img = imagecreate($CONFIG['secureImageWidth'], $CONFIG['secureImageHeight']);
$background_color = imagecolorallocate($img, 255, 255, 255);

$f_x = imagefontwidth($CONFIG['secureImageFontSize']);
$f_y = imagefontheight($CONFIG['secureImageFontSize']);

$x = ($CONFIG['secureImageWidth'] - strlen(getSecurityNumber()) * $f_x )/2;
$y = ($CONFIG['secureImageHeight'] - $f_y) / 2;

$color = imagecolorallocate($img, rand(0,255), 0, 0);


/*// Noices as line
$dc = ImageColorAllocate($img, rand(0,255), rand(0,255), rand(0,255));
imageline($img, rand(0, $CONFIG[secureImageWidth]/3), rand(0, $CONFIG[secureImageHeight]/2), rand($CONFIG[secureImageWidth]/3, $CONFIG[secureImageWidth]), rand($CONFIG[secureImageHeight]/2, $CONFIG[secureImageHeight]), $dc);
$dc = ImageColorAllocate($img, rand(0,255), rand(0,255), rand(0,255));
imageline($img, rand($CONFIG[secureImageWidth]/3, $CONFIG[secureImageWidth]), rand(0, $CONFIG[secureImageHeight]/2 ), rand(0, $CONFIG[secureImageWidth]), rand($CONFIG[secureImageHeight]/2, $CONFIG[secureImageHeight]), $dc);
$dc = ImageColorAllocate($img, rand(0,255), rand(0,255), rand(0,255));
imageline($img, rand(0, $CONFIG[secureImageWidth]), rand(0, $CONFIG[secureImageHeight]/2), rand(0, $CONFIG[secureImageWidth]), rand($CONFIG[secureImageHeight]/2, $CONFIG[secureImageHeight]), $dc);
*/



// Noices as dotts
for($i = $CONFIG['secureImageWidth'] * $CONFIG['secureImageHeight']/7; $i >= 0; $i--)
{
 ImageSetPixel($img, rand(0, $CONFIG['secureImageWidth']), rand(0, $CONFIG['secureImageHeight']), ImageColorAllocate($img, rand(100,255), rand(100,255), rand(100,255)));
}

imagestring($img, $CONFIG['secureImageFontSize'], $x, $y, getSecurityNumber(), $color);

header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Cache-Control: post-check=0,pre-check=0", false);
header("Cache-Control: max-age=0", false);
header("Pragma: no-cache");
header("Content-Type:image/gif");
imagegif($img);
exit;

?>