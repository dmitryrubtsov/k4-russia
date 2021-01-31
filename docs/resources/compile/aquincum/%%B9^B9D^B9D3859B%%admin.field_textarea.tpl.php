<?php /* Smarty version 2.6.16, created on 2014-03-21 19:37:53
         compiled from admin.field_textarea.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'admin.field_textarea.tpl', 1, false),array('modifier', 'unescape', 'admin.field_textarea.tpl', 6, false),array('function', 'apply_smarty_mods', 'admin.field_textarea.tpl', 2, false),array('function', 'eval', 'admin.field_textarea.tpl', 19, false),)), $this); ?>
<?php if (((is_array($_tmp=$this->_tpl_vars['FLAGS']['ListingTab'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == ((is_array($_tmp=$this->_tpl_vars['TRUE'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
	<?php echo smarty_function_apply_smarty_mods(array('varname' => "Field.value",'mod_arr' => ((is_array($_tmp=$this->_tpl_vars['Field']['inListSmartyMods'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')),'assign' => 'fieldValue'), $this);?>

<?php else: ?>
	<?php echo smarty_function_apply_smarty_mods(array('varname' => "Field.value",'mod_arr' => ((is_array($_tmp=$this->_tpl_vars['Field']['SmartyMods'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')),'assign' => 'fieldValue'), $this);?>

<?php endif; ?>
<textarea class="<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['className'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == ''): ?>inp_txtarea<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['Field']['className'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  endif; ?>" name="<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['id'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''): ?> id="<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['id'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"<?php endif;  if (((is_array($_tmp=$this->_tpl_vars['Field']['maxlength'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''): ?> maxlength="<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['maxlength'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"<?php endif;  if (((is_array($_tmp=$this->_tpl_vars['Field']['cols'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''): ?> cols="<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['cols'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"<?php endif;  if (((is_array($_tmp=$this->_tpl_vars['Field']['rows'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''): ?> rows="<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['rows'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"<?php endif;  if (((is_array($_tmp=$this->_tpl_vars['Field']['other'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''):  echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Field']['other'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp));  endif; ?>
<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['makeSameValue'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''): ?>
    onchange="document.forms['<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['AddFormName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
'].<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['makeSameValue'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
.value=<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['makeSameValueFunc'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''):  echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Field']['makeSameValueFunc'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp));  else: ?>this.value.toLowerCase()<?php endif; ?>;"
    onkeyup="document.forms['<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['AddFormName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
'].<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['makeSameValue'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
.value=<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['makeSameValueFunc'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''):  echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Field']['makeSameValueFunc'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp));  else: ?>this.value.toLowerCase()<?php endif; ?>;"
    onclick="document.forms['<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['AddFormName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
'].<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['makeSameValue'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
.value=<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['makeSameValueFunc'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''):  echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Field']['makeSameValueFunc'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp));  else: ?>this.value.toLowerCase()<?php endif; ?>;"

<?php endif; ?>
        >
	<?php echo smarty_function_eval(array('var' => ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fieldValue'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp))), $this);?>

</textarea>



<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['textAfterField'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
	&nbsp;<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Field']['textAfterField'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp)); ?>

<?php endif; ?>
<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['textUnderField'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
	<br /><sup><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Field']['textUnderField'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp)); ?>
</sup>
<?php endif; ?>