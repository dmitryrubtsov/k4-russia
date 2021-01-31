<?php /* Smarty version 2.6.16, created on 2014-03-21 19:37:53
         compiled from admin.field_value.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'admin.field_value.tpl', 1, false),array('modifier', 'unescape', 'admin.field_value.tpl', 13, false),array('function', 'apply_smarty_mods', 'admin.field_value.tpl', 12, false),array('function', 'eval', 'admin.field_value.tpl', 13, false),)), $this); ?>
<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['defaultValue'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
	<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['colorfield'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == 'y' && ((is_array($_tmp=$this->_tpl_vars['Field']['colorcode'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
		<span style="color:<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['colorcode'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
; font-weight:bold;">
			<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['defaultValue'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

		</span>
	<?php else: ?>
		<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['defaultValue'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

	<?php endif; ?>
<?php else: ?>
	<?php if (((is_array($_tmp=$this->_tpl_vars['FLAGS']['ListingTab'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == ((is_array($_tmp=$this->_tpl_vars['TRUE'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
		<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['inListWzTooltip'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
			<?php echo smarty_function_apply_smarty_mods(array('varname' => "Field.value",'mod_arr' => ((is_array($_tmp=$this->_tpl_vars['Field']['inListWzTooltipSmartyMods'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')),'assign' => 'fldValue'), $this);?>

			<span onmouseover="return escape('<?php echo ((is_array($_tmp=smarty_function_eval(array('var' => ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fldValue'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp))), $this))) ? $this->_run_mod_handler('unescape', true, $_tmp, 'addslashes') : smarty_modifier_unescape($_tmp, 'addslashes'));?>
');">
		<?php endif; ?>
		<?php echo smarty_function_apply_smarty_mods(array('varname' => "Field.value",'mod_arr' => ((is_array($_tmp=$this->_tpl_vars['Field']['inListSmartyMods'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')),'assign' => 'fieldValue'), $this);?>

	<?php else: ?>
		<?php echo smarty_function_apply_smarty_mods(array('varname' => "Field.value",'mod_arr' => ((is_array($_tmp=$this->_tpl_vars['Field']['SmartyMods'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')),'assign' => 'fieldValue'), $this);?>

	<?php endif; ?>

	<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['isLink'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == 'y'): ?>
		<a href="<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['linkURL'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == ''):  echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Field']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp));  else:  echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Field']['linkURL'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp));  endif; ?>"<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['className'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''): ?> class="<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['className'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"<?php endif; ?> target="<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['linkTarget'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
	<?php elseif (((is_array($_tmp=$this->_tpl_vars['Field']['className'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''): ?>
		<span class="<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['className'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
	<?php endif; ?>

	<?php echo smarty_function_eval(array('var' => ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fieldValue'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp))), $this);?>

	<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['isLink'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == 'y'): ?>
		</a>
	<?php elseif (((is_array($_tmp=$this->_tpl_vars['Field']['className'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''): ?>
		</span>
	<?php endif; ?>

<?php endif; ?>

<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['textAfterField'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
	&nbsp;<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Field']['textAfterField'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp)); ?>

<?php endif; ?>
<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['textUnderField'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) && ((is_array($_tmp=$this->_tpl_vars['FLAGS']['ListingTab'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ((is_array($_tmp=$this->_tpl_vars['TRUE'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
	<br /><sup><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Field']['textUnderField'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp)); ?>
</sup>
<?php endif; ?>
<?php if (((is_array($_tmp=$this->_tpl_vars['FLAGS']['ListingTab'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == ((is_array($_tmp=$this->_tpl_vars['TRUE'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) && ((is_array($_tmp=$this->_tpl_vars['Field']['inListWzTooltip'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
	</span>
<?php endif; ?>