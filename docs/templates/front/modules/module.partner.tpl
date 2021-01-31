{explode delim=$Config.imSizeDelimiter str=$Config.partnerReviewImageSize assign='partnerReviewImage'}

<h1>{$lang.front.ourFriendsAndPartners}</h1>
<div id="partner-logo-area">
	{foreach from=$PartnersArray item=curr key=key name="partners"}
		<a href="{$curr.link}" target="_blank">
			<img src="images/tpl/blank.gif" width="{$partnerReviewImage[0]}" height="{$partnerReviewImage[1]}" title="{$curr.title}" border="0" style="background: url('{$curr.logo}') 50% 50% no-repeat" />
		</a>
	{/foreach}
</div>