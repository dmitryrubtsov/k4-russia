<div id="comment-block">
	<h2>{$lang.front.commentsTitle}</h2>
	<div id="comment-area">
		{foreach from=$CommentArray item=curr key=key name="comment"}
			<div class="comment-each">
				<div class="date">{$curr.date_public|date_format:"%e.%m.%Y"}</div>
				<div class="subject">{$curr.subject}</div>
				<div class="text">{$curr.text}</div>
			</div>
		{/foreach}
	</div>
</div>
<div id="comment-arrow-block">
	<div id="comment-arrow"></div>
</div>