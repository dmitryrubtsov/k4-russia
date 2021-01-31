<?php /* Smarty version 2.6.16, created on 2014-03-21 19:37:53
         compiled from admin.buttons_sad.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'admin.buttons_sad.tpl', 4, false),array('modifier', 'unescape', 'admin.buttons_sad.tpl', 6, false),array('function', 'eval', 'admin.buttons_sad.tpl', 6, false),)), $this); ?>
<!--<table>
<tr>
 <td>
  <?php $_from = ((is_array($_tmp=$this->_tpl_vars['ListItemsButtons'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['curr']):
?>
    <?php if (((is_array($_tmp=$this->_tpl_vars['curr']['newRow'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''): ?></td></tr><tr><td><?php endif; ?>
    <?php if (((is_array($_tmp=$this->_tpl_vars['NoUse'][$this->_tpl_vars['key']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == ''): ?><input class="<?php if (((is_array($_tmp=$this->_tpl_vars['curr']['cssClass'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''):  echo ((is_array($_tmp=$this->_tpl_vars['curr']['cssClass'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  else: ?>button<?php endif; ?>" type="button" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" onClick="<?php echo smarty_function_eval(array('var' => ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['curr']['onclick'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp))), $this);?>
" /><?php endif; ?>
  <?php endforeach; endif; unset($_from); ?>
    </td>
</tr>
</table>-->

<ul class="middleNavR">
	<?php $_from = ((is_array($_tmp=$this->_tpl_vars['ListItemsButtons'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['curr']):
?>
		<?php if (((is_array($_tmp=$this->_tpl_vars['NoUse'][$this->_tpl_vars['key']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == ''): ?>
			<li>
				<a href="#" <?php if (((is_array($_tmp=$this->_tpl_vars['curr']['img'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == 'copy.png'): ?>id="go_count_copy"<?php endif; ?> title="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" class="tipN" onClick="<?php echo smarty_function_eval(array('var' => ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['curr']['onclick'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp))), $this);?>
; return false;" >
					<img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['Config']['MainImageFolder'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['Config']['adminImageFolder'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['Config']['adminTheme'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
/icons/middlenav/<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['img'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" alt="" />
				</a>
			</li>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
</ul>