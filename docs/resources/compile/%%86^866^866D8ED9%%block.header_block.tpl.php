<?php /* Smarty version 2.6.16, created on 2014-03-25 18:17:47
         compiled from modules/blocks/block.header_block.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'modules/blocks/block.header_block.tpl', 5, false),)), $this); ?>
<header id="header">
    <div class="head-content">
        <div class="head-table">
            <div class="head-column-text">
                <?php $_from = ((is_array($_tmp=$this->_tpl_vars['HeadText'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['advantage'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['advantage']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['curr']):
        $this->_foreach['advantage']['iteration']++;
?>
                        <p class="text">
                            <?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['text'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

                        </p>
                <?php endforeach; endif; unset($_from); ?>
            </div>
            <div class="head-column-contacts">
                <?php if (((is_array($_tmp=$this->_tpl_vars['Config']['headerPhone'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
                    <p class="phone"><span><?php if (((is_array($_tmp=$this->_tpl_vars['Config']['headerPhoneCode'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))):  echo ((is_array($_tmp=$this->_tpl_vars['Config']['headerPhoneCode'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  endif; ?></span><?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['headerPhone'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</p>
                <?php endif; ?>
                <?php if (((is_array($_tmp=$this->_tpl_vars['Config']['adress'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
                    <p class="where"><a href="#"><?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['adress'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a></p>
                <?php endif; ?>
            </div>
        </div>
        <nav id="top-nav">
            <ul>
                <li class="active"><a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
articles--o-kompanii-15.html">о компании</a></li>
                <li><a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
articles--uslugi-16.html">услуги</a></li>
                <li><a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
projects.html">наши проекты</a></li>
                <li><a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
articles--informacija-sro-18.html">информация сро</a></li>
                <li><a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
contacts.html">контакты</a></li>
                <div class="clearfix"></div>
            </ul>
        </nav>
    </div>
    <div class="logo">
        <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"></a>
    </div>
</header>