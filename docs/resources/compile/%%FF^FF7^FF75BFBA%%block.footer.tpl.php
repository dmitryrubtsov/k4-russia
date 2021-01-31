<?php /* Smarty version 2.6.16, created on 2014-03-25 18:17:47
         compiled from modules/blocks/block.footer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'modules/blocks/block.footer.tpl', 3, false),)), $this); ?>
<div class="footer-left">
    <p>
        <?php if (((is_array($_tmp=$this->_tpl_vars['Config']['copyright'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
            <span>Copyright&#169;<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['copyright'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</span>
            <span>|</span>
        <?php endif; ?>
        <span><?php if (((is_array($_tmp=$this->_tpl_vars['Config']['companyType'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))):  echo ((is_array($_tmp=$this->_tpl_vars['Config']['companyType'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  endif; ?> &laquo;<?php if (((is_array($_tmp=$this->_tpl_vars['Config']['companyName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))):  echo ((is_array($_tmp=$this->_tpl_vars['Config']['companyName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  endif; ?>&raquo;</span>
        <span>|</span>
        <span>Все права защищены.</span>
    </p>
</div>
<div class="footer-right">
    <?php if (((is_array($_tmp=$this->_tpl_vars['Config']['contactsEmail'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
        <a href="mailto:mos@k4-russia.ru"><?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['contactsEmail'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>
    <?php endif; ?>

</div>
<div class="clearfix"></div>