<?php /* Smarty version 2.6.16, created on 2014-03-25 18:17:47
         compiled from modules/blocks/block.wrapper_left_column.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'modules/blocks/block.wrapper_left_column.tpl', 1, false),)), $this); ?>
<div class="wrapper <?php echo ((is_array($_tmp=$this->_tpl_vars['Block']['code_block'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
    <?php if (((is_array($_tmp=$this->_tpl_vars['Block']['show_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?><div class="block-title"><?php echo ((is_array($_tmp=$this->_tpl_vars['Block']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</div><?php endif; ?>
    <?php echo ((is_array($_tmp=$this->_tpl_vars['blockContent'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

</div>