<?php /* Smarty version 2.6.16, created on 2014-03-21 19:37:53
         compiled from admin.button_add_edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'admin.button_add_edit.tpl', 2, false),)), $this); ?>
<li>
	<a href="#" title="<?php if (((is_array($_tmp=$this->_tpl_vars['Item'][$this->_tpl_vars['WorkTableKeyFieldName']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == '' || ((is_array($_tmp=$this->_tpl_vars['showAddNewForm'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''):  echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['addButton'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  else:  echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['editButton'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  endif; ?>" class="tipN" onClick="document.forms['<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['AddFormName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
'].act.value='<?php if (((is_array($_tmp=$this->_tpl_vars['Item'][$this->_tpl_vars['WorkTableKeyFieldName']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == '' || ((is_array($_tmp=$this->_tpl_vars['showAddNewForm'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''): ?>addnew<?php else: ?>edititem<?php endif; ?>';<?php if (((is_array($_tmp=$this->_tpl_vars['FLAGS']['ContentOnly'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == 'y'): ?>parent.$.fancybox.close();<?php endif; ?>document.forms['<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['AddFormName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
'].submit();window.parent.$.prettyPhoto.close(); return false;" >
		<img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['Config']['MainImageFolder'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['Config']['adminImageFolder'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['Config']['adminTheme'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
/icons/middlenav/<?php if (((is_array($_tmp=$this->_tpl_vars['Item'][$this->_tpl_vars['WorkTableKeyFieldName']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == '' || ((is_array($_tmp=$this->_tpl_vars['showAddNewForm'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''): ?>add_ico.png<?php else: ?>save_ico.png<?php endif; ?>" alt="" />
	</a>
</li>