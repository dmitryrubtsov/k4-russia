<?php /* Smarty version 2.6.16, created on 2014-03-21 19:37:53
         compiled from admin.listingtab_head_begin.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'admin.listingtab_head_begin.tpl', 1, false),array('modifier', 'count', 'admin.listingtab_head_begin.tpl', 7, false),)), $this); ?>
<?php if (((is_array($_tmp=$this->_tpl_vars['NoUse']['Nomer'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == ''): ?>
	<td>#</td>
<?php endif; ?>
<?php if (((is_array($_tmp=$this->_tpl_vars['NoUse']['Checkbox'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == ''): ?>
	<td class="check"><input type="checkbox" onclick="checkItems(this.checked);" /></td>
<?php endif; ?>
<?php if (((is_array($_tmp=$this->_tpl_vars['NoUse']['Edit'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == '' || ((is_array($_tmp=$this->_tpl_vars['NoUse']['SaveButton'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == '' || ((is_array($_tmp=$this->_tpl_vars['NoUse']['DeleteButton'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == '' || count(((is_array($_tmp=$this->_tpl_vars['ListItemIconButtons'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))): ?>
	<td></td>
<?php endif; ?>