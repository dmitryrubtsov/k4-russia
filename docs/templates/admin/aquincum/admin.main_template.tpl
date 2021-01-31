<!DOCTYPE html>
<html>
<head>
        <title>{$SiteTitle} :: {$lang.admin.adminPanel} :: {$PageTitle}</title>
        <link rel="stylesheet" type="text/css" href="{$HOST}{$Config.cssPath}admin/aquincum/styles.css">
        <link rel="stylesheet" type="text/css" href="{$HOST}{$Config.cssPath}prettyPhoto.css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
	    <meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
        <meta http-equiv="Content-Type" content="text/html; charset={$lang.charset}">

        <link rel="shortcut icon" href="{$HOST}favicon.ico" type="image/x-icon">
        <link rel="icon" href="{$HOST}favicon.ico" type="image/x-icon">

        <!-- Mobile viewport optimized: h5bp.com/viewport -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	{if $FLAGS.ContentOnly eq ''}
        <script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/jquery-ui-1.9.2.min.js"></script>
        <script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/jquery.fancybox-1.3.4.pack.js"></script>
        <script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/jquery.easing-1.3.pack.js"></script>
        <script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/jquery.mousewheel-3.0.4.pack.js"></script>
        <script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/jquery.prettyPhoto.js" charset="utf-8"></script>
        <script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admincode.js"></script>
        <script type="text/javascript" src="{$HOST}{$templatePass}js/code.js"></script>

        <script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/charts/excanvas.min.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/charts/jquery.flot.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/charts/jquery.flot.orderBars.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/charts/jquery.flot.pie.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/charts/jquery.flot.resize.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/charts/jquery.sparkline.min.js"></script>

		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/tables/jquery.dataTables.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/tables/jquery.sortable.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/tables/jquery.resizable.js"></script>

		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/forms/jquery.autosize.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/forms/jquery.uniform.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/forms/jquery.inputlimiter.min.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/forms/jquery.tagsinput.min.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/forms/jquery.maskedinput.min.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/forms/jquery.autotab.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/forms/jquery.select2.min.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/forms/jquery.dualListBox.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/forms/jquery.cleditor.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/forms/jquery.ibutton.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/forms/jquery.validationEngine-en.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/forms/jquery.validationEngine.js"></script>

        <script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/uploader/plupload.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/uploader/plupload.html4.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/uploader/plupload.html5.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/uploader/jquery.plupload.queue.js"></script>

		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/wizards/jquery.form.wizard.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/wizards/jquery.validate.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/wizards/jquery.form.js"></script>

		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/ui/jquery.collapsible.min.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/ui/jquery.breadcrumbs.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/ui/jquery.tipsy.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/ui/jquery.progress.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/ui/jquery.timeentry.min.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/ui/jquery.colorpicker.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/ui/jquery.jgrowl.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/ui/jquery.fancybox.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/ui/jquery.fileTree.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/ui/jquery.sourcerer.js"></script>

		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/others/jquery.fullcalendar.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/others/jquery.elfinder.js"></script>

        <script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/forms/jquery.mousewheel.js"></script>
        <script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/plugins/ui/jquery.easytabs.min.js"></script>
        <script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/files/bootstrap.js"></script>
        <script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/files/login.js"></script>
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/admin/files/functions.js"></script>

	{/if}

</head>

<body>
{if $FLAGS.ContentOnly eq ''}
	<div id="top">
		{*{$Blocks.adminMessagesBlock|unescape}*}
	    {$Blocks.topRow|unescape}
	</div>
{/if}

{if $isLogin}
	{$Blocks.loginForm|unescape}
{else}
	{if $FLAGS.ContentOnly eq ''}
		<div id="sidebar">
	    	<div class="mainNav" >
	        	{$Blocks.userLogoBlock|unescape}
				{$Blocks.userAltNavi|unescape}
	            {$Blocks.mainMenuBlock|unescape}
	    	</div>
			<div class="secNav">
				<div class="secWrapper">
					{$Blocks.submenuTopSection|unescape}
					{*{$Blocks.newMessagesBlock|unescape}*}
					{$Blocks.submenuBlock|unescape}
				</div>
			</div>
	    </div>
		<div id="content">
		    <div class="contentTop">
		        <span class="pageTitle"><span class="icon-screen"></span>{$PageTitle}</span>
		        {*<span class="courseBlock" id="test"></span>*}
		        {*{$Blocks.statsBlock|unescape}*}
		    </div>
			{$Blocks.breadCrumbs|unescape}
	{/if}
		    <div class="wrapper">
				{$MainContent|unescape}
		    </div>
	{if $FLAGS.ContentOnly eq ''}
		</div>
	{/if}
{/if}

</body>
</html>