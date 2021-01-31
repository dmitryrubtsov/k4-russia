<?php /* Smarty version 2.6.16, created on 2014-03-21 19:37:53
         compiled from admin.item.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'admin.item.tpl', 9, false),array('modifier', 'unescape', 'admin.item.tpl', 9, false),array('modifier', 'count', 'admin.item.tpl', 129, false),array('function', 'gen_forms', 'admin.item.tpl', 22, false),array('function', 'eval', 'admin.item.tpl', 23, false),array('function', 'gen_fields', 'admin.item.tpl', 43, false),)), $this); ?>
<script language="javascript">

function makeLinkName(value)
{
    //alert('my test');
	var str = new String();
	str=value;
	var s = new Array(<?php $_from = ((is_array($_tmp=$this->_tpl_vars['MakeLinkNameSearchArrJVSC'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['sjvsc'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['sjvsc']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['curr']):
        $this->_foreach['sjvsc']['iteration']++;
?>/\<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['curr'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp, 'addslashes') : smarty_modifier_unescape($_tmp, 'addslashes')); ?>
/g,<?php endforeach; endif; unset($_from); ?>/(^\\s+)|(\\s+$)/g,/(\\s+)/g,/(\\s+)/g);
	var r = new Array(<?php $_from = ((is_array($_tmp=$this->_tpl_vars['MakeLinkNameSearchArrJVSC'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rjvsc'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rjvsc']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['curr']):
        $this->_foreach['rjvsc']['iteration']++;
?>'<?php echo ((is_array($_tmp=$this->_tpl_vars['MakeLinkNameReplaceArr'][$this->_tpl_vars['key']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
',<?php endforeach; endif; unset($_from); ?>""," ",'<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['AdminLinkNameDelim'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
');
	for(i in s)
	{
		str=str.replace(s[i],r[i]);
	}

	return str;
}

</script>
<div class="fluid">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin.javascript_common.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php echo smarty_function_gen_forms(array('ConfEditForms' => ((is_array($_tmp=$this->_tpl_vars['ConfEditForms'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')),'Item' => ((is_array($_tmp=$this->_tpl_vars['Item'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')),'assign' => 'formsstr'), $this);?>

	<?php echo smarty_function_eval(array('var' => ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['formsstr'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp))), $this);?>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin.form_image.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin.message_window.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin.errors.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<form method="post" action="" name="<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['AddFormName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" enctype="multipart/form-data" id="validate">
		<input type="hidden" name="act" value="" />
		<?php if (((is_array($_tmp=$this->_tpl_vars['Item'][$this->_tpl_vars['WorkTableKeyFieldName']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != '' && ((is_array($_tmp=$this->_tpl_vars['showAddNewForm'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == ''): ?>
			<input type="hidden" name="<?php echo ((is_array($_tmp=$this->_tpl_vars['WorkTableKeyVarName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['Item'][$this->_tpl_vars['WorkTableKeyFieldName']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
		<?php endif; ?>
		<fieldset>
			<div class="widget">
				<div class="whead"><h6><?php echo ((is_array($_tmp=$this->_tpl_vars['PageTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  if (! ((is_array($_tmp=$this->_tpl_vars['Item'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?> - <?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['addNewItem'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  endif; ?></h6></div>
								<?php echo smarty_function_gen_fields(array('ConfFields' => ((is_array($_tmp=$this->_tpl_vars['ConfFields'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')),'Item' => ((is_array($_tmp=$this->_tpl_vars['Item'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')),'assign' => 'fieldsstr'), $this);?>

				<?php echo smarty_function_eval(array('var' => ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fieldsstr'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp))), $this);?>

           
			</div>
		</fieldset>
	</form>
</div>
<ul class="middleNavR">
	<?php if (((is_array($_tmp=$this->_tpl_vars['NoUse']['SaveItemButton'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == ''): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin.button_add_edit.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
	<?php if (((is_array($_tmp=$this->_tpl_vars['Item'][$this->_tpl_vars['WorkTableKeyFieldName']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != '' && ((is_array($_tmp=$this->_tpl_vars['showAddNewForm'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == ''): ?>
		<?php if (((is_array($_tmp=$this->_tpl_vars['NoUse']['BackButton'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == ''): ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin.button_back.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>
		<?php $_from = ((is_array($_tmp=$this->_tpl_vars['ItemButtons'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['curr']):
?>
			<?php if (((is_array($_tmp=$this->_tpl_vars['curr']['newRow'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''): ?><br /><br /><?php endif; ?>
			<li>
				<a href="#" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" class="tipN" onclick="<?php echo smarty_function_eval(array('var' => ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['curr']['onclick'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp))), $this);?>
">
					<img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['Config']['MainImageFolder'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['Config']['adminImageFolder'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['Config']['adminTheme'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
/icons/middlenav/<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['img'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" alt="" />
				</a>
			</li>
					<?php endforeach; endif; unset($_from); ?>
	<?php else: ?>
		<?php if (((is_array($_tmp=$this->_tpl_vars['onlyAddItem'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) && count(((is_array($_tmp=$this->_tpl_vars['ItemButtons'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))): ?>
			<?php $_from = ((is_array($_tmp=$this->_tpl_vars['ItemButtons'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['curr']):
?>
				<?php if (((is_array($_tmp=$this->_tpl_vars['curr']['newRow'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''): ?><br /><br /><?php endif; ?>
				<li>
					<a href="#" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" class="tipN" onclick="<?php echo smarty_function_eval(array('var' => ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['curr']['onclick'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp))), $this);?>
">
						<img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['Config']['MainImageFolder'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['Config']['adminImageFolder'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['Config']['adminTheme'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
/icons/middlenav/<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['img'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" alt="" />
					</a>
				</li>
			<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>
		<?php if (((is_array($_tmp=$this->_tpl_vars['NoUse']['BackButton'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == ''): ?>
			<li>
				<a href="#" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['cancelButton'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" class="tipN" onclick="hideAddNewForm(); return false;">
					<img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['Config']['MainImageFolder'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['Config']['adminImageFolder'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['Config']['adminTheme'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
/icons/middlenav/cancel_ico.png" alt="" />
				</a>
			</li>
		<?php endif; ?>
	<?php endif; ?>
</ul>