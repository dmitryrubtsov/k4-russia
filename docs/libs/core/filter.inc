<?php

function saveFilterParams($FilterParamArray)
{

  foreach($FilterParamArray as $n => $param)
  {
    if(!isBlank($_GET[$param]))
    {
      $ADMIN['AdmCurrFilterParam'][$param] = $_GET[$param];
      $sID->assign('admin', $ADMIN);
    }

    $_GET[$param] = $_REQUEST[$param] = $ADMIN['AdmCurrFilterParam'][$param];
  }
}

?>