<?php /* Smarty version 2.6.16, created on 2014-03-21 19:37:37
         compiled from admin.submenu_block.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'admin.submenu_block.tpl', 11, false),array('modifier', 'count', 'admin.submenu_block.tpl', 11, false),)), $this); ?>
<div id="tab-container" class="tab-container">
	<ul class="iconsLine ic3 etabs">
		<li><a href="#general" title=""><span class="icos-fullscreen"></span></a></li>
		<li><a href="#info" title=""><span class="icos-user"></span></a></li>
        <li><a href="#pass" title=""><span class="icos-photos"></span></a></li>
	</ul>

	<div class="divider"><span></span></div>

	<div id="general">
		<?php if (((is_array($_tmp=$this->_tpl_vars['AdminSubmenuTree'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) && count(((is_array($_tmp=$this->_tpl_vars['AdminSubmenuTree'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))) > 0): ?>
			<ul class="subNav">
				<?php $_from = ((is_array($_tmp=$this->_tpl_vars['AdminSubmenuTree'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['submenu'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['submenu']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['curr']):
        $this->_foreach['submenu']['iteration']++;
?>
					<li>
						<a <?php if (count(((is_array($_tmp=$this->_tpl_vars['curr']['children'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))) > 0): ?> href="#" title="" class="exp" <?php else:  if (((is_array($_tmp=$this->_tpl_vars['curr']['unic_link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?> href="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['unic_link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  else: ?> href="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['curr']['parent_admin_menu_id'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  endif; ?>" title="" <?php if (((is_array($_tmp=$this->_tpl_vars['curr']['subcurr'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == 'curr'): ?> class="this" <?php endif;  endif; ?>>
														<img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['logo'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" width="12" />
							<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
 						</a>
						<?php if (count(((is_array($_tmp=$this->_tpl_vars['curr']['children'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))) > 0): ?>
							<ul>
								<?php $_from = ((is_array($_tmp=$this->_tpl_vars['curr']['children'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['subsubmenu'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['subsubmenu']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['subkey'] => $this->_tpl_vars['subcurr']):
        $this->_foreach['subsubmenu']['iteration']++;
?>
									<li>
										<a href="<?php if (((is_array($_tmp=$this->_tpl_vars['subcurr']['unic_link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))):  echo ((is_array($_tmp=$this->_tpl_vars['subcurr']['unic_link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  else:  echo ((is_array($_tmp=$this->_tpl_vars['subcurr']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['curr']['parent_admin_menu_id'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  endif; ?>"><?php echo ((is_array($_tmp=$this->_tpl_vars['subcurr']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>
									</li>
								<?php endforeach; endif; unset($_from); ?>
							</ul>
						<?php endif; ?>
					</li>
				<?php endforeach; endif; unset($_from); ?>
			</ul>
		<?php endif; ?>
	</div>

	<div id="info">
		<div class="profile-block">
            <div class="profile-title"><?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['youDataAsAdmin'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</div>
            <form method="post" action="">
                <input type="hidden" name="act" value="EditAdminUser" />
                <input type="hidden" name="operation" value="editdata" />

                <div class="profile-name"><?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['youAdminName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</div>
                <div class="profile-field">
                    <input type="text" name="name" class="prof" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['Admin']['user']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" onclick="this.select();" />
                </div>
                <div class="profile-name"><?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['youAdminLogin'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</div>
                <div class="profile-field">
                    <input type="text" name="login" class="prof" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['Admin']['user']['login'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" onclick="this.select();" />
                </div>
                <div class="profile-button">
                    <input type="submit" class="buttonS bGreen" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['editAdminData'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
                </div>
            </form>
					</div>
		</div>

    <div id="pass">
        <div class="profile-block">

            <div class="profile-title"><?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['youCanEditYourPassword'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</div>
            <form method="post" action="">
                <input type="hidden" name="act" value="EditAdminUser" />
                <input type="hidden" name="operation" value="changepassword" />
                <div class="profile-name"><?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['youOldPassword'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</div>
                <div class="profile-field">
                    <input type="password" name="old" class="prof" />
                </div>
                <div class="profile-name"><?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['youNewPassword'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</div>
                <div class="profile-field">
                    <input type="password" name="new" class="prof" />
                </div>
                <div class="profile-button">
                    <input type="submit" class="buttonS bBlue" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['changeAdminPassword'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
                </div>
            </form>
        </div>
    </div>
</div>

<div class="divider"><span></span></div>