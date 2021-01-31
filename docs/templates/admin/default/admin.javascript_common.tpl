
<script language="javascript">
function makeLinkName(value)
{ldelim}
 var str = new String();str=value;var s = new Array({foreach from=$MakeLinkNameSearchArrJVSC item="curr" key="key" name='sjvsc'}/{$curr|unescape:"nostrip"}/g,{/foreach}/(^\s+)|(\s+$)/g,/(\s+)/g,/(\s+)/g);var r = new Array({foreach from=$MakeLinkNameSearchArrJVSC item="curr" key="key" name='rjvsc'}'{$MakeLinkNameReplaceArr.$key}',{/foreach}""," ",'{$Config.AdminLinkNameDelim}');for(i in s){ldelim}str=str.replace(s[i],r[i]);{rdelim}return str;
{rdelim}
</script>
<script type="text/javascript" src="{$Config.FCKEditorPath}ckeditor.js"></script>
<script type="text/javascript" src="{$HOST}/1961/index.php?mode=ckeditor_templates_js"></script>
