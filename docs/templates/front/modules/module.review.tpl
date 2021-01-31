<h1>{$lang.front.reviews}</h1>
<div class="filter-block">
	<div class="title">{$lang.site.filterSelection}</div>
	<div class="area">
		<form method="get" action="" name="branches">
			<div class="select-area">
				<span>{$lang.site.learningBranch}</span><br />
				<select name="branch">
						<option value="all">{$lang.site.allBranches}</option>
					{foreach from=$BranchesArray item=curr key=key name="branches"}
						<option value="{$curr.branch_id}" {if $smarty.get.branch eq $curr.branch_id} selected {/if}>{$curr.title}&nbsp;&nbsp;</option>
					{/foreach}
				</select>
			</div>
			<div class="button-area">
				<a href="#" class="site-button" onclick="document.forms['branches'].submit(); return false;">{$lang.site.chooseBranch}</a>
			</div>
			<div class="clear"></div>
		</form>
	</div>
</div>
{foreach from=$Items item=curr key=key name="reviews"}
	<div class="bg-review">
		<span class="name">{$curr.name}</span> | <span class="email"><a href="mailto:{$curr.email}">{$curr.email}</a></span>
		<div class="review">
			{$curr.text}
		</div>
	</div>
{/foreach}

{if $Paging.pages|@count > 1}
	{include file=$Config.ModulesFolder|cat:$Config.BlocksFolder|cat:"block.paging.tpl" Paging=$Paging Link=$Paging.link}
{/if}

<br /><br /><br /><br />
<div class="form-block">
	<h2>{$lang.front.leaveReview}</h2>
	<form id="form-review" method="post" action="{$BaseURL}send-form-review{$Config.webPageFileType}" >
		<input type="hidden" name="task" value="review" />
		<div class="form-area">
			<div class="form-error"></div>
			<input class="forma input-form" type="text" name="name" title="{$lang.contacts.nameAb}*" value="" />

			<input class="forma input-form not-req" type="text" name="phone" title="{$lang.contacts.contactPhone}" value="" />

			<div class="form-error"></div>
			<input class="forma input-form" type="text" name="email" title="{$lang.contacts.email}*" value="" />

			<div class="form-error"></div>
			<select class="form-select" name="branch">
					<option value="0">{$lang.site.selectBranch}*</option>
				{foreach from=$BranchList item=curr key=key name="branchlist"}
					<option value="{$curr.branch_id}">{$curr.title}</option>
				{/foreach}
			</select>

			<div class="form-error"></div>
			<textarea class="form-textarea input-form" name="message" title="{$lang.form.reviewText}*"></textarea>

			<div class="form-error"></div>
			<input class="forma input-form" type="text" name="secretcode" title="{$lang.form.enterSecretCode}*" value="" />

			<img id="cptch" src="{validate_url url=$SITEPATH url1='showcode' url2=$Config.webPageFileType url3='?sessid=' url4=$session}" width="{$Config.secureImageWidth}" height="{$Config.secureImageHeight}" border="0" align="absmiddle" />
			<a class="re-cpt" href="">{$lang.form.refreshSecretCode}</a>
		</div>
		<div class="form-button">
			{$lang.contacts.requiredFields}
			<div class="form-not-send">{$lang.contacts.youMustCompleteAllFields}</div>
			<a class="blue-button df-form-submit">{$lang.front.leaveReview}</a>
		</div>
	</form>
</div>