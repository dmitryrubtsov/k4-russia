{assign var="delim" value='&nbsp;&nbsp;'}
<table width="90%" style="margin-left:20px;">
{foreach from=$Folders item=folder}
<tr><td><a href="#" onclick="dbflmgr_HideShowFolder('{$folder.id}');return false;"><img id="shim{$folder.id}" src="{$HOST}/images/icons/hide.jpg" border="0" width="9" height="9" align="absmiddle" /></a>{$delim|unescape}<img id="fldrim{$folder.id}" src="{$HOST}/images/icons/folder_close.png" border="0" width="16" height="16" align="absmiddle" />{$delim|unescape}{if $folder.id != $Config.SiteOrderMainFolderCode && $folder.id != $Config.SiteOrderRecycleBinCode}{include file="admin.linktoitem.tpl" Mode=$AloneMode|cat:'&tp=folder' linkTitle=$folder.title curr=$folder}{else}{$folder.title}{/if}<br />
<div id="divfldr{$folder.id}">
{if $folder.folders|@count > 0}
{include file='admin.body_folder_struct.tpl' Folders=$folder.folders}
{/if}
{if $folder.files|@count > 0}
{foreach from=$folder.files item=file}
{$delim|unescape}{$delim|unescape}<img src="{$HOST}/images/{$Config.IconsImDir}{$file.type}{$Config.IconsFileType}" border="0" align="absmiddle" /> {include file="admin.linktoitem.tpl" Mode=$AloneMode|cat:'&tp=file' linkTitle=$file.filename curr=$file}<br />
{/foreach}
{/if}
</div>
</td></tr>
{/foreach}
</table>