{if !$FLAGS.NoUseDBFileManager}
<script language="javascript">
var imarr = new Array();
imarr['show'] = new Image();
imarr['show'].src = "{$HOST}/images/icons/show.jpg";
imarr['hide'] = new Image();
imarr['hide'].src = "{$HOST}/images/icons/hide.jpg";
imarr['fldr'] = new Image();
imarr['fldr'].src = "{$HOST}/images/icons/folder.png";
imarr['fldrcls'] = new Image();
imarr['fldrcls'].src = "{$HOST}/images/icons/folder_close.png";

function showImg(id)
{ldelim}
  document.getElementById('mimg').src=imarr[id].src;
{rdelim}

function dbflmgr_HideShowFolder(id)
{ldelim}
 if(document.getElementById('divfldr'+id).style.display=='none')
 {ldelim}
  document.getElementById('divfldr'+id).style.display='block';
  document.getElementById('shim'+id).src=imarr['hide'].src;
  document.getElementById('fldrim'+id).src=imarr['fldrcls'].src;
 {rdelim}
 else
 {ldelim}
  document.getElementById('divfldr'+id).style.display='none';
  document.getElementById('shim'+id).src=imarr['show'].src;
  document.getElementById('fldrim'+id).src=imarr['fldr'].src;
 {rdelim}
{rdelim}

function showAddForm(id)
{ldelim}
  document.getElementById(id).style.display='block';
{rdelim}
function hideAddForm(id)
{ldelim}
  document.getElementById(id).style.display='none';
{rdelim}

</script>

{include file='admin.body_folder_struct.tpl' Folders=$Folders}

{include file="admin.buttons_sad.tpl"}

<div id="createfolder" style="display:none">
<div class="subtitle">{$lang.admin.createNewFolder}</div>
{template_exists file="admin."|cat:$GlobPart|cat:".tpl" alternative="admin.item.tpl" assign='filename'}
{include file=$filename BodyTemplate="admin.body_item.tpl" ConfFields=$ConfFields.folder cancelFunction="hideAddForm('createfolder')" ItemAddFormName=$Config.AddFormName|cat:'1'}
</div>

<div id="uploadfile" style="display:none">
<div class="subtitle">{$lang.admin.uploadNewFile}</div>
{template_exists file="admin."|cat:$GlobPart|cat:".tpl" alternative="admin.item.tpl" assign='filename'}
{include file=$filename BodyTemplate="admin.body_item.tpl" ConfFields=$ConfFields.file cancelFunction="hideAddForm('uploadfile')" ItemAddFormName=$Config.AddFormName|cat:'2'}
</div>

<div id="createhtmlfile" style="display:none">
<div class="subtitle">{$lang.admin.createHTMLFile}</div>
{template_exists file="admin."|cat:$GlobPart|cat:".tpl" alternative="admin.item.tpl" assign='filename'}
{include file=$filename BodyTemplate="admin.body_item.tpl" ConfFields=$ConfFields.file_html cancelFunction="hideAddForm('createhtmlfile')" ItemAddFormName=$Config.AddFormName|cat:'3'}
</div>
{/if}


