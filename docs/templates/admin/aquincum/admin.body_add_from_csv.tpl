
<script language="javascript">
var Fields = new Array();
var UsedFields = new Array();
{foreach from=$CSVFields item="curr" key="key" name="list"}
Fields['{$key}']="{$curr.title}";
{/foreach}
var FieldsCount = {$smarty.foreach.list.total};

function initMField(id)
{ldelim}
  optionTest = true;
  lgth = document.getElementById(id).options.length - 1;
  document.getElementById(id).options[lgth] = null;
  if (document.getElementById(id).options[lgth]) optionTest = false;
  setMField(id);
{rdelim}

function setMField(item)
{ldelim}
  if (!optionTest) return;
  var CurrFields = new Array();
  CurrFields[0]=new Array("","{$lang.admin.noUse}");
  var n=1;
  for(i in Fields)
  {ldelim}
    var usedFlag=false;
    for(k in UsedFields)
    {ldelim}
      if(i == UsedFields[k]) usedFlag=true;
    {rdelim}
    if(!usedFlag)
    {ldelim}
      CurrFields[n]=new Array(i,Fields[i]);
      n++;
    {rdelim}
  {rdelim}

  var box = document.getElementById(item);
  box.options.length = 0;
  box.disabled="";
  for(i=0;i<CurrFields.length;i++)
  {ldelim}
    box.options[i] = new Option(CurrFields[i][1],CurrFields[i][0]);
  {rdelim}
{rdelim}
function setMFieldValue(number,value)
{ldelim}
  UsedFields[number]=value;
  if(value=='')
  {ldelim}
    resetMFields(number);
  {rdelim}
  else
  {ldelim}    resetMFields((number+1));
    initMField('field_'+(number+1));
  {rdelim}
{rdelim}
function resetMFields(number)
{ldelim}
  for(i=number;i<=FieldsCount;i++)
  {ldelim}
    if((i+1)<=FieldsCount)
    {ldelim}
      document.getElementById('field_'+(i+1)).disabled=true;
      document.getElementById('field_'+(i+1)).selectedIndex=0;
      UsedFields[(i+1)]='';
    {rdelim}
  {rdelim}
{rdelim}
</script>

<form enctype="multipart/form-data" method="post" action="{$BlankLink|unescape}" name="addCSV">
<input type="hidden" name="act" value="{$NextAction}" />
<table>
<tr><td>{$lang.admin.dataInColumnsInCSV}</td>
{foreach from=$CSVFields item="curr" key="key"}
{counter name="add_keyword" assign="number"}
 <td><select name="field_{$number}" id="field_{$number}" onchange="setMFieldValue({$number},this.value);" disabled><option>{$lang.admin.noUse}</option></select></td>
{/foreach}
</tr>
</table>
<br />
<table>
 <tr>
  <td>{$lang.admin.CSVFile}:&nbsp;&nbsp;<input type="file" name="csv_file" /></td>
 </tr>
 <tr>
  <td><br /><br /><input class="button" type="button" value="<< {$lang.admin.back}" onclick="document.location.href='{$BlankLink|unescape}&{$Config.AdminActionGetVar}={$PrevAction}';" />&nbsp;&nbsp;
  <input class="button" type="button" value="{$lang.admin.next} >>"  onclick="document.forms['addCSV'].submit();" /></td>
 </tr>
</table>
</form>
<script language="javascript">
initMField('field_1');
</script>