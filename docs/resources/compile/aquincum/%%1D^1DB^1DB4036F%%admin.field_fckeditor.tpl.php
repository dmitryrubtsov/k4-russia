<?php /* Smarty version 2.6.16, created on 2014-03-21 19:38:03
         compiled from admin.field_fckeditor.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'admin.field_fckeditor.tpl', 2, false),array('modifier', 'unescape', 'admin.field_fckeditor.tpl', 27, false),)), $this); ?>
<script language="javascript">
	function <?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
LoadEditor(flag)
	{
		CKEDITOR.replace( '<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
',
		{
			language : "<?php echo ((is_array($_tmp=@__LANG)) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
",


			filebrowserWindowHeight:'540',
			filebrowserBrowseUrl: '<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['FileManagerPath'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
?__rBd_=/&_rBd_=<?php echo ((is_array($_tmp=@__CFG_SESSION_HANDLE)) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
&_r8b__=wcrfw3&_r8b_=&_r8d_=<?php echo ((is_array($_tmp=$this->_tpl_vars['SID'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
&_rBb__=none',
			filebrowserImageBrowseUrl: '<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['FileManagerPath'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
?__rBd_=/&_rBd_=<?php echo ((is_array($_tmp=@__CFG_SESSION_HANDLE)) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
&_r8b__=wcrfw3&_r8b_=image&_r8d_=<?php echo ((is_array($_tmp=$this->_tpl_vars['SID'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
&_rBb__=none',
			filebrowserFlashBrowseUrl: '<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['FileManagerPath'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
?__rBd_=/&_rBd_=<?php echo ((is_array($_tmp=@__CFG_SESSION_HANDLE)) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
&_r8b__=wcrfw3&_r8b_=flash&_r8d_=<?php echo ((is_array($_tmp=$this->_tpl_vars['SID'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
&_rBb__=none'
		});
		if(flag)
		{
			document.getElementById('<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
LoadEditor').innerHTML='';
		}
	}
</script>
<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['buttonReplace'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == 'y'): ?>
	<div id="<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
LoadEditor">
		<input type="button" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['loadEditor'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" onclick="<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
LoadEditor(true);return false;" />
	</div>
<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin.field_textarea.tpl", 'smarty_include_vars' => array('Field' => ((is_array($_tmp=$this->_tpl_vars['Field'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['textAfterField'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
	&nbsp;<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Field']['textAfterField'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp)); ?>

<?php endif; ?>
<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['textUnderField'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
	<br /><sup><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Field']['textUnderField'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp)); ?>
</sup>
<?php endif; ?>

<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['buttonReplace'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != 'y'): ?>
	<script language="javascript">
		<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
LoadEditor(false);
	</script>
<?php endif; ?>