<?php /* Smarty version 2.6.16, created on 2014-03-25 18:17:47
         compiled from modules/blocks/block.site_main_menu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'modules/blocks/block.site_main_menu.tpl', 3, false),)), $this); ?>
<nav>
    <ul id="nav">
        <?php $_from = ((is_array($_tmp=$this->_tpl_vars['siteMainMenu'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['mainMenu'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['mainMenu']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['menuItem']):
        $this->_foreach['mainMenu']['iteration']++;
?>
            <?php $this->assign('item', ((is_array($_tmp=$this->_tpl_vars['menuItem']->getItem())) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))); ?>
            <li>
                <a class="hsubs current_page m" href="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['item']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>
                <?php if (((is_array($_tmp=$this->_tpl_vars['menuItem']->hasChildNodes())) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
                    <ul class="subs">
                        <?php $_from = ((is_array($_tmp=$this->_tpl_vars['menuItem']->getSortedChildNodes('position'))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['subMenuItem']):
?>
                            <?php $this->assign('submenu', ((is_array($_tmp=$this->_tpl_vars['subMenuItem']->getItem())) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))); ?>
                            <li><a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['submenu']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['submenu']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a></li>
                        <?php endforeach; endif; unset($_from); ?>
                    </ul>
                <?php endif; ?>
                <?php if (((is_array($_tmp=$this->_tpl_vars['item']['menu_id'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == 12): ?>
                    <ul class="subs">
                        <?php $_from = ((is_array($_tmp=$this->_tpl_vars['productsArray'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
                            <li><a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['BaseURL'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
product<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['linkPartSeparator'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['product']['linkname'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['Config']['AdminLinkNameDelim'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['product']['product_id'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['product']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a></li>
                        <?php endforeach; endif; unset($_from); ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; endif; unset($_from); ?>
    </ul>
</nav>