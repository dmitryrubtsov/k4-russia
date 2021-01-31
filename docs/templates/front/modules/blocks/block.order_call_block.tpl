<div class="popup order-frm" id="order-call-block">
	<a href="#" class="close" onClick="return false;"></a>
	<h3>{$lang.front.orderCallBack}</h3>
	<div id="order-call-form">
		<form id="form-callback" method="post" action="{$BaseURL}order-call-back{$Config.webPageFileType}">
			<input type="hidden" name="task" value="order" />
			<div class="row">
				<div class="form-error"></div>
				<input class="pole input-form" type="text" name="name" title="{$lang.user.firstname}*" value="" />
			</div>
			<div class="row">
				<div class="form-error"></div>
				<input class="pole input-form" type="text" name="email" title="{$lang.user.email}*" value="" />
			</div>
			<div class="row">
				<div class="form-error"></div>
				<input class="pole input-form" type="text" name="phone" title="{$lang.user.phone}*" value="" />
			</div>
			<div class="row">
				<div class="form-error"></div>
				<textarea class="input-form" name="message" cols="" rows="" title="{$lang.contacts.messageQuestion}*" ></textarea>
			</div>
			<div class="row">
				<div class="form-error"></div>
				<input class="pole input-form" type="text" name="secretcode" title="{$lang.contacts.enterSecretCode}" value="" />
			</div>
			<div class="row">
				<img id="cptch" src="{validate_url url=$SITEPATH url1='showcode' url2=$Config.webPageFileType url3='?sessid=' url4=$session}" width="{$Config.secureImageWidth}" height="{$Config.secureImageHeight}" border="0" align="absmiddle" />&nbsp;
    			<a href="#" class="cptch" >{$lang.contacts.refreshSecretCode}</a>  
			</div>
			<div class="row">
				<span>{$lang.contacts.allFieldsAreRequired}</span>
			</div>
			<div class="row">
				<div class="form-not-send">{$lang.contacts.youMustCompleteAllFields}</div>
				<input class="button-form blue df-form-submit" type="button" title="{$lang.front.order}" value="{$lang.front.order}" />
			</div>
		</form>
	</div>
</div>