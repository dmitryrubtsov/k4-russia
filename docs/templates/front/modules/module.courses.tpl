{if $blocktype eq 'curr'}
	<h1>{$lang.site.learningCourses}</h1>
	<h2>{$CourseArticle.title}</h2>

<div class="course-card">
	{$lang.site.learningBranch}: <span>{$CourseArticle.branch}</span><br />
	{$lang.site.learningCity}: <span>{$CourseArticle.city}</span><br />
	{$lang.site.learningLine}: <span>{$CourseArticle.line}</span><br />
	{$lang.site.learningFormat}: <span>{$CourseArticle.format}</span><br />
	{$lang.site.courseVolume}: <span>{$CourseArticle.volume}</span><br />
	{$lang.site.courseDuration}: <span>{$CourseArticle.duration}</span><br />
	{$lang.site.coursePrice}: <span>{$CourseArticle.price}</span>
</div>

<div class="article-block">
	{eval var=$CourseArticle.text|unescape}
</div>

<h2>{$lang.site.enrollInCourse}</h2>
<div class="form-block">
	<form id="form-course" method="post" action="{$BaseURL}send-form-course{$Config.webPageFileType}" >
		<input type="hidden" name="task" value="course" />
		<input type="hidden" name="course_id" value="{$CourseArticle.course_id}" />
		<input type="hidden" name="branch_id" value="{$CourseArticle.branch_id}" />
		<input type="hidden" name="learning_line_id" value="{$CourseArticle.learning_line_id}" />
		<input type="hidden" name="learning_format_id" value="{$CourseArticle.learning_format_id}" />
		<div class="form-area">
			<div class="form-error"></div>
			<input class="forma input-form" type="text" name="name" title="{$lang.contacts.nameAb}*" value="" />

			<div class="form-error"></div>
			<input class="forma input-form" type="text" name="phone" title="{$lang.contacts.contactPhone}*" value="" />

			<div class="form-error"></div>
			<input class="forma input-form" type="text" name="email" title="{$lang.contacts.email}*" value="" />

			<textarea class="form-textarea input-form" name="message" title="{$lang.form.comment}"></textarea>

			<div class="form-error"></div>
			<input class="forma input-form" type="text" name="secretcode" title="{$lang.form.enterSecretCode}*" value="" />

			<img id="cptch" src="{validate_url url=$SITEPATH url1='showcode' url2=$Config.webPageFileType url3='?sessid=' url4=$session}" width="{$Config.secureImageWidth}" height="{$Config.secureImageHeight}" border="0" align="absmiddle" />
			<a class="re-cpt" href="">{$lang.form.refreshSecretCode}</a>
		</div>
		<div class="form-button">
			{$lang.contacts.requiredFields}
			<div class="form-not-send">{$lang.contacts.youMustCompleteAllFields}</div>
			<a class="blue-button df-form-submit">{$lang.site.request}</a>
		</div>
	</form>
</div>
{else}
  	<h1>{$lang.site.learningCourses}</h1>
	<div class="article-block">
		{eval var=$Article.body|unescape}
	</div>
	<div class="filter-block">
		<div class="title">{$lang.site.filterSelectionOfTrainingPrograms}</div>
		<div class="area">
			<form method="get" action="" name="courses">
				<div class="select-area">
					<span>{$lang.site.learningBranch}</span><br />
					<select name="branch">
							<option value="all">{$lang.site.allBranches}</option>
						{foreach from=$BranchesArray item=curr key=key name="branches"}
							<option value="{$curr.branch_id}" {if $smarty.get.branch eq $curr.branch_id} selected {/if}>{$curr.title}&nbsp;&nbsp;</option>
						{/foreach}
					</select>
				</div>
				<div class="select-area">
					<span>{$lang.site.learningLine}</span><br />
					<select name="line" class="long">
							<option value="all">{$lang.site.allLines}</option>
						{foreach from=$LearningLinesArray item=curr key=key name="lines"}
							<option value="{$curr.learning_line_id}" {if $smarty.get.line eq $curr.learning_line_id} selected {/if}>{$curr.title}&nbsp;&nbsp;</option>
						{/foreach}
					</select>
				</div>
				<div class="select-area">
					<span>{$lang.site.learningFormat}</span><br />
					<select name="format">
							<option value="all">{$lang.site.allFormats}</option>
						{foreach from=$LearningFormatsArray item=curr key=key name="formats"}
							<option value="{$curr.learning_format_id}" {if $smarty.get.format eq $curr.learning_format_id} selected {/if}>{$curr.title}&nbsp;&nbsp;</option>
						{/foreach}
					</select>
				</div>
				<div class="button-area">
					<a href="#" class="site-button" onclick="document.forms['courses'].submit(); return false;">{$lang.site.chooseBranch}</a>
				</div>
				<div class="clear"></div>
				<div class="select-area">
					<span>{$lang.site.nameOfProgramm}</span><br />
					<select name="rubric" class="verylong">
							<option value="all">{$lang.site.allPrograms}</option>
						{foreach from=$RubricSelect item=curr key=key name="rubric"}
							<optgroup label="{$curr.title}">
								{foreach from=$curr.courses item=rcurr key=rkey name="rcourse"}
									<option value="{$rcurr.id}" {if $smarty.get.rubric eq $rcurr.id} selected {/if}>&nbsp;&nbsp;&nbsp;-&nbsp;{$rcurr.title}&nbsp;&nbsp;</option>
								{/foreach}
							</optgroup>
						{/foreach}
					</select>
				</div>
				<div class="clear"></div>
			</form>
		</div>
	</div>
	{if $Items|@count > 0}
		{foreach from=$Items item=curr key=key name="courses"}
			<div class="section-list">
				<h2>{$curr.title}</h2>
				<div class="section-news">
					{$curr.description}
					<a href="{$curr.link}" class="link-more">{$lang.front.more}</a>
				</div>
				<div class="section-digit">
					{$lang.site.coursePrice}: <span>{$curr.price}</span>
					{$lang.site.courseVolume}: <span>{$curr.volume}</span>
					{$lang.site.courseDuration}: <span>{$curr.duration}</span>
				</div>
				<div class="big-button-area">
					<a href="{$curr.link}" class="blue-button">{$lang.front.more}</a>
				</div>
			</div>
		{/foreach}

		{if $Paging.pages|@count > 1}
			{include file=$Config.ModulesFolder|cat:$Config.BlocksFolder|cat:"block.paging.tpl" Paging=$Paging Link=$Paging.link}
	  	{/if}
  	{else}
  		<div class="not-found">{$lang.site.yourSearchDidNotFound}</div>
  	{/if}
{/if}