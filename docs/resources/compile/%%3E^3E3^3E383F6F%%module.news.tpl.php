<?php /* Smarty version 2.6.16, created on 2015-02-11 21:45:21
         compiled from modules/module.news.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'modules/module.news.tpl', 1, false),array('modifier', 'unescape', 'modules/module.news.tpl', 4, false),array('modifier', 'date_format', 'modules/module.news.tpl', 18, false),array('function', 'eval', 'modules/module.news.tpl', 4, false),)), $this); ?>
<?php if (((is_array($_tmp=$this->_tpl_vars['blocktype'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == 'curr'): ?>

    <div class="content-area">
        <?php echo smarty_function_eval(array('var' => ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['NewsArticle']['text'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp))), $this);?>

    </div>

<?php else: ?>

    <div class="news-page">
        <?php $_from = ((is_array($_tmp=$this->_tpl_vars['Items'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['newslist'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['newslist']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['curr']):
        $this->_foreach['newslist']['iteration']++;
?>
            <section class="news-section" >
                <div class="news-pict">
                    <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
                        <img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['logo'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
                    </a>
                </div>
                <div class="news-area">
                    <div class="block-date"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['curr']['publication_date'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</div>
                    <div class="block-title"><?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</div>
                    <div class="block-description">
                        <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['curr']['description'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp)); ?>

                        <a class="block-more" href="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['front']['more'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>
                    </div>
                </div>
                <div class="clear"></div>
            </section>
        <?php endforeach; endif; unset($_from); ?>
    </div>

<?php endif; ?>