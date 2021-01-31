<?php /* Smarty version 2.6.16, created on 2014-03-21 20:00:13
         compiled from admin.field_relation_field.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'admin.field_relation_field.tpl', 1, false),array('modifier', 'unescape', 'admin.field_relation_field.tpl', 5, false),array('function', 'apply_smarty_mods', 'admin.field_relation_field.tpl', 16, false),)), $this); ?>
<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['listToField'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == 'y' || ((is_array($_tmp=$this->_tpl_vars['Field']['listOfRelations'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == 'y'): ?>
	<script language="javascript">
		function openWindow<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
()
		{
 			myWin=open("<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['openLink'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''):  echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Field']['openLink'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp));  else: ?>index.php?<?php $_from = ((is_array($_tmp=$this->_tpl_vars['Field']['openLinkParams'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
 echo ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
=<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp)); ?>
&<?php endforeach; endif; unset($_from);  endif; ?>", "joinlist<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
","width=<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['width'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''):  echo ((is_array($_tmp=$this->_tpl_vars['Field']['width'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  else: ?>350<?php endif; ?>,height=<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['height'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''):  echo ((is_array($_tmp=$this->_tpl_vars['Field']['height'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  else: ?>350<?php endif; ?>,status=no,toolbar=no,menubar=no,scrollbars=yes");
 			myWin.focus();
		}
		function setBlank<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
()
		{
			document.getElementById('<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['id'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
').value='';
			document.getElementById('<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['id'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
-list').innerHTML='<?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['noValues'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
';
		}
	</script>
<?php endif; ?>

<?php echo smarty_function_apply_smarty_mods(array('varname' => "Field.value",'mod_arr' => ((is_array($_tmp=$this->_tpl_vars['Field']['SmartyMods'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')),'assign' => 'fieldValue'), $this);?>

<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['listToField'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == 'y' || ((is_array($_tmp=$this->_tpl_vars['Field']['listOfRelations'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == 'y'): ?>
	&nbsp;&nbsp;
	<a href="#" onclick="openWindow<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
();return false;">
		<img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
/images/admin/edit_ico.gif" border="0" align="absmiddle" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['edit'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['edit'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" onclick="this.blur();" />
	</a>
<?php endif; ?>
<br />
<span id="<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['id'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
-list" onclick="openWindow<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
();">
	<?php $_from = ((is_array($_tmp=$this->_tpl_vars['Field']['listValues'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['curr']):
?>
		<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['curr'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp)); ?>
<br />
	<?php endforeach; endif; unset($_from); ?>
</span>
<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['textUnderField'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
	<br />
	<sup><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Field']['textUnderField'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp)); ?>
</sup>
<?php endif; ?>
<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['listToField'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == 'y'): ?>
	<input type="hidden" name="<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" id="<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['id'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
<?php elseif (((is_array($_tmp=$this->_tpl_vars['Field']['listOfRelations'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == 'y'): ?>
	<input type="hidden" name="<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" id="<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['id'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" value="<?php $_from = ((is_array($_tmp=$this->_tpl_vars['Field']['listValues'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['listarr'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['listarr']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['curr']):
        $this->_foreach['listarr']['iteration']++;
 if (((is_array($_tmp=($this->_foreach['listarr']['iteration'] <= 1))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != true): ?>,<?php endif;  echo ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  endforeach; endif; unset($_from); ?>" />
<?php endif; ?>