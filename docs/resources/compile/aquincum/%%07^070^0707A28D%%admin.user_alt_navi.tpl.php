<?php /* Smarty version 2.6.16, created on 2014-03-21 19:37:37
         compiled from admin.user_alt_navi.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'admin.user_alt_navi.tpl', 10, false),)), $this); ?>
<div class="altNav">
	<div class="userSearch">
		<form action="">
			<input type="text" placeholder="search..." name="userSearch" />
			<input type="submit" value="" />
		</form>
	</div>
	<!-- User nav -->
	<ul class="userNav">
		<li><a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" target="_blank" title="" class="profile"></a></li>
						<li><a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
1961/index.php?mode=logout" title="" class="logout"></a></li>
	</ul>
</div>