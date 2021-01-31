<?php /* Smarty version 2.6.16, created on 2014-03-21 19:37:53
         compiled from admin.javascript_common.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'admin.javascript_common.tpl', 2, false),)), $this); ?>

<script type="text/javascript" src="<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['FCKEditorPath'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
ckeditor.js"></script>
<script type="text/javascript" src="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['Config']['pathToAdmin'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
/index.php?mode=ckeditor_templates_js"></script>