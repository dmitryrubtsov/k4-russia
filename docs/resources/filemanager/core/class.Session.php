<?PHP
/*
 * DF-FileManager
 * Version: 1.0 (3/06/2010)
 * Copyright (c) 2010 Dmytro Feshchenko www.df-studio.net
 * Licensed under the MIT License: http://en.wikipedia.org/wiki/MIT_License
*/

  define("__ERROR_SESSION_FAILED", "Session is failed");

  class Session
  {
	const LIVETIME = 900;
	const HANDLE = "CURR_SESS";

	private $__id;
	private $__name;
	private $__lifetime;
	private $__handle;
	private $__variables=array();

	public function __construct($Name=__NULL, $LifeTime=__NULL, $Handle=__NULL, $Id=__NULL)
	{
	  $this->__lifetime = (!MF::isBlank($LifeTime)) ? $LifeTime : self::LIVETIME;
	  $this->__handle = (!MF::isBlank($Handle)) ? $Handle : self::HANDLE;
	  $this->__name = $this->sessionName($Name);
	  $this->__id = $this->sessionId($Id);

	  if(!session_start())
	  {	    user_error(__ERROR_SESSION_FAILED, E_USER_ERROR);
	  }

	  if (!isset($_SESSION[$this->__handle]))
	  {
	    $_SESSION[$this->__handle] = array();
	    $_SESSION[$this->__handle]['lasttime'] = time();
	  }
	  $this->__variables = &$_SESSION[$this->__handle];

	  if((time() - $this->__lifetime) > $this->lasttime)
	  {	    $this->clear();
	  }
	  $this->lasttime = time();
    }

    public function __set($Name, $Value)
	{
	  $this->__variables[$Name] = $Value;
	}

	public function __get($Name)
	{
	  return $this->__variables[$Name];
	}

	public function setHandle($Handle)
	{	  $this->__handle = $Handle;
	  if (!isset($_SESSION[$this->__handle]))
	  {
	    $_SESSION[$this->__handle] = array();
	    $_SESSION[$this->__handle]['lasttime'] = time();
	  }
	  $this->__variables = &$_SESSION[$this->__handle];
	}

	private function destroy()
	{
	  session_destroy();
	}

	public function assign($Variables, $Value=__NULL)
	{
	  if(is_array($Variables))
	  {
		foreach($Variables as $name => $value)
		{
		  $this->$name = $value;
		}
	  }
	  else
	  {	  	$this->$Variables = $Value;
	  }
	}

	function unassign($Variables)
	{
	  if(is_array($Variables))
	  {
		foreach($Variables as $name => $v)
		{		  unset($this->$name);
		}
	  }
	  else
	  {	  	unset($this->$Variables);
	  }
	}

	function assigned($Variable)
	{
	  return !MF::isBlank($this->$Variable);
	}

	function clear()
	{
	  $this->__variables = array();
	}

	function fetch($Variable)
	{
	  return $this->$Variable;
	}

	function get($Variable, $DefaultVal=__NULL)
	{
	  return ($this->assigned($Variable)) ? $this->$Variable : $DefaultVal;
	}

	function sessionId($Id=__NULL)
	{
	  return (!MF::isBlank($Id)) ? session_id($Id) : session_id();
	}

	function sessionName($Name=__NULL)
	{
	  return (!MF::isBlank($Name)) ? session_name($Name) : session_name();
	}

	function setGlobal($Name, $Value)
	{	  if($Name != $this->__handle)
	  {
	    $_SESSION[$Name] = $Value;
	  }
	}

	function getGlobal($Name, $DefaultVal=__NULL)
	{
	  if($Name != $this->__handle)
	  {
	    return (!MF::isBlank($_SESSION[$Name])) ? $_SESSION[$Name] : $DefaultVal;
	  }
	  return __NULL;
	}
  }
?>