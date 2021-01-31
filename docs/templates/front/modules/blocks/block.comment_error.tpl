<div class="popup" id="comment-error">
	<a href="#" class="close" onclick="return false;"></a>
	<div class="popup-area">
		{if $commentSuccess}
			{if $askQuestion}
				<h3>{$lang.site.questionWasAskSuccess}</h3>
				<div id="comment-add">{$lang.site.questionWasAskSuccessText}</div>
			{else}
				<h3>{$lang.site.commentWasAddSuccess}</h3>
				<div id="comment-add">{$lang.site.commentWasAddSuccessText}</div>
			{/if}
		{else}
			{if $askQuestion}
				<h3>{$lang.site.questionWasNotAsk}</h3>
			{else}
				<h3>{$lang.site.commentWasNotAdd}</h3>
			{/if}
			<div id="comment-error-list">
				<ul>
					{foreach from=$errorTitle item=curr key=key name="errorTitle"}
						<li>
							{$curr}
						</li>
					{/foreach}
				</ul>
			</div>
		{/if}
	</div>
</div>