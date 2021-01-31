<?php /* Smarty version 2.6.16, created on 2014-03-21 19:37:53
         compiled from admin.body_listing.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'admin.body_listing.tpl', 1, false),array('modifier', 'count', 'admin.body_listing.tpl', 8, false),array('modifier', 'unescape', 'admin.body_listing.tpl', 15, false),array('modifier', 'cat', 'admin.body_listing.tpl', 50, false),array('function', 'gen_listingtab_head', 'admin.body_listing.tpl', 14, false),array('function', 'eval', 'admin.body_listing.tpl', 15, false),array('function', 'counter', 'admin.body_listing.tpl', 21, false),array('function', 'gen_listingtab_row', 'admin.body_listing.tpl', 26, false),array('function', 'template_exists', 'admin.body_listing.tpl', 50, false),)), $this); ?>
<?php if (((is_array($_tmp=$this->_tpl_vars['FLAGS']['NoReadDB'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == ((is_array($_tmp=$this->_tpl_vars['FALSE'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
	<div class="widget check grid6">
		<div class="whead">
						<h6><?php echo ((is_array($_tmp=$this->_tpl_vars['PageTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</h6>
		</div>
		<div class="wtable">
		<?php if (count(((is_array($_tmp=$this->_tpl_vars['Items'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))): ?>
			<form method="post" action="" name="<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['mainFormName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
				<table cellpadding="0" cellspacing="0" class="tDefault checkAll tMedia" id="checkAll">
					<thead>
						<tr>
							<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin.listingtab_head_begin.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
							<?php echo smarty_function_gen_listingtab_head(array('ConfFields' => ((is_array($_tmp=$this->_tpl_vars['ConfFields'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')),'assign' => 'fheadstr','Config' => ((is_array($_tmp=$this->_tpl_vars['Config'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))), $this);?>

							<?php echo smarty_function_eval(array('var' => ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fheadstr'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp))), $this);?>

						</tr>
					</thead>
					<tbody>

						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin.mainform_hidinputs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php echo smarty_function_counter(array('start' => ((is_array($_tmp=$this->_tpl_vars['listInfo']['countSt'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')),'skip' => 1,'print' => false,'assign' => 'nomer'), $this);?>

						<?php $_from = ((is_array($_tmp=$this->_tpl_vars['Items'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['curr']):
?>
							<tr id="listingrt<?php echo ((is_array($_tmp=$this->_tpl_vars['curr'][$this->_tpl_vars['WorkTableKeyFieldName']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
								<?php echo smarty_function_counter(array(), $this);?>

								<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin.listingtab_row_begin.tpl", 'smarty_include_vars' => array('nomer' => ((is_array($_tmp=$this->_tpl_vars['nomer'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')),'Mode' => ((is_array($_tmp=$this->_tpl_vars['AloneMode'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
								<?php echo smarty_function_gen_listingtab_row(array('ConfFields' => ((is_array($_tmp=$this->_tpl_vars['ConfFields'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')),'assign' => 'fitemstr','Config' => ((is_array($_tmp=$this->_tpl_vars['Config'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')),'Item' => ((is_array($_tmp=$this->_tpl_vars['curr'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))), $this);?>

								<?php echo smarty_function_eval(array('var' => ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fitemstr'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp))), $this);?>

							</tr>
						<?php endforeach; endif; unset($_from); ?>

					</tbody>
				</table>
			</form>
		<?php else: ?>
			<div class="empty-page-tooltip"><?php echo ((is_array($_tmp=$this->_tpl_vars['emptyPageTooltip'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</div>
		<?php endif; ?>
		</div>
		<?php if (count(((is_array($_tmp=$this->_tpl_vars['Items'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))): ?>
			<div class="navigation">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin.paging.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</div>
		<?php endif; ?>
	</div>

		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin.buttons_sad.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	</div>
	<?php if (((is_array($_tmp=$this->_tpl_vars['NoUse']['AddButton'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == ''): ?>
		<div id="addnewitem" style="display:none;">
			<?php echo smarty_function_template_exists(array('file' => ((is_array($_tmp=((is_array($_tmp="admin.")) ? $this->_run_mod_handler('cat', true, $_tmp, ((is_array($_tmp=$this->_tpl_vars['GlobPart'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))) : smarty_modifier_cat($_tmp, ((is_array($_tmp=$this->_tpl_vars['GlobPart'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))))) ? $this->_run_mod_handler('cat', true, $_tmp, ".tpl") : smarty_modifier_cat($_tmp, ".tpl")),'alternative' => "admin.item.tpl",'assign' => 'filename'), $this);?>

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=$this->_tpl_vars['filename'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')), 'smarty_include_vars' => array('BodyTemplate' => "admin.body_item.tpl")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	<?php endif; ?>

	<?php if (((is_array($_tmp=$this->_tpl_vars['showAddNewForm'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != '' || ((is_array($_tmp=$this->_tpl_vars['onlyAddItem'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
		<script language="javascript">
			showAddNewForm();
		</script>
	<?php endif; ?>
<?php endif; ?>