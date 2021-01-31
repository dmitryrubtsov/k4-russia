<?php /* Smarty version 2.6.16, created on 2014-03-21 19:37:53
         compiled from admin.errors.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'admin.errors.tpl', 1, false),array('modifier', 'is_array', 'admin.errors.tpl', 1, false),array('modifier', 'count', 'admin.errors.tpl', 1, false),)), $this); ?>
<?php if (((is_array($_tmp=$this->_tpl_vars['ErrorMessage'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != '' || is_array(((is_array($_tmp=$this->_tpl_vars['ErrorMessages'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))) && count(((is_array($_tmp=$this->_tpl_vars['ErrorMessages'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))) > 0): ?>
	<table class="error">
		<tr>
			<td class="head"><?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['attention'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td>
		</tr>
		<tr>
			<td class="main">
				<table>
					<?php if (((is_array($_tmp=$this->_tpl_vars['ErrorMessage'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''): ?>
						<tr>
							<td><?php echo ((is_array($_tmp=$this->_tpl_vars['ErrorMessage'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td>
						</tr>
					<?php endif; ?>
					<?php if (count(((is_array($_tmp=$this->_tpl_vars['ErrorMessages'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))) > 0): ?>
						<?php $_from = ((is_array($_tmp=$this->_tpl_vars['ErrorMessages'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['curr']):
?>
							<tr>
								<td><?php echo ((is_array($_tmp=$this->_tpl_vars['curr'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td>
							</tr>
						<?php endforeach; endif; unset($_from); ?>
					<?php endif; ?>
				</table>
			</td>
		</tr>
	</table>
<?php endif; ?>