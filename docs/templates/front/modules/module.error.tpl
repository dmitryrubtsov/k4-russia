{*
<span class="title">{$lang.front.pageNotFound}</span>
<br /><br />
<a href="{$BaseURL}"><< {$lang.front.backToHomePage}</a>
*}
{*
<script language="javascript">
	function redirPage()
	{ldelim}
		document.location.href='{$BaseURL}';
	{rdelim}

	setTimeout('redirPage()', 3000);
</script>
*}

<div class="head">
    <h1>{$page404Title}</h1>
</div>
<div class="content-body">
     {$page404|unescape}
</div>