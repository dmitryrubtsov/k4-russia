{*{if $isTest}*}
	<br /><br />
	<div id="add-comment-form">
		<div id="add-comment-area">
			<div id="comment-header">{$lang.front.addComment}</div>
			<form method="post" action="{$smarty.server.REQUEST_URI}" name="comment-form" >
				<input type="hidden" name="act" value="send-comment" />
				<input class="bo_theme bo-general" type="text" name="theme" maxlength="80" value="{if $smarty.post.theme}{$smarty.post.theme}{/if}" placeholder="{$lang.front.messageTheme}"/>
				<input class="bo_name bo-general" type="text" name="name" maxlength="80" value="{if $smarty.post.name}{$smarty.post.name}{/if}" placeholder="{$lang.front.firstname} {$lang.front.lastname}"/>
				<textarea class="bo_text bo-general" name="message" placeholder="{$lang.front.messageText}">{if $smarty.post.message}{$smarty.post.message}{/if}</textarea>
				<div id="comment-button">
					<a class="send-form" onclick="document.forms['comment-form'].submit();">{$lang.contacts.submitButton}</a>
				</div>
			</form>
		</div>
	</div>
{*
{else}
	<br /><br />
	<a href="#" onclick="show_modal('#temp-service'); return false;">
		<img src="{$HOST}{$Config.MainImageFolder}tpl/comment_form.jpg" />
	</a>
{/if}
*}