<?php /* Smarty version 2.6.16, created on 2014-03-21 19:37:37
         compiled from admin.user_logo_block.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'admin.user_logo_block.tpl', 4, false),)), $this); ?>
<div class="user">
		<ul class="leftUser">
		<li><a href="#" title="" class="sProfile"><?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['userProfile'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a></li>
						<li><a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
1961/index.php?mode=logout" title="" class="sLogout"><?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['logout'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a></li>
	</ul>
</div>