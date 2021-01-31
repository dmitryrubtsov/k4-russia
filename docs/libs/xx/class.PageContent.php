<?

	class PageContent
	{

		var $MainContent;
		var $Blocks;
		var $Params;


		protected $templater;
		protected $configArr = array();
		protected $multiLanguage;
		protected $language;

		protected $pageTitle;
		protected $metaTitle;
		protected $metaKeywords;
		protected $metaDescription;

		protected $contentPathArr = array();

		protected $useCaching;



		function PageContent()
		{
			$this->MainContent = '';
			$this->Blocks = array();
		}

		function setMainContent($Content)
		{
			$this->MainContent = $Content;
		}

		function setBlock($blockName, $Content, $cacheTime)
		{
			$this->Blocks[$blockName] = $Content;
		}

		function getBlock($blockName)
		{
			return $this->Blocks[$blockName];
		}

		function setParam($paramName, $value)
		{
			$this->Params[$paramName] = $value;
		}

		function getParam($paramName)
		{
			return $this->Params[$paramName];
		}

		function assignParams()
		{
			global $tpl;
			$tpl->assign_by_ref('MainContent', $this->MainContent);
			$tpl->assign_by_ref('Blocks', $this->Blocks);
		}

		public function setTemplater($Templater)
		{
			$this->templater = $Templater;
			return $this;
		}

		public function getTemplater()
		{
			return $this->templater;
		}

		public function setConfigArr(array $configArr=array())
		{
			$this->configArr = $configArr;
			return $this;
		}

		public function getConfigArr()
		{
			return $this->configArr;
		}

		public function getConfig($name, $defaultValue=null)
		{
			$confArr = $this->getConfigArr();
			return (isset($confArr[$name]) ? $confArr[$name] : $defaultValue);
		}

		public function setLanguage($language)
		{
			$this->language = $language;
			return $this;
		}

		public function getLanguage()
		{
            if(is_null($this->language))
            {
               throw new CmsException('Undefined language in PageContent class.');
            }
			return $this->language;
		}

		public function setCachingFor($cacheLifetime)
		{
			$cacheLifetime = ($this->getUseCaching() ? $cacheLifetime : 0);
			$this->getTemplater()->cache_lifetime = $cacheLifetime;
			if($cacheLifetime == 0)
			{
				$this->getTemplater()->caching = 0;
			}
			else
			{
				$this->getTemplater()->caching = 2;
			}
			return $this;
		}



		public function __call($methodName, array $args = array())
		{
			if(is_callable(array($this->getTemplater(), $methodName)))
			{
			    $argsMethodName = 'getArgs_'.$methodName;

				if(method_exists($this, $argsMethodName))
				{
					$args = $this->$argsMethodName($args);
				}
                return call_user_func_array(array($this->getTemplater(), $methodName), $args);
			}

		}

		public function isMultiLanguage()
		{
			if(is_null($this->multiLanguage))
			{
				$this->multiLanguage = ($this->getConfig('EnableMultiLanguage', 'n') == 'y') ? true : false;
			}
			return $this->multiLanguage;
		}

		public function getUseCaching()
		{
			if(is_null($this->useCaching))
			{
				$this->useCaching = ($this->getConfig('useCaching', 'n') == 'y') ? true : false;
			}
			return $this->useCaching;
		}

		protected function getArgs_fetch(array $args=array())
		{
			if($this->isMultiLanguage())
			{
				$args[1] = $this->getLanguage().(isset($args[1]) ? '|'.$args[1] : '');
				$args[2] = $this->getLanguage().(isset($args[2]) ? '|'.$args[2] : '');
			}

			return $args;
		}

		protected function getArgs_is_cached(array $args=array())
		{
			if($this->isMultiLanguage())
			{
				$args[1] = $this->getLanguage().(isset($args[1]) ? '|'.$args[1] : '');
				$args[2] = $this->getLanguage().(isset($args[2]) ? '|'.$args[2] : '');
			}
			return $args;
		}

        public function display($templateFile)
        {
//        	echo __METHOD__;
//        	print_r($_SESSION);
//        	echo $templateFile;
        	if(is_file($this->getTemplater()->template_dir.$templateFile))
        	{
        		$result = $this->getTemplater()->display($templateFile);
        	}
        	else
        	{
        		$result = $this->getTemplater()->display('../'.__CFG_ADMIN_THEME_DEFAULT.'/'.$templateFile);
        	}
//        	print_r($_SESSION);

        	return $result;
        }
	}

?>