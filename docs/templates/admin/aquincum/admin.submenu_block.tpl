<div id="tab-container" class="tab-container">
	<ul class="iconsLine ic3 etabs">
		<li><a href="#general" title=""><span class="icos-fullscreen"></span></a></li>
		<li><a href="#info" title=""><span class="icos-user"></span></a></li>
        <li><a href="#pass" title=""><span class="icos-photos"></span></a></li>
	</ul>

	<div class="divider"><span></span></div>

	<div id="general">
		{if $AdminSubmenuTree && $AdminSubmenuTree|@count > 0}
			<ul class="subNav">
				{foreach from=$AdminSubmenuTree item="curr" key="key" name="submenu"}
					<li>
						<a {if $curr.children|@count > 0} href="#" title="" class="exp" {else}{if $curr.unic_link} href="{$curr.unic_link}{else} href="{$curr.link}{$curr.parent_admin_menu_id}{/if}" title="" {if $curr.subcurr eq 'curr'} class="this" {/if}{/if}>
							{*<span class="icos-dcalendar"></span>*}
							<img src="{$curr.logo}" width="12" />
							{$curr.title} {*{if $curr.children|@count > 0}<span class="dataNumRed">{$curr.children|@count}</span>{/if}*}
						</a>
						{if $curr.children|@count > 0}
							<ul>
								{foreach from=$curr.children item="subcurr" key="subkey" name="subsubmenu"}
									<li>
										<a href="{if $subcurr.unic_link}{$subcurr.unic_link}{else}{$subcurr.link}{$curr.parent_admin_menu_id}{/if}">{$subcurr.title}</a>
									</li>
								{/foreach}
							</ul>
						{/if}
					</li>
				{/foreach}
			</ul>
		{/if}
	</div>

	<div id="info">
		<div class="profile-block">
            <div class="profile-title">{$lang.admin.youDataAsAdmin}</div>
            <form method="post" action="">
                <input type="hidden" name="act" value="EditAdminUser" />
                <input type="hidden" name="operation" value="editdata" />

                <div class="profile-name">{$lang.admin.youAdminName}</div>
                <div class="profile-field">
                    <input type="text" name="name" class="prof" value="{$Admin.user.name}" onclick="this.select();" />
                </div>
                <div class="profile-name">{$lang.admin.youAdminLogin}</div>
                <div class="profile-field">
                    <input type="text" name="login" class="prof" value="{$Admin.user.login}" onclick="this.select();" />
                </div>
                <div class="profile-button">
                    <input type="submit" class="buttonS bGreen" value="{$lang.admin.editAdminData}" />
                </div>
            </form>
			{*
            <div class="profile-name">
				{$Admin.user.name} {$Admin.user.lastname}
			</div>
			<div class="profile-name">
				{$lang.admin.yourEmailAsLogin}
			</div>
			{$Admin.user.email}
		    <div class="profile-name">
				{$lang.admin.yourRefererLink}
			</div>
			{if $Admin.user.user_invite}
				<input type="text" value="{$HOST}{$Admin.user.language_code}/?{$Config.partOfInviteLink}={$Admin.user.user_invite}" onclick="this.select();" />
				<div class="profile-name">
					{$lang.admin.yourUnicInvite}
				</div>
				<input type="text" value="{$Admin.user.user_invite}" onclick="this.select();" />
			{else}
				<input type="text" value="{$HOST}{$Admin.user.language_code}/?{$Config.partOfReferralLink}={$Admin.user.refId}" onclick="this.select();" />
			{/if}
			{if $Admin.leader}
				<div class="profile-name">
					{$lang.admin.yourSupervisor}
				</div>
				{$Admin.leader.name} {$Admin.leader.lastname}<br />
	            {$Admin.leader.email}
            {/if}

            {if $Admin.inviter}
				<div class="profile-name">
					{$lang.admin.yourInviter}
				</div>
				{$Admin.inviter.name} {$Admin.inviter.lastname}<br />
	            {$Admin.inviter.email}
            {/if}
            *}
		</div>
	{*
		<div class="sidePad">
			<a href="#" title="" class="sideB bBlue">Add new session</a>
			<a href="#" title="" class="sideB bRed mt10">Add new session</a>
			<a href="#" title="" class="sideB bGreen mt10">Add new session</a>
			<a href="#" title="" class="sideB bGreyish mt10">Add new session</a>
			<a href="#" title="" class="sideB bBrown mt10">Add new session</a>
		</div>

		<div class="divider"><span></span></div>

		<div class="fluid sideWidget">
			<div class="grid6"><input type="submit" class="buttonS bRed" value="Cancel" /></div>
			<div class="grid6"><input type="submit" class="buttonS bGreen" value="Submit" /></div>
		</div>

		<div class="divider"><span></span></div>

		<div class="sideWidget">
			<div class="inlinedate"></div>
		</div>
      *}
	</div>

    <div id="pass">
        <div class="profile-block">

            <div class="profile-title">{$lang.admin.youCanEditYourPassword}</div>
            <form method="post" action="">
                <input type="hidden" name="act" value="EditAdminUser" />
                <input type="hidden" name="operation" value="changepassword" />
                <div class="profile-name">{$lang.admin.youOldPassword}</div>
                <div class="profile-field">
                    <input type="password" name="old" class="prof" />
                </div>
                <div class="profile-name">{$lang.admin.youNewPassword}</div>
                <div class="profile-field">
                    <input type="password" name="new" class="prof" />
                </div>
                <div class="profile-button">
                    <input type="submit" class="buttonS bBlue" value="{$lang.admin.changeAdminPassword}" />
                </div>
            </form>
        </div>
    </div>
</div>

<div class="divider"><span></span></div>