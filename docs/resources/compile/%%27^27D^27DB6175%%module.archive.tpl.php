<?php /* Smarty version 2.6.16, created on 2014-03-25 18:17:47
         compiled from modules/module.archive.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'modules/module.archive.tpl', 1, false),array('modifier', 'unescape', 'modules/module.archive.tpl', 3, false),array('modifier', 'cat', 'modules/module.archive.tpl', 33, false),array('function', 'eval', 'modules/module.archive.tpl', 3, false),)), $this); ?>
<?php if (((is_array($_tmp=$this->_tpl_vars['blocktype'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == 'curr'): ?>
    <div class="head">
        <h1><?php echo smarty_function_eval(array('var' => ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Archive']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp))), $this);?>
</h1>
    </div>
    <div class="content-body">
        <?php echo smarty_function_eval(array('var' => ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Archive']['text'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp))), $this);?>

    </div>
<?php else: ?>
    <div class="content">
        <div class="head">
            <h1>Архив проектов</h1>
        </div>
        <div class="content-body">
            <div class="proj-list">
                    <?php $_from = ((is_array($_tmp=$this->_tpl_vars['Items'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['curr']):
        $this->_foreach['list']['iteration']++;
?>
                        <div class="item">
                            <div class="item-head">
                                <p><a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a></p>
                                <p><?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['sub_description'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</p>
                            </div>
                            <div class="item-prev">
                                <?php if (((is_array($_tmp=$this->_tpl_vars['curr']['orig_path'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
                                    <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"><img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['orig_path'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"></a>
                                <?php endif; ?>
                                <p><a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
                                        <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['curr']['description'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp)); ?>

                                    </a></p>
                            </div>
                        </div>
                <?php endforeach; endif; unset($_from); ?>
            </div>
            <?php if (((is_array($_tmp=$this->_tpl_vars['isPaging'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == 'yes'): ?>
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Config']['ModulesFolder'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('cat', true, $_tmp, ((is_array($_tmp=$this->_tpl_vars['Config']['BlocksFolder'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))) : smarty_modifier_cat($_tmp, ((is_array($_tmp=$this->_tpl_vars['Config']['BlocksFolder'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))))) ? $this->_run_mod_handler('cat', true, $_tmp, "block.paging.tpl") : smarty_modifier_cat($_tmp, "block.paging.tpl")), 'smarty_include_vars' => array('Paging' => ((is_array($_tmp=$this->_tpl_vars['Paging'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')),'Link' => ((is_array($_tmp=$this->_tpl_vars['Paging']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>