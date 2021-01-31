<div id="site-contacts-form" class="site-form">
    <div id="site-contacts-form-area">
        <div id="site-callback-form-close" class="close-site-form"></div>
        <div id="site-callback-form-block">
            <h2 class="site-title">{$lang.front.feedbackForm}</h2>
        </div>
        <form method="post" action="{$BaseURL}send-form-contacts{$Config.webPageFileType}">
            <input type="hidden" name="task" value="contacts" />
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
                <div class="form-title">{$lang.front.yourPhone}</div>
                <div class="form-error"></div>
                <div class="form-field"><input type="text" class="req-field" name="phone" value="" maxength="40" /></div>
            </div>
            <div class="form-row">
                <div class="form-title">{$lang.front.yourMessage}</div>
                <div class="form-error"></div>
                <div class="form-field"><textarea name="message" class="req-field"></textarea></div>
            </div>
            <div class="site-button-area">
                <div class="form-not-send">{$lang.contacts.youMustCompleteAllAllFields}</div>
                <a class="site-button df-form-submit" >{$lang.front.submitButton}</a>
            </div>
        </form>
    </div>
</div>