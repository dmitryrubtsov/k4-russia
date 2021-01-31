<?php /* Smarty version 2.6.16, created on 2014-03-21 19:37:37
         compiled from admin.main_menu_block.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'admin.main_menu_block.tpl', 2, false),array('modifier', 'count', 'admin.main_menu_block.tpl', 9, false),)), $this); ?>
<ul class="nav">
	<?php $_from = ((is_array($_tmp=$this->_tpl_vars['AdminMenuTree'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['admmenutree'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['admmenutree']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['curr']):
        $this->_foreach['admmenutree']['iteration']++;
?>
		<?php if (((is_array($_tmp=$this->_tpl_vars['curr'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
			<li>
				<a title="" href="<?php if (((is_array($_tmp=$this->_tpl_vars['curr']['unic_link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))):  echo ((is_array($_tmp=$this->_tpl_vars['curr']['unic_link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  else:  echo ((is_array($_tmp=$this->_tpl_vars['curr']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['curr']['admin_menu_id'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  endif; ?>" <?php if (((is_array($_tmp=$this->_tpl_vars['curr']['maincurr'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?> class="active" <?php endif; ?>>
					<img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['logo'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" width="32" alt="" />
					<span><?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</span>
				</a>
				<?php if (count(((is_array($_tmp=$this->_tpl_vars['curr']['children'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))) > 0): ?>
					<ul>
						<?php $_from = ((is_array($_tmp=$this->_tpl_vars['curr']['children'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['subkey'] => $this->_tpl_vars['subcurr']):
?>
							<li>
								<a <?php if (count(((is_array($_tmp=$this->_tpl_vars['subcurr']['children'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))) > 0): ?> href="#" class="exp" <?php else: ?> href="<?php echo ((is_array($_tmp=$this->_tpl_vars['subcurr']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" title="" <?php endif; ?>>
									<span class="icol-fullscreen"></span><?php echo ((is_array($_tmp=$this->_tpl_vars['subcurr']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

									<?php if (count(((is_array($_tmp=$this->_tpl_vars['subcurr']['children'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))) > 0): ?><span class="dataNumGreen"><?php echo count(((is_array($_tmp=$this->_tpl_vars['subcurr']['children'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))); ?>
</span><?php endif; ?>
								</a>
								<?php if (count(((is_array($_tmp=$this->_tpl_vars['subcurr']['children'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))) > 0): ?>
									<ul>
										<?php $_from = ((is_array($_tmp=$this->_tpl_vars['subcurr']['children'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['subsubkey'] => $this->_tpl_vars['subsubcurr']):
?>
											<li>
												<a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['subsubcurr']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" title="">
													<span class="icol-fullscreen"></span><?php echo ((is_array($_tmp=$this->_tpl_vars['subsubcurr']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

												</a>
											</li>
										<?php endforeach; endif; unset($_from); ?>
									</ul>
								<?php endif; ?>
							</li>
						<?php endforeach; endif; unset($_from); ?>
					</ul>
				<?php endif; ?>
			</li>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
</ul>