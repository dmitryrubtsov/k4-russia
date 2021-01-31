<div class="loginWrapper">
	<!-- Current user form -->
    <form method="post" action="" id="login">
    	<input type="hidden" name="tryLogin" value="1" />
        <div class="loginPic">
            <a href="#" title=""><img src="{$HOST}{$Config.MainImageFolder}admin/aquincum/userLogin2.png" alt="" /></a>
            <span>{$lang.admin.site}</span>
            <div class="loginActions">
                <div><a title="Change user" class="logleft flip"></a></div>
                <div><a title="Forgot password?" class="logright"></a></div>
            </div>
        </div>

        <input type="text" name="login" placeholder="Confirm your email" class="loginUsername" />
        <input type="password" name="password" placeholder="Password" class="loginPassword" />

        <div class="logControl">
            {*<div class="memory"><input type="checkbox" checked="checked" class="check" id="remember1" /><label for="remember1">Remember me</label></div>*}
            <input type="submit" name="submit" value="Login" class="buttonM bBlue" />
        </div>
    </form>

    <!-- New user form -->
    <form method="post" action="" id="recover">
    	<input type="hidden" name="tryLogin" value="1" />
        <div class="loginPic">
            <a href="#" title=""><img src="{$HOST}{$Config.MainImageFolder}admin/aquincum/userLogin2.png" alt="" /></a>
            <div class="loginActions">
                <div><a title="" class="logback flip"></a></div>
                <div><a title="Forgot password?" class="logright"></a></div>
            </div>
        </div>

        <input type="text" name="login" placeholder="Your username" class="loginUsername" />
        <input type="password" name="password" placeholder="Password" class="loginPassword" />

        <div class="logControl">
            {*<div class="memory"><input type="checkbox" checked="checked" class="check" id="remember2" /><label for="remember2">Remember me</label></div>*}
            <input type="submit" name="submit" value="Login" class="buttonM bBlue" />
        </div>
    </form>

</div>