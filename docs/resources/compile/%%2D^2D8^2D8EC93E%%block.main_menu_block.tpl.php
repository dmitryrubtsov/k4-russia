<?php /* Smarty version 2.6.16, created on 2014-03-25 18:17:47
         compiled from modules/blocks/block.main_menu_block.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'modules/blocks/block.main_menu_block.tpl', 3, false),array('modifier', 'cat', 'modules/blocks/block.main_menu_block.tpl', 5, false),)), $this); ?>
<nav id="top-nav">
    <ul>
        <?php $_from = ((is_array($_tmp=$this->_tpl_vars['siteMainMenu'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['main'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['main']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['menuItem']):
        $this->_foreach['main']['iteration']++;
?>
            <?php $this->assign('item', ((is_array($_tmp=$this->_tpl_vars['menuItem']->getItem())) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))); ?>
            <li <?php if (((is_array($_tmp=$this->_tpl_vars['item']['curr'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == 'y' || ((is_array($_tmp=$this->_tpl_vars['item']['outerlink'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['action'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('cat', true, $_tmp, ((is_array($_tmp=$this->_tpl_vars['Config']['webPageFileType'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))) : smarty_modifier_cat($_tmp, ((is_array($_tmp=$this->_tpl_vars['Config']['webPageFileType'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))))): ?> class="active"<?php endif; ?> ><a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['item']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a></li>
        <?php endforeach; endif; unset($_from); ?>
        <div class="clearfix"></div>
    </ul>
</nav>

