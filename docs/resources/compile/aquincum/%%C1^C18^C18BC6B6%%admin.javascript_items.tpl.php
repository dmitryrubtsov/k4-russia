<?php /* Smarty version 2.6.16, created on 2014-03-21 19:37:53
         compiled from admin.javascript_items.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'admin.javascript_items.tpl', 18, false),)), $this); ?>
<script language="javascript">
	function openMyWin(link, name)
	{
		var newWin = open(link, name, 'status=no,toolbar=no,menubar=no,scrollbars=yes,width=800,height=550');
	}

	function order(form, order)
	{
		document.forms[form].order.value=order;
		document.forms[form].act.value='';
		document.forms[form].submit();
	}

function status(form,id,value)
{
  document.forms[form].act.value='status';
  document.forms[form].<?php echo ((is_array($_tmp=$this->_tpl_vars['WorkTableKeyVarName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
.value=id;
  document.forms[form].active.value=value;
  document.forms[form].submit();
}
function option(act,form,id,value)
{
  document.forms[form].act.value=act;
  document.forms[form].<?php echo ((is_array($_tmp=$this->_tpl_vars['WorkTableKeyVarName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
.value=id;
  document.forms[form].active.value=value;
  document.forms[form].submit();
}

	function showAddNewForm()
	{
		document.getElementById('addnewitem').style.display='block';
		document.getElementById('listing').style.display='none';
	}

	function hideAddNewForm()
	{
		document.getElementById('addnewitem').style.display='none';
		document.getElementById('listing').style.display='block';
	}
</script>