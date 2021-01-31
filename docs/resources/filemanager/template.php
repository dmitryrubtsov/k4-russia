<?
/*
 * DF-FileManager
 * Version: 1.1 (8/02/2011)
 * Copyright (c) 2011 Dmytro Feshchenko www.df-studio.net
 * Licensed under the MIT License: http://en.wikipedia.org/wiki/MIT_License
*/
?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=<?=__CFG_FLMGR_LANG_CHARSET;?>">
  <link href="style.css" rel=stylesheet type=text/css />
  <title>DF-FileManager</title>
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/pshadow.js"></script>
  <script type="text/javascript" src="js/dialogbox.js"></script>
  <script type="text/javascript" src="js/actionbox.js"></script>
  <script type="text/javascript">
  var dboxLang = {title:'<?=$Lang->Attention;?>',okButton:'<?=$Lang->OkButton;?>',cancelButton:'<?=$Lang->CancelButton;?>',upload:'<?=$Lang->Upload;?>',uploadFile:'<?=$Lang->UploadNewFile?>',create:'<?=$Lang->Create;?>',createFolder:'<?=$Lang->CreateNewFolder;?>',askDelFolder:'<?=$Lang->AskDeleteFolder;?>',askDelFile:'<?=$Lang->AskDeleteFile;?>'};//'
  var PShadow = new PageShadow();var Params = {animation:{type:'fade',speed:200},pShadow:PShadow,cssClass:'dialogbox',title:dboxLang.title};var dbox = new DialogBox(Params);var act = new ActionBox({goAddFunc:function(){$('#pwait').show();$('#maintdiv').hide();}});$(function(){$.config={cbfn:'<?=$Config->ReturnCallbackFunctionName;?>',gp:'<?=__CFG_FLMGR_GET_PATH;?>',pa:'<?=__CFG_FLMGR_POST_ACTION;?>',pf:'<?=__CFG_FLMGR_POST_FOLDER;?>',pfl:'<?=__CFG_FLMGR_POST_FILE;?>',aa:'<?=__CFG_FLMGR_ACT_ADD;?>',adf:'<?=__CFG_FLMGR_ACT_DEL_FILE;?>',adfd:'<?=__CFG_FLMGR_ACT_DEL_FOLDER;?>',efn:'<?=$Config->EditorFunc;?>',ph:'<?=MF::hex(__CFG_FLMGR_WWW_PATH);?>',flt:'<?=__CFG_FLMGR_GET_FILTER;?>',cflt:'<?=__CFG_FLMGR_GET_CHANGE_FILTER;?>',lng:'<?=__CFG_FLMGR_GET_LANGUAGE;?>',dbox:dbox,dboxLang:dboxLang};});
  </script>
  <script type="text/javascript" src="js/fmfunc.js"></script>
</head>
<body>
<div id="pwait"><img src="<?=__CFG_FLMGR_IMAGE_FOLDER;?>pwait.gif" border="0" width="32" height="32" /></div>
<?

if(!MF::isBlank($Config->ErrorMessage))
{?>
<script type="text/javascript">
$('#pwait').hide();
dbox.show({
	body:"<?=$Config->ErrorMessage;?>",
	cssClass:'dialogbox_err',
	buttons:{
		ok:{
			title:dboxLang.okButton,
			onclick:function(){
<?
  if($Config->ErrorMessageCode == __CFG_FLMGR_ERROR_GO_HOME)
  {?>
				var get={};
				get[$.config.gp] = '/';
				act.go({get:get});
				$('#pwait').show();
<?
  }
  elseif($Config->ErrorMessageCode == __CFG_FLMGR_ERROR_CLOSE_WINDOW)
  {
?>
                self.close();
<?
  }
?>
			}
		}
	}
})
</script>
<?
}
elseif(!MF::isBlank($browser->ErrorMessage))
{
  $Message = $browser->ErrorMessage;
  //echo $Lang->Error->$Message;
?>
<script type="text/javascript">
$('#pwait').hide();
dbox.show({	body:"<?=$Lang->Error->$Message;?>",
	cssClass:'dialogbox_err',
	buttons:{		ok:{			title:dboxLang.okButton,
			onclick:function(){				act.go();
				$('#pwait').show();			}		}	}
})
</script>
<?
}
else
{
?>
<div id="maintdiv">
<table id="maintable">
 <tr>
  <td id="maintabletd">
  <div class="buttons" id="buttonstop">
  <table><tr>
  <td class="space">
   <div class="spaceinf"><?=$Lang->SpaceUsage;?>: <?=number_format($browser->SpaceUsed, 2, ',', ' ').' '.__CFG_FLMGR_FILE_SIZE_PARAM;?> <?=$Lang->from;?>  <?=$browser->SpaceLimit.' '.__CFG_FLMGR_FILE_SIZE_PARAM;?></div>
   <div class="space_limit"><div class="space_used"></div><div class="space_info"><?=round($browser->SpaceUsed/$browser->SpaceLimit*100)?>%</div></div>
   <div class="spaceinf"><?=$Lang->FreeSpace;?>: <?=number_format($browser->SpaceFree, 2, ',', ' ').' '.__CFG_FLMGR_FILE_SIZE_PARAM;?></div>
  </td>
  <td class="bttns">
   <a class="action" onclick="createFolder();"><img src="<?=__CFG_FLMGR_IMAGE_FOLDER;?>addfd.png" align="absmiddle" /><?=$Lang->CreateNewFolder?></a>
   <a class="action" onclick="uploadFile();"><img src="<?=__CFG_FLMGR_IMAGE_FOLDER;?>addf.png" align="absmiddle" /><?=$Lang->UploadNewFile?></a>
  </td>
  <td class="lang">
<?
  foreach($Config->Languages as $lang => $name)
  {
?>
   <a class="lang" title="<?=$name;?>" id="<?=$lang;?>"><img src="<?=__CFG_FLMGR_IMAGE_FOLDER;?>lang/<?=$lang;?>.png" alt="<?=$name;?>" /></a>
<?
  }
?>
  </td>
  </tr></table>
<script type="text/javascript">if($.browser.msie){$("div.space_limit").css('height',(parseInt($("div.space_limit").css('height'))+1));}$("div.space_limit").css('width','200');var wdth1 = parseInt($("div.space_limit").css('width'));var wdth=Math.round(wdth1*<?=($browser->SpaceUsed/$browser->SpaceLimit);?>);$("div.space_used").css({width:((wdth<wdth1)?wdth:wdth1)});</script>
  </div>
  <div id="path">
  <span><?=$Lang->FileFilter;?>:</span><select id="filter">
<?
  foreach($Lang->Filter as $code => $name)
  {?>
  <option value="<?=$code;?>"<?if($browser->Filter == $code)echo " selected";?>><?=$name?></option>
<?
  }
?>
  </select>
<?
	echo '<span>'.$Lang->Path.':</span> <a r="'.__CFG_FLMGR_GET_PATH.'" f="/">/</a>';
	foreach($browser->PathMap as $n => $path)
	{	  echo '<a r="'.__CFG_FLMGR_GET_PATH.'" f="'.$path['path'].'">'.$path['title'].'/</a>';
	}
?>
  </div>
  <div id="content">
   <table>
<?
	if(!MF::isEmptyArr($browser->PrevPath))
	{	  $folder = $browser->PrevPath;
	  echo '<tr><td class="folder" f="'.$folder['path'].'"><img src="'.__CFG_FLMGR_IMAGE_FOLDER.'folder_up.gif" align="absmiddle" />'.$folder['title'].'</td><td></td><td></td><td></td></tr>';
	}
	foreach($browser->Folders as $n => $folder)
	{
	  echo '<tr><td class="folder" f="'.$folder['path'].'"><img src="'.__CFG_FLMGR_IMAGE_FOLDER.'folder.gif" align="absmiddle" />'.$folder['title'].'</td><td class="size">'.number_format($folder['size'], 2, ',', ' ').' '.__CFG_FLMGR_FILE_SIZE_PARAM.'</td><td class="date">'.date("d.m.Y H:i", $folder['date']).'</td><td>'.((MF::isBlank($folder['noDelete'])) ? '<a class="delfd" title="'.$Lang->Delete.'"><img src="'.__CFG_FLMGR_IMAGE_FOLDER.'delete.png" alt="'.$Lang->Delete.'" /></a>' : '').'</td></tr>';
	}

	foreach($browser->Files as $n => $file)
	{
	  echo '<tr><td class="file" f="'.$file['path'].'"><img src="'.__CFG_FLMGR_ICON_IMAGE_FOLDER.$file['ext'].'.gif" align="absmiddle" />'.$file['title'].'</td><td class="size">'.number_format($file['size'], 2, ',', ' ').' '.__CFG_FLMGR_FILE_SIZE_PARAM.'</td><td class="date">'.date("d.m.Y H:i", $file['date']).'</td><td><a class="delf" title="'.$Lang->Delete.'"><img src="'.__CFG_FLMGR_IMAGE_FOLDER.'delete.png" alt="'.$Lang->Delete.'" /></a><a class="viewf" title="'.$Lang->View.'"><img src="'.__CFG_FLMGR_IMAGE_FOLDER.'view.png" alt="'.$Lang->View.'" /></a></td></tr>';
	}
?>
   </table>
  </div>
  <div class="buttons" id="buttonsbot"></div>
  <div id="copy">
 <b>DF-FileManager v1.0</b> Copyright &copy; 2010 Dmytro Feshchenko <a href="http://www.df-studio.net" target="_blank">www.df-studio.net</a> <a href="http://en.wikipedia.org/wiki/MIT_License" target="_blank">MIT License</a>
  </div>
  </td>
 </tr>
</table>
<div id="create_folder_div" style="display:none;">
 <div><?=$Lang->FolderName;?>: <input type="text" /></div>
 <div class="error" style="display:none;"><?=$Lang->PleaseEnterFolderName;?></div>
</div>
<div id="upload_file_div" style="display:none;">
 <form enctype="multipart/form-data">
 <div><?=$Lang->SelectFile;?>: <input type="file" name="<?=__CFG_FLMGR_POST_FILE;?>" /></div>
 <div class="error" style="display:none;"><?=$Lang->PleaseSelectFileToUpload;?></div>
 </form>
</div>
</div>
<script type="text/javascript">$('#buttonsbot').html($('#buttonstop').html());$('#pwait').hide();$('#maintdiv').show();</script>
<?
}
?>
</body>
</html>