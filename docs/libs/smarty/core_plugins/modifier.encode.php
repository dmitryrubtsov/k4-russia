<?php
function smarty_modifier_encode($string)
{
  $string = "document.write('".$string."');";
  $js_encode = '';
  for ($x=0; $x < strlen($string); $x++)
  {
    $js_encode .= '%' . bin2hex($string[$x]);
  }
  $string = '<script type="text/javascript">eval(unescape(\''.$js_encode.'\'))</script>';
  return $string;
}
?>
