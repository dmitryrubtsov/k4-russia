<?php

class XMLPage
{  var $params;
  var $completeXMLPage;
  var $completeFlag;

  function XMLPage($pageContent='')
  {  	$this->setPageContent($pageContent);
  	$this->completeFlag = __FALSE;
  }

  function display()
  {    if($this->completeFlag != __TRUE)
    {      $this->MakeCompleteXMLPage();
    }
    echo $this->completeXMLPage;
  }

  function setHeader($header)
  {    $step = 'head'.(count($this->params['Headers']) + 1);
    $this->params['Headers'][$step] = $header;
  }

  function setPageContent($pageContent)
  {
    $this->params['PageContent'] = $pageContent;
  }

  function addPageContent($pageContent)
  {
    $this->params['PageContent'] .= $pageContent;
  }

  function setSessionID($sid)
  {
    $this->params['SessionID'] = $sid;
  }

  function setFileURL($FileURL)
  {
    $this->params['File']['URL'] = $FileURL;
  }

  function setFileMemoryFlag($Memory=__TRUE)
  {
    $this->params['File']['MemoryFlag'] = $Memory;
  }

  function setFlag($FlagName, $param)
  {
    $this->params['Flags'][$FlagName] = $param;
  }

  function setRedirect($redirect)
  {
    $this->params['Redirect'] = $redirect;
  }

  function PageNotFound($pageContent)
  {
    $this->setHeader(__HEADER_PAGE_NOT_FOUND);
  	$this->setPageContent($pageContent);
    $this->MakeCompleteXMLPage();
    $this->display();
  }

  function MakeCompleteXMLPage()
  {    $this->completeXMLPage = $this->Array2XML($this->params);
    $this->completeFlag = __TRUE;
  }

  function Array2XML($array)
  {
    $XMLPage .= "<channel>\r\n";
    $XMLPage .= $this->_Array2XML($array);
    $XMLPage .= "</channel>";

    return $XMLPage;
  }

  function _Array2XML($array)
  {
    foreach($array as $name => $value)
    {
      if(is_array($value))
      {
        $XMLPage .= "\t<".$name.">\r\n\t\t".$this->_Array2XML($value)."</".$name.">\r\n";
      }
      else
      {
        $XMLPage .= "\t<".$name.">".htmlspecialchars($value)."</".$name.">\r\n";
      }
    }
    return $XMLPage;
  }
}

?>