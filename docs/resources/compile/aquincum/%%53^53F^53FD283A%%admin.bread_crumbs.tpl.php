<?php /* Smarty version 2.6.16, created on 2014-03-21 19:37:37
         compiled from admin.bread_crumbs.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'admin.bread_crumbs.tpl', 5, false),)), $this); ?>
<!-- Breadcrumbs line -->
<div class="breadLine">
	<div class="bc">
		<ul id="breadcrumbs" class="breadcrumbs">
			<li><a ><?php echo ((is_array($_tmp=$this->_tpl_vars['MainMenuCurr'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a></li>
			<li><a ><?php echo ((is_array($_tmp=$this->_tpl_vars['SubMenuCurr'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>
							</li>
					</ul>
	</div>
	</div>