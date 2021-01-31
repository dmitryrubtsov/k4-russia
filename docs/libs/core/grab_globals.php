<?PHP

function addslashesResult(&$result, $recursive=1)
{
  return addslashesArray($result, $recursive);
}
function stripslashesResult(&$result,$recursive=1)
{
  return stripslashesArray($result,$recursive);
}

function addslashesArray(&$result, $recursive=1)
{
  if (!is_array($result))
  {
	$result = addslashes($result);
	return $result;
  }
  if (is_object($result))
  {
 	return $result;
  }

  foreach($result as $__temp_key => $v)
  {
	if ($recursive==1 && is_array($v))
	{
	  addslashesArray($result[$__temp_key]);
	}
	elseif (is_string($v))
	{
	  $v = addslashes($v);
	  $result[$__temp_key] = $v;
	}
  }
}

function stripslashesArray(&$result, $recursive=1)
{
  if (!is_array($result))
  {
	$result = stripslashes($result);
	return $result;
  }
  if (is_object($result))
  {
	return $result;
  }

  foreach($result as $__temp_key => $v)
  {
	if ($recursive==1 && is_array($v))
	{
	  stripslashesArray($v);
	}
	elseif (is_string($v))
	{
	  $v = stripslashes($v);
	}
	$result[$__temp_key] = $v;
  }
}


if(__CFG_PGR_ADDSLASHES == __TRUE)
{
  addslashesArray($_POST);
  addslashesArray($_GET);
  addslashesArray($_REQUEST);
}
if(__CFG_PGR_STRIPSLASHES == __TRUE)
{
  stripslashesArray($_POST);
  stripslashesArray($_GET);
  stripslashesArray($_REQUEST);
}

?>
