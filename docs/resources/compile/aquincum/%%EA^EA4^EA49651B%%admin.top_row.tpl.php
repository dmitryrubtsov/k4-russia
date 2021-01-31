<?php /* Smarty version 2.6.16, created on 2014-03-21 19:37:37
         compiled from admin.top_row.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'admin.top_row.tpl', 2, false),)), $this); ?>
<div class="wrapper" style="min-width:250px;">
	<a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" target="_blank" title="" class="logo">
        <img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['Config']['MainImageFolder'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['Config']['adminImageFolder'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['Config']['adminTheme'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
/background/logo_top_row.png" alt="" />
    </a>

	<!-- Right top nav -->
	<div class="topNav">
		<ul class="userNav">
						<li><a original-title="<?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['toFrontTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['toFrontTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" href="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" class="screen tipN"></a></li>
						<?php if (! ((is_array($_tmp=$this->_tpl_vars['isLogin'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
				<li><a original-title="<?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['logoutTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['logoutTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" href="index.php?mode=logout" class="logout tipN"></a></li>
				<li class="showTabletP"><a href="#" original-title="<?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['showNavigation'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" title="" class="sidebar tipN"></a></li>
			<?php endif; ?>
		</ul>
		<?php if (! ((is_array($_tmp=$this->_tpl_vars['isLogin'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
			<a title="" class="iButton"></a>
		<?php endif; ?>
		
			</div>
	<div id="flag-menu-block">
		<ul>
		    <?php $_from = ((is_array($_tmp=$this->_tpl_vars['LangMenu'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['lmenu'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['lmenu']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['curr']):
        $this->_foreach['lmenu']['iteration']++;
?>
				<li>
					<a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['URL_WITHOUT_LANG'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
&<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['AdminLangVarName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
=<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['locale'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
						<img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['curr']['orig_path'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" width="$curr.orig_width" height="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['orig_height'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
					</a>
				</li>
			<?php endforeach; endif; unset($_from); ?>
		</ul>
	</div>

	<!-- Responsive nav -->
	<ul class="altMenu">
	    <?php $_from = ((is_array($_tmp=$this->_tpl_vars['AdminMenuTree'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['mmenu'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['mmenu']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['curr']):
        $this->_foreach['mmenu']['iteration']++;
?>
	    	<li>
				<a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['Host'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['curr']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" <?php if (((is_array($_tmp=$this->_tpl_vars['curr']['children'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''): ?> class="exp" <?php endif; ?> ><?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>
				<?php if (((is_array($_tmp=$this->_tpl_vars['curr']['children'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''): ?>
					<ul>
						<?php $_from = ((is_array($_tmp=$this->_tpl_vars['curr']['children'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['submenu'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['submenu']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['subcurr']):
        $this->_foreach['submenu']['iteration']++;
?>
							<li><a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['Host'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['subcurr']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['subcurr']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a></li>
						<?php endforeach; endif; unset($_from); ?>
					</ul>
				<?php endif; ?>
			</li>
	    <?php endforeach; endif; unset($_from); ?>
	</ul>
</div>