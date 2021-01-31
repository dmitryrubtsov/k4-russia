<?php /* Smarty version 2.6.16, created on 2014-03-21 19:54:45
         compiled from admin.field_select.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin.field_select.tpl', 1, false),array('modifier', 'escape', 'admin.field_select.tpl', 1, false),array('modifier', 'unescape', 'admin.field_select.tpl', 1, false),)), $this); ?>
<?php echo smarty_function_html_options(array('name' => ((is_array($_tmp=$this->_tpl_vars['Field']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')),'options' => ((is_array($_tmp=$this->_tpl_vars['Field']['values'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')),'selected' => ((is_array($_tmp=$this->_tpl_vars['Field']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')),'id' => ((is_array($_tmp=$this->_tpl_vars['Field']['id'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')),'other' => ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Field']['other'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp))), $this);?>

<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['textAfterField'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
	&nbsp;<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Field']['textAfterField'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp)); ?>

<?php endif; ?>
<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['textUnderField'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
	<br /><sup><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Field']['textUnderField'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp)); ?>
</sup>
<?php endif; ?>