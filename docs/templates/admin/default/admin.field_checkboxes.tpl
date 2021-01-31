<div class="checkboxes">
<script language="javascript">
function checkElement{$Field.name}(form,value)
{ldelim}
  var length = document.forms[form].length;
  var str = new String();
  for(i=0;i<length;i++)
  {ldelim}
    str = document.forms[form].elements[i].name;
    if(str.match(/^{$Field.name}/))
    {ldelim}      document.forms[form].elements[i].checked=value;
    {rdelim}
  {rdelim}
{rdelim}
{if $Field.joinFunc eq 'y'}
var chList{$Field.name} = new Array();
{foreach from=$Field.values item="curr" key="key"}
chList{$Field.name}['{$key}']="{$curr}";
{/foreach}
function joinElements{$Field.name}(form)
{ldelim}
  var length = document.forms[form].length;
  var str = new String();
  var arr = new Array();
  var k=0;
  for(i=0;i<length;i++)
  {ldelim}
    str = document.forms[form].elements[i].name;
    if(str.match(/^{$Field.name}/))
    {ldelim}
      if(document.forms[form].elements[i].checked!='')
      {ldelim}
        arr[k] = document.forms[form].elements[i].value;
        k++;
      {rdelim}
    {rdelim}
  {rdelim}
  var elem = new String();
  var elemText = new String();
  for(i=0;i<arr.length;i++)
  {ldelim}
    if(i!= 0)
    {ldelim}
     elem=elem+'{if $Field.joinDelim neq ''}{$Field.joinDelim}{else}{$Config.AdminListInRowDelim}{/if}';
     elemText=elemText+'<br />';
    {rdelim}
    elem=elem+arr[i];
    elemText=elemText+chList{$Field.name}[arr[i]];
  {rdelim}
  opener.document.getElementById('{if $Field.parentElemID neq ''}{$Field.parentElemID}{else}{$smarty.get.elemid}{/if}').value=elem;
  opener.document.getElementById('{if $Field.parentElemID neq ''}{$Field.parentElemID}{else}{$smarty.get.elemid}{/if}-list').innerHTML=elemText;
{rdelim}
{/if}
</script>
<a href="#" onclick="checkElement{$Field.name}('{$Config.AddFormName}','checked');return false;">{$lang.admin.checkAll}</a> | <a href="#" onclick="checkElement{$Field.name}('{$Config.AddFormName}','');return false;">{$lang.admin.uncheckAll}</a><br />
{html_checkboxes name=$Field.name options=$Field.values selected=$Field.selected separator=$Field.separator|unescape other=$Field.other|unescape}
<a href="#" onclick="checkElement{$Field.name}('{$Config.AddFormName}','checked');return false;">{$lang.admin.checkAll}</a> | <a href="#" onclick="checkElement{$Field.name}('{$Config.AddFormName}','');return false;">{$lang.admin.uncheckAll}</a>
</div>