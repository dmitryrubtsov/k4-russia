<?php /* Smarty version 2.6.16, created on 2014-04-04 13:45:32
         compiled from modules/module.projects.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'modules/module.projects.tpl', 1, false),array('modifier', 'unescape', 'modules/module.projects.tpl', 26, false),array('modifier', 'cat', 'modules/module.projects.tpl', 73, false),)), $this); ?>
<?php if (((is_array($_tmp=$this->_tpl_vars['blocktype'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == 'curr'): ?>
<div class="content">
    <div class="head">
        <h1><?php echo ((is_array($_tmp=$this->_tpl_vars['ProjGroup']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</h1>
        <a class="archive" href="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
articles--arhiv-proektov-35.html">архив проектов</a>
    </div>
    <div class="content-body">
        <div class="proj-list">
            <div class="head">
                <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['ProjGroup']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
                    <img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['ProjGroup']['orig_path'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" alt="" title="" />
                </a>
            </div>

        <?php $_from = ((is_array($_tmp=$this->_tpl_vars['ListItems'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['curr']):
        $this->_foreach['list']['iteration']++;
?>
            <div class="item">
                <div class="item-head">
                    <p><span><?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</span></p>
                    <p><?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['sub_description'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</p>
                </div>
                <div class="item-prev">
                    <?php if (((is_array($_tmp=$this->_tpl_vars['curr']['orig_path'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
                        <img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['orig_path'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
                    <?php endif; ?>
                    <div class="pr-text">
                            <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['curr']['description'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp)); ?>

                    </div>
                </div>
            </div>
        <?php endforeach; endif; unset($_from); ?>
        </div>
    </div>
</div>

<?php else: ?>

<div class="content">
    <div class="head">
        <h1>Проекты</h1>
        <a class="archive" href="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
articles--arhiv-proektov-35.html">архив проектов</a>
    </div>
    <div class="content-body">
        <div class="proj-list">
            <?php $_from = ((is_array($_tmp=$this->_tpl_vars['Items'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['projectlist'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['projectlist']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['curr']):
        $this->_foreach['projectlist']['iteration']++;
?>
                <div class="head">
                    <?php if (((is_array($_tmp=$this->_tpl_vars['curr']['logo'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
                        <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
                            <img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['logo'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
                        </a>
                    <?php endif; ?>
                </div>
                <?php if (((is_array($_tmp=$this->_tpl_vars['curr']['ListItems'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
                <?php $_from = ((is_array($_tmp=$this->_tpl_vars['curr']['ListItems'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['subKey'] => $this->_tpl_vars['subCurr']):
        $this->_foreach['list']['iteration']++;
?>
                    <div class="item">
                        <div class="item-head">
                            <p><span><?php echo ((is_array($_tmp=$this->_tpl_vars['subCurr']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</span></p>
                            <p><?php echo ((is_array($_tmp=$this->_tpl_vars['subCurr']['sub_description'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</p>
                        </div>
                        <div class="item-prev">
                            <?php if (((is_array($_tmp=$this->_tpl_vars['subCurr']['orig_path'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
                                <img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['subCurr']['orig_path'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
                            <?php endif; ?>
                            <div class="pr-text">
                                <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['subCurr']['description'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp)); ?>

                            </div>
                        </div>
                    </div>
                <?php endforeach; endif; unset($_from); ?>
                <?php endif; ?>
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