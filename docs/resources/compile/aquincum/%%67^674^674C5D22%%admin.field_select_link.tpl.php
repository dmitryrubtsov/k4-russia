<?php /* Smarty version 2.6.16, created on 2014-03-21 19:37:59
         compiled from admin.field_select_link.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'admin.field_select_link.tpl', 1, false),array('modifier', 'unescape', 'admin.field_select_link.tpl', 6, false),array('function', 'eval', 'admin.field_select_link.tpl', 3, false),)), $this); ?>
<?php $_from = ((is_array($_tmp=$this->_tpl_vars['Field']['values'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['curr']):
?>
  <?php if (((is_array($_tmp=$this->_tpl_vars['Field']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
    <a class="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['className'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" href="#" onClick="<?php $_from = ((is_array($_tmp=$this->_tpl_vars['curr']['formFields'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['current']):
?>document.forms['<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['formid'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
'].<?php echo ((is_array($_tmp=$this->_tpl_vars['key1'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
.value='<?php echo smarty_function_eval(array('var' => ((is_array($_tmp=$this->_tpl_vars['current'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))), $this);?>
';<?php endforeach; endif; unset($_from); ?>document.forms['<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['formid'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
'].submit();return false;"><?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>
  <?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['textAfterField'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>&nbsp;<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Field']['textAfterField'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp));  endif;  if (((is_array($_tmp=$this->_tpl_vars['Field']['textUnderField'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?><br /><sup><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Field']['textUnderField'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp)); ?>
</sup><?php endif; ?>