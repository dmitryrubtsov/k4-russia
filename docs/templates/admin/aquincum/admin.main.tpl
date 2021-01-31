{include file="admin.header.tpl"}

<body{if $FLAGS.ResizeWindowToContentParams neq ''} onload="resizeWin();"{/if}>
{if $FLAGS.ResizeWindowToContentParams neq ''}
<script language="javascript">
function resizeWin()
{ldelim}
var wwidth=(window.innerWidth)?window.innerWidth:((document.all)?document.body.offsetWidth:null);
var wheight=(window.innerHeight)?window.innerHeight:((document.all)?document.body.offsetHeight:null);
window.resizeTo(wwidth,wheight);
{rdelim}
</script>
{/if}

{if $FLAGS.ContentOnly eq ''}
{include file="admin.adminmenu.tpl"}
<table id="contenttab" class="contenttab">
 <tr>
  <td valign="top">
<div class="pagetitle">{$PageTitle}</div>
{/if}
<center>



{include file="admin.footer.tpl"}
