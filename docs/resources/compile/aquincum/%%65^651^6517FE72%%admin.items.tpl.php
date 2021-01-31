<?php /* Smarty version 2.6.16, created on 2014-03-21 19:37:53
         compiled from admin.items.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'admin.items.tpl', 4, false),array('modifier', 'unescape', 'admin.items.tpl', 31, false),array('function', 'gen_forms', 'admin.items.tpl', 30, false),array('function', 'eval', 'admin.items.tpl', 31, false),array('function', 'get_defined_param', 'admin.items.tpl', 32, false),)), $this); ?>
<center>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin.javascript_items.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><a id="go_count_copy"></a>
	<?php if (((is_array($_tmp=$this->_tpl_vars['NoUse']['CopyButton'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == ''): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin.message_window.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<div id="copy-message" class="hid">
							<table>
					<tr><td><?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['count'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td><td><input id="copy_count" type="input" value="" /></td></tr>
				</table>
					</div>
		<div class="hid" id="copy-buttons">
			<input class="button" type="button" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['copyButton'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" onclick="document.forms['<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['mainFormName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
'].act.value='copy';document.forms['<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['mainFormName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
'].subtask.value=document.getElementById('copy_count').value;document.forms['<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['mainFormName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
'].submit();" />
			&nbsp;&nbsp;&nbsp;
			<input type="button" class="button" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['cancelButton'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" onclick="hideMessage();" />
		</div>
		<div class="hid" id="copy-title">
			<?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['enterCountOfCopies'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

		</div>
	<?php endif; ?>
	<div id="listing" style="display:block;">
		<?php if (((is_array($_tmp=$this->_tpl_vars['EnableFilter'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == true): ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin.filter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin.errors.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php if (((is_array($_tmp=$this->_tpl_vars['FLAGS']['NotAllLangFieldsInTable'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin.body_megamessage.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>
		<?php echo smarty_function_gen_forms(array('ConfEditForms' => ((is_array($_tmp=$this->_tpl_vars['ConfEditForms'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')),'Item' => ((is_array($_tmp=$this->_tpl_vars['Item'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')),'assign' => 'formsstr'), $this);?>

		<?php echo smarty_function_eval(array('var' => ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['formsstr'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp))), $this);?>

		<?php echo smarty_function_get_defined_param(array('val' => '__FALSE','assign' => 'FALSE'), $this);?>

		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=$this->_tpl_vars['BodyTemplate'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</center>