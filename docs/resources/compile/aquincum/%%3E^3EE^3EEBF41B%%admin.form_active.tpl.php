<?php /* Smarty version 2.6.16, created on 2014-03-21 19:37:53
         compiled from admin.form_active.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'admin.form_active.tpl', 1, false),)), $this); ?>
<form method="post" action="" name="<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['activeFormName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
<input type="hidden" name="act" value="" />
<input type="hidden" name="<?php echo ((is_array($_tmp=$this->_tpl_vars['WorkTableKeyVarName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" value="" />
<input type="hidden" name="active" value="" />
<input type="hidden" name="varname" value="" />
<input type="hidden" name="varvalue" value="" />
</form>