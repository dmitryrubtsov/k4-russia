<?PHP
	class xxSession {
		/** Session name */
		var $__name;
		/** Session id */
		var $__id;
		/** Session live time */
		var $__livetime;
		/** Session handle */
		var $__handle = __CFG_SESSION_HANDLE;
		/** Session variables array */
		var $__variables=array();
		/** object xxSession($livetime, $name, $id) - constructor */
		function xxSession($livetime=1000, $name=null, $id=null)
		{
			session_set_cookie_params(0);
			static $start=false;
			if($start) user_error("Session is already", E_USER_ERROR);
			if(isset($livetime) && !empty($livetime)) $this->__livetime = $livetime;
			if(isset($name) && !empty($name)) session_name($name);
			$this->__name=session_name();
			if(isset($id) && !empty($id))
			{
			  session_id($id);
			  $this->__id=session_id();
			}

			if(!session_start()) user_error("Session is failed", E_USER_ERROR);
			if (ini_get('register_globals'))
			{
				session_register($this->__handle);
				$this->__variables=&$GLOBALS[$this->__handle];
			}
			else
			{
				if (!isset($_SESSION[$this->__handle]))
				{
					$_SESSION[$this->__handle] = array();
					$_SESSION[$this->__handle]['lasttime'] = time();
				}


				$this->__variables = &$_SESSION[$this->__handle];
			}
			$start=true;

			if((time() - $this->__livetime) > $this->__variables['lasttime'])
			{
			  $this->clear();
			}

			$this->__variables['lasttime'] = time();
		}

		/** void close() - close session */
		function close(){
			session_destroy();
		}
		/** void assign($variables, $value) - assign variable in session data */
		function assign($variables, $value=null){
			if(is_array($variables)){
				foreach($variables as $key=>$value) $this->__variables[$key]=$value;
			} else $this->__variables[$variables]=$value;
		}
		/** void unassign($variables) - unassign variable from session data */
		function unassign($variables){
			if(is_array($variables)) {
				foreach($variables as $k=>$v) unset($this->__variables[$k]);
			} else unset($this->__variables[$variables]);
		}
		/** bool assigned($variable) - checking variable in session data */
		function assigned($variable){
			return isset($this->__variables[$variable]);
		}
		/** void clear() - clear all variables from session data */
		function clear(){
			$this->__variables=array();
		}
		/** variant fetch($variable) - get variable from session data */
		function fetch($variable){
			return $this->__variables[$variable];
		}
		/** extended fetch */
		function get($variable, $defaultVal = NULL){
			return (isset($this->__variables[$variable])) ? $this->__variables[$variable] : $defaultVal;
		}
		/** string getSessionId() - get session id */
		function getSessionId(){
			return session_id();
		}
		/** string getSessionName() - get session name */
		function getSessionName(){
			return session_name();
		}
	}
?>