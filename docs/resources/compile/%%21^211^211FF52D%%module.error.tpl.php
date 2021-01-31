<?php /* Smarty version 2.6.16, created on 2014-04-10 07:55:37
         compiled from modules/module.error.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'modules/module.error.tpl', 18, false),array('modifier', 'unescape', 'modules/module.error.tpl', 21, false),)), $this); ?>

<div class="head">
    <h1><?php echo ((is_array($_tmp=$this->_tpl_vars['page404Title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</h1>
</div>
<div class="content-body">
     <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['page404'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp)); ?>

</div>