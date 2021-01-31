<?php /* Smarty version 2.6.16, created on 2014-03-21 19:37:37
         compiled from admin.login_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'admin.login_form.tpl', 27, false),)), $this); ?>
<div class="loginWrapper" style="min-width:250px;">
	<!-- Current user form -->
    <form method="post" action="" id="login">
    	<input type="hidden" name="tryLogin" value="1" />
        <div class="loginPic">
			                        <div class="loginActions">
                <div><a title="Change user" class="logleft flip"></a></div>
                <div><a title="Forgot password?" class="logright"></a></div>
            </div>
        </div>

        <input type="text" name="login" placeholder="Confirm your email" class="loginUsername" />
        <input type="password" name="password" placeholder="Password" class="loginPassword" />

        <div class="logControl">
                        <input type="submit" name="submit" value="Login" class="buttonM bBlue" />
        </div>
    </form>

    <!-- New user form -->
    <form method="post" action="" id="recover">
    	<input type="hidden" name="tryLogin" value="1" />
        <div class="loginPic">
            <a href="#" title=""><img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['Config']['MainImageFolder'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
admin/aquincum/userLogin2.png" alt="" /></a>
            <div class="loginActions">
                <div><a title="" class="logback flip"></a></div>
                <div><a title="Forgot password?" class="logright"></a></div>
            </div>
        </div>

        <input type="text" name="login" placeholder="Your username" class="loginUsername" />
        <input type="password" name="password" placeholder="Password" class="loginPassword" />

        <div class="logControl">
                        <input type="submit" name="submit" value="Login" class="buttonM bBlue" />
        </div>
    </form>

</div>