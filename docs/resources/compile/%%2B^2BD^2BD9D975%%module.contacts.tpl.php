<?php /* Smarty version 2.6.16, created on 2014-11-22 20:43:30
         compiled from modules/module.contacts.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'eval', 'modules/module.contacts.tpl', 2, false),array('function', 'math', 'modules/module.contacts.tpl', 29, false),array('modifier', 'escape', 'modules/module.contacts.tpl', 2, false),array('modifier', 'unescape', 'modules/module.contacts.tpl', 2, false),)), $this); ?>
<div class="head">
    <h1><?php echo smarty_function_eval(array('var' => ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['ContactArticle']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp))), $this);?>
</h1>
</div>
<div class="content-body">
    <?php echo smarty_function_eval(array('var' => ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['ContactArticle']['text'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp))), $this);?>

</div>


<p>Форма обратной связи:</p>
<br>
    <form method="post" action="" name="contacts">
        <input type="hidden" name="task" value="send">
        <table class="form">
            <tr>
                <td class="name"><?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['contacts']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
: </td>
                <td class="value"><input type="text" name="name" maxlength="80" value="<?php if (((is_array($_tmp=$this->_tpl_vars['User']['isLogin'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == '1' && ((is_array($_tmp=$this->_tpl_vars['POST']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == ''):  echo ((is_array($_tmp=$this->_tpl_vars['User']['info']['firstname'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['User']['info']['lastname'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  else:  echo ((is_array($_tmp=$this->_tpl_vars['POST']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  endif; ?>" /></td>
            </tr>
            <tr>
                <td class="name"><?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['contacts']['email'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
: </td>
                <td class="value"><input type="text" name="email" maxlength="80" value="<?php if (((is_array($_tmp=$this->_tpl_vars['User']['isLogin'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == '1' && ((is_array($_tmp=$this->_tpl_vars['POST']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == ''):  echo ((is_array($_tmp=$this->_tpl_vars['User']['info']['email'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  else:  echo ((is_array($_tmp=$this->_tpl_vars['POST']['email'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  endif; ?>" /></td>
            </tr>
            <tr>
                <td class="name"><?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['contacts']['message'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
: </td>
                <td class="value"><textarea name="message" rows="7" cols="45"><?php echo ((is_array($_tmp=$this->_tpl_vars['POST']['message'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</textarea></td>
            </tr>
            <tr>
                <td class="name"></td>
                <td class="value">
                    <img id="cptch" src="<?php echo ((is_array($_tmp=$this->_tpl_vars['BaseURL'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
showcode<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['webPageFileType'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
?q=<?php echo smarty_function_math(array('equation' => 'rand(1,99999)'), $this);?>
" width="<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['secureImageWidth'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" height="<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['secureImageHeight'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" border="0" align="absmiddle" />&nbsp;
                    <a href="#" onclick="$('#cptch').attr('src', function(){return $(this).attr('src')+'&'+Math.random(999);});return false;"><img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
img/up2.jpg" border="0" height="15" width="16" align="absmiddle" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['front']['reloadCaptchaImage'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['front']['reloadCaptchaImage'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" onclick="this.blur();" /></a>
                </td>
            </tr>
            <tr>
                <td class="name"><?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['contacts']['enterSecretCode'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
:</td>
                <td class="value">
                    <input class="code" type="text" name="code" maxlenght="<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['secureImageSymbols'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
                </td>
            </tr>
        </table>

</form>
<br />
<input type="submit" class="tg12" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['contacts']['submitButton'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" onclick="document.forms['contacts'].submit();" />