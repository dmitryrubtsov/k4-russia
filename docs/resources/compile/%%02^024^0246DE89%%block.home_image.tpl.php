<?php /* Smarty version 2.6.16, created on 2014-03-25 18:21:42
         compiled from modules/blocks/block.home_image.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'modules/blocks/block.home_image.tpl', 1, false),)), $this); ?>
<?php $_from = ((is_array($_tmp=$this->_tpl_vars['LandingSteps'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['steps'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['steps']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['curr']):
        $this->_foreach['steps']['iteration']++;
?>
   <div class="main-img">
          <?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['text'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

    </div>
<?php endforeach; endif; unset($_from); ?>