<?php /* Smarty version 2.6.16, created on 2014-03-21 19:54:45
         compiled from admin.form_filter.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'admin.form_filter.tpl', 1, false),)), $this); ?>
<form method="get" action="" name="<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['filterFormName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
	<input type="hidden" name="mode" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['adminMode'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
	<?php if (((is_array($_tmp=$this->_tpl_vars['menu'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''): ?>
		<input type="hidden" name="menu" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['menu'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
	<?php endif; ?>
	<?php if (((is_array($_tmp=$this->_tpl_vars['leader'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''): ?>
		<input type="hidden" name="leader" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['leader'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
	<?php endif; ?>
	<?php $_from = ((is_array($_tmp=$this->_tpl_vars['listInfo']['useInLink'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['curr']):
?>
		<?php if (((is_array($_tmp=$this->_tpl_vars['curr'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != '' && ((is_array($_tmp=$this->_tpl_vars['listInfo'][$this->_tpl_vars['curr']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''): ?>
			<input type="hidden" name="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['listInfo'][$this->_tpl_vars['curr']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	<?php $_from = ((is_array($_tmp=$this->_tpl_vars['listInfo']['where'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['curr']):
?>
		<input type="hidden" name="<?php echo ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
	<?php endforeach; endif; unset($_from); ?>
</form>