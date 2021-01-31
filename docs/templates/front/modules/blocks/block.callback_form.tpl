<div class="popup" id="callback-form">
    <div class="popup-header">
        <a href="#" class="close" onclick="return false;"></a>
        <h3>{$lang.front.CallBack}</h3>
    </div>
    <div class="popup-body">

        <form id="form-callback" method="post" action="{$BaseURL}send-form-callback{$Config.webPageFileType}" >
            <input type="hidden" name="task" value="callback" />

            <div class="form-error r-text"></div>
            <div class="popup-site-form">
                <div class="popup-site-left">
                    {$lang.front.yourName}<span>*</span>
                </div>
                <div class="popup-site-right">
                    <input type="text" class="req-field" name="name" />
                </div>
                <div class="clear"></div>
            </div>

            <div class="form-error r-text"></div>
            <div class="popup-site-form">
                <div class="popup-site-left">
                    {$lang.front.yourPhone}<span>*</span>
                </div>
                <div class="popup-site-right">
                    <input type="text" class="req-field" name="phone" />
                </div>
                <div class="clear"></div>
            </div>

            <div class="form-error r-text"></div>
            <div class="popup-site-form">
                <div class="popup-site-left">
                    {$lang.front.yourEmail}<span>*</span>
                </div>
                <div class="popup-site-right">
                    <input type="text" class="req-field" name="email" />
                </div>
                <div class="clear"></div>
            </div>

            <div class="form-error r-text"></div>
            <div class="popup-site-form">
                <div class="popup-site-left so-height">
                    {$lang.front.enterSecurityCode}<span>*</span>
                </div>
                <div class="popup-site-right">
                    <input type="text" class="req-field" name="secretcode" maxlength="{$Config.secureImageSymbols}" />
                </div>
                <div class="clear"></div>
            </div>

            <div class="popup-site-form">
                <div class="popup-site-left"></div>
                <div class="popup-site-right">
                    <img id="cptch" src="{validate_url url=$HOST url1='showcode' url2=$Config.webPageFileType url3='?sessid=' url4=$session}" width="{$Config.secureImageWidth}" height="{$Config.secureImageHeight}" border="0" align="absmiddle" />
                    <a href="#" class="cptch">{$lang.front.refreshCode}</a>
                </div>
                <div class="clear"></div>
            </div>

            <div class="popup-site-form">
                <div class="popup-site-left"></div>
                <div class="popup-site-right">
                    <span class="color-blue">{$lang.front.requiredFields}</span>
                </div>
                <div class="clear"></div>
            </div>

            <div class="popup-site-form">
                <div class="popup-site-left"></div>
                <div class="popup-site-right">
                    <div class="form-not-send">{$lang.contacts.youMustCompleteAllAllFields}</div>
                    <div class="order-form-button">
                        <a class="popup-button df-form-submit">
                            <span>{$lang.front.orderCallBack}</span>
                        </a>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </form>
    </div>
</div>