<div id="site-message-form" class="site-form">
	<div id="site-message-form-area">
		<div id="site-message-form-close" class="close-site-form"></div>
		<div id="site-message-form-block">
			<div class="article-row">{$articles.72.body|unescape}</div>
			<form method="post" action="{$BaseURL}send-form-message{$Config.webPageFileType}">
				<input type="hidden" name="task" value="message" />
				<div class="form-row">
					<div class="form-title">{$lang.front.yourName}</div>
					<div class="form-error"></div>
					<div class="form-field"><input type="text" class="req-field" name="name" value="" maxength="100" /></div>
				</div>
				<div class="form-row">
					<div class="form-title">{$lang.front.yourEmail}</div>
					<div class="form-error"></div>
					<div class="form-field"><input type="text" class="req-field" name="email" value="" maxength="40" /></div>
				</div>
				<div class="form-row">
					<div class="form-title">{$lang.front.yourMessageOrQuestion}</div>
					<div class="form-error"></div>
					<div class="form-field"><textarea name="message" class="req-field"></textarea></div>
				</div>
				<div class="site-button-area">
					<div class="form-not-send">{$lang.contacts.youMustCompleteAllAllFields}</div>
					<a class="site-button df-form-submit" >{$lang.contacts.submitButton}</a>
				</div>
			</form>
			<div class="article-row">{$articles.73.body|unescape}</div>
		</div>
	</div>
</div>