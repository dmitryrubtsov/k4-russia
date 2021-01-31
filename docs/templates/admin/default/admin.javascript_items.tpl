{include file="admin.javascript_common.tpl"}
<script language="javascript">
function openMyWin(link, name)
{ldelim}
  var newWin = open(link, name, 'status=no,toolbar=no,menubar=no,scrollbars=yes,width=800,height=550');
{rdelim}
function order(form, order)
{ldelim}
  document.forms[form].order.value=order;
  document.forms[form].act.value='';
  document.forms[form].submit();
{rdelim}
function status(form,id,value)
{ldelim}
  document.forms[form].act.value='status';
  document.forms[form].{$WorkTableKeyVarName}.value=id;
  document.forms[form].active.value=value;
  document.forms[form].submit();
{rdelim}
function option(act,form,id,value)
{ldelim}
  document.forms[form].act.value=act;
  document.forms[form].{$WorkTableKeyVarName}.value=id;
  document.forms[form].active.value=value;
  document.forms[form].submit();
{rdelim}

function showAddNewForm()
{ldelim}
  document.getElementById('addnewitem').style.display='block';
  document.getElementById('listing').style.display='none';
{rdelim}
function hideAddNewForm()
{ldelim}
  document.getElementById('addnewitem').style.display='none';
  document.getElementById('listing').style.display='block';
{rdelim}
</script>