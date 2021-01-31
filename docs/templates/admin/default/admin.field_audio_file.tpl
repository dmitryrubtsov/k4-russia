<hr />
<input class="{if $Field.className eq ''}inp_inpt{else}{$Field.className}{/if}" type="file" name="{$Field.name}" value="{$Field.value}"{if $Field.id neq ''} id="{$Field.id}"{/if}{if $Field.other neq ''} {$Field.other|unescape}{/if} />{if $Field.textAfterField}&nbsp;{$Field.textAfterField|unescape}{/if}{if $Field.textUnderField}<br /><sup>{$Field.textUnderField|unescape}</sup>{/if}

 {if $Field.remoteServerLink neq ''}{assign var='IMHOST' value=$Field.remoteServerLink}{else}{assign var='IMHOST' value=$HOST|cat:"/"}{/if}
 {foreach from=$Field.file item='curr' key='key'}
  {if $curr neq ''}
  {assign var='piclink' value=$IMHOST|cat:$Field.docroot_dirname|cat:$curr}
  {assign var='iconlink' value=$IMHOST|cat:'images/admin/'}
  <br /><hr /><br />
  {$lang.admin.link}:&nbsp;&nbsp;<a href="{$piclink}" target="_blank">{$piclink}</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="{$lang.admin.delete} {$lang.admin.file}" onClick="if(confirm('{$lang.admin.askToDelFile}')){ldelim}document.forms['{$Config.ImageFormName}'].imageName.value='{$curr|replace:$Field.filetype:''}';document.forms['{$Config.ImageFormName}'].fieldName.value='{$Field.name}';document.forms['{$Config.ImageFormName}'].imageFileType.value='{$Field.filetype}';document.forms['{$Config.ImageFormName}'].dirName.value='{$Field.dirname}';document.forms['{$Config.ImageFormName}'].act.value='deleteimage';document.forms['{$Config.ImageFormName}'].submit();{rdelim}else{ldelim}return false{rdelim}" /><br /><br />
  <img src="{$iconlink}{$Field.filecategory|replace:'.':''|cat:'_icon.png'}" border="0" alt="{$Field.filecategory|replace:'.':''|cat:' file icon'}" width="48" height="48" style="background:{$Config.imageBGColor};" />
  {/if}
 {/foreach}
<hr />