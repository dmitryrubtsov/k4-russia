{include file="admin.header.tpl"}
{*
<div>New Design New</div>
<center>
	<table>
		<tr>
			<td>
				{$lang.admin.wellcomeToAdminPanel}
				<br /><br />
				{$lang.admin.pleaseLogin}
				{if $ErrorMsg}
					<div class="error">{$ErrorMsg}</div>
				{/if}
				<form method="post" action="">
					<input type="hidden" name="tryLogin" value="1" />
					<table class="logintab">
						<tr>
							<td>{$lang.admin.login}:</td>
							<td><input type="text" name="login" /></td>
						</tr>
						<tr>
							<td>{$lang.admin.password}:</td>
							<td><input type="password" name="password" /></td>
						</tr>
						<tr>
							<td colspan="2" class="submit"><input class="button" type="submit" value="{$lang.admin.loginButton}" /></td>
						</tr>
					</table>
				</form>
			</td>
		</tr>
	</table>
</center>
*}
<!-- Top line begins -->
<div id="top">
	<div class="wrapper-top-line">
    	<a title="" class="logo"><img src="../../../images/admin/aquincum/background/logo.jpg" alt="" /></a>

        <!-- Right top nav -->
        <div class="topNav">
            <ul class="userNav">
                <li><a href="#" title="" class="screen"></a></li>
                <li><a href="#" title="" class="settings"></a></li>
                <li><a href="#" title="" class="logout"></a></li>
            </ul>
        </div>
    </div>
</div>
<!-- Top line ends -->


<!-- Login wrapper begins -->
<div class="loginWrapper">

	<!-- Current user form -->
    <form method="post" action="">
    	<input type="hidden" name="tryLogin" value="1" />
        <div class="loginPic">
            <a href="#" title=""><img src="images/userLogin.png" alt="" /></a>
            <span>Viktoria</span>
            <div class="loginActions">
                <div><a href="#" title="Change user" class="logleft flip"></a></div>
                <div><a href="#" title="Forgot password?" class="logright"></a></div>
            </div>
        </div>

        <input type="text" name="login" placeholder="Confirm your email" class="loginEmail" />
        <input type="password" name="password" placeholder="Password" class="loginPassword" />

        <div class="logControl">
            <div class="memory"><input type="checkbox" checked="checked" class="check" id="remember1" /><label for="remember1">Remember me</label></div>
            <input type="submit" name="submit" value="Login" class="buttonM bBlue" />
        </div>
    </form>

    {*<!-- New user form -->
    <form action="index.html" id="recover">
        <div class="loginPic">
            <a href="#" title=""><img src="images/userLogin2.png" alt="" /></a>
            <div class="loginActions">
                <div><a href="#" title="" class="logback flip"></a></div>
                <div><a href="#" title="Forgot password?" class="logright"></a></div>
            </div>
        </div>

        <input type="text" name="login" placeholder="Your username" class="loginUsername" />
        <input type="password" name="password" placeholder="Password" class="loginPassword" />

        <div class="logControl">
            <div class="memory"><input type="checkbox" checked="checked" class="check" id="remember2" /><label for="remember2">Remember me</label></div>
            <input type="submit" name="submit" value="Login" class="buttonM bBlue" />
        </div>
    </form>*}

</div>
<!-- Login wrapper ends -->
{include file="admin.footer.tpl"}
