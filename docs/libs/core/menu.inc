<?php

require_once __CFG_PATH_LIBS . __CFG_PATH_CORE . "confparts.inc";

class FrontMenu
{
	static private $instance = NULL;

  	static public function getInstance()
	{
	  	if (self::$instance == NULL)
	  	{
	    	self::$instance = new FrontMenu();
	  	}
	  	return self::$instance;
	}

	private $modules;


	public function __construct()
	{      	$this->setModules();
      	$this->setModulesParams();
	}

	private function setModules()
	{
		global $language;

		$this->modules = array(
	    			'articles' => (object)array('title' => $language['admin']['article']),
	    			'rubrics' =>  (object)array('title' => $language['admin']['rubric']),
	    			'contacts' => (object)array('title' => $language['admin']['contacts']),
	    );
	}

	function setModulesParams()
	{
		global $language, $_SQL_TABLE;

		$TabFields['a'] = getFieldNamesWithLangs($_SQL_TABLE['article'], array('title'));
	    $TabFields['r'] = getFieldNamesWithLangs($_SQL_TABLE['rubric'], array('title'));
	    $ArticlesSelect = getTableAsArrayByKeyField($_SQL_TABLE['article'], 'id', 'id', array(), '', 'id,linkname,'.$TabFields['a']['title'].' AS title');
	    $RubricsSelect = getTableAsArrayByKeyField($_SQL_TABLE['rubric'], 'id', 'id', array(), '', 'id,linkname,'.$TabFields['r']['title'].' AS title');


		foreach($this->modules as $code => $obj)
		{
			if($code == 'articles')
			{
				$this->modules[$code]->params = $ArticlesSelect;
			}
			elseif($code == 'rubrics')
			{
				$this->modules[$code]->params = $RubricsSelect;
			}
			elseif($code == 'contacts')
			{
				$this->modules[$code]->params = array('' => array('id' => '', 'linkname' => '', 'title' => $language['admin']['contacts']));
			}
			if(isEmptyArr($this->modules[$code]->params))
			{
			  	$this->modules[$code]->params = array('' => array('id' => '', 'linkname' => '', 'title' => $language['admin']['noValues']));
			}
		}
	}

	public function getMenuModulesParams($key='title')
	{
		$ParamsSelect = array();
		foreach($this->modules as $code => $obj)
		{
		  	$ParamsSelect[$code] = array_kv($obj->params, $key, 'id');
		}

		return $ParamsSelect;
	}

	public function getMenuModules()
	{
		$ModulesArr = array();
		foreach($this->modules as $key => $obj)
		{			$ModulesArr[$key] = $obj->title;
		}
		return $ModulesArr;
	}

	public function setMenuParamsArray($ParamsStr)
	{
		if(!isBlank($ParamsStr))
	    {
	      $CurrVals = unserialize($ParamsStr);
	    }
	    else
	    {
	      $CarrVals = array();
	    }

	    return $CurrVals;
	}

	public function setMenuParamsString($ParamsArr)
	{
		return serialize($ParamsArr);
	}

	public function makeMenuLink($ParamsStr)
	{
        global $CONFIG, $HOST;

		$CurrVals = $this->setMenuParamsArray($ParamsStr);
		$LinkParts = array();
		foreach($CurrVals as $key => $value)
		{			if(!$value)
			{				break;
			}
			switch($key)
			{				case 'module': array_push($LinkParts, $value); break;
				case 'params': array_push($LinkParts, $this->applyParams($CurrVals['module'],$value)); break;
			}
		}
	    $link = $HOST./*getPath().*/join('/',$LinkParts).$CONFIG['webPageFileType'];

	    return $link;
	}

	private function applyParams($Module, $Params)
	{		if(is_string($Params))
		{			return $this->modules[$Module]->params[$Params]['linkname'];
		}
	}


}

function getActiveMenuAsArray($blockId)
{
  global $dbSet, $_SQL_TABLE;
  $dbSet->open("SELECT m.id, m.title".__FLANG." AS title, m.outerlink, a.linkname FROM ".$_SQL_TABLE['menu']." m LEFT JOIN ".$_SQL_TABLE['article']." a ON a.id = m.article AND a.active = 'y' WHERE m.active = 'y' AND m.menu_block = '".$blockId."' ORDER BY m.position");
  $result = $dbSet->fetchRowsAll();
  foreach($result as $n => $arr)
  {  	if($arr[outerlink] != '')
  	{  	  if($arr[outerlink] == '/')
  	  {  	  	$result[$n][linkname] = '';
  	  }
  	  else
  	  {  	  	$result[$n][linkname] = str_replace('.html', '', $arr[outerlink]);
  	  }
  	}
  }
  return $result;
}

function getMenuBlocksAsArray($querywhere="")
{
  global $dbSet, $_SQL_TABLE;
  $dbSet->open("SELECT id, title, name, active FROM ".$_SQL_TABLE['menu_block']." ".$querywhere." ORDER BY title");
  $result = $dbSet->fetchRowsAll();
  foreach($result as $n => $arr)
  {
  	$menuBlocks[$arr[name]] = $arr;
  }
  return $menuBlocks;
}

function getActiveMenuBlocksAsArray(&$activeMenuBlocks)
{

  $queryWhere = "WHERE active = 'y'";
  $activeMenuBlocks = getMenuBlocksAsArray($queryWhere);
}

?>