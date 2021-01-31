<hr />
<input class="{if $Field.className eq ''}inp_inpt{else}{$Field.className}{/if}" type="file" name="{$Field.name}" value="{$Field.value}"{if $Field.id neq ''} id="{$Field.id}"{/if}{if $Field.other neq ''} {$Field.other|unescape}{/if} />{if $Field.textAfterField}&nbsp;{$Field.textAfterField|unescape}{/if}{if $Field.textUnderField}<br /><sup>{$Field.textUnderField|unescape}</sup>{/if}

	{if $Item[$Field.name]}
		{assign var='piclink' value=$HOST|cat:'/'|cat:$Item[$Field.name]}
		<br /><hr /><br />
  		{$lang.admin.file} {$lang.admin.fileLink}:&nbsp;&nbsp;<a href="{$piclink}" target="_blank">{$piclink}</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="{$lang.admin.deleteFile}" onClick="if(confirm('{$lang.admin.askToDelFile}')){ldelim}document.forms['{$Config.ImageFormName}'].imageName.value='{$curr|replace:$Field.filetype:''}';document.forms['{$Config.ImageFormName}'].fieldName.value='{$Field.name}';document.forms['{$Config.ImageFormName}'].imageFileType.value='{$Field.filetype}';document.forms['{$Config.ImageFormName}'].dirName.value='{$Field.dirname}';document.forms['{$Config.ImageFormName}'].act.value='deleteimage';document.forms['{$Config.ImageFormName}'].submit();{rdelim}else{ldelim}return false{rdelim}" /><br /><br />
  		<img src="{$piclink}" border="0" alt="{$Field.size}" style="background:{$Config.imageBGColor};" />

	{/if}

<hr />