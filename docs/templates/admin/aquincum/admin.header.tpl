<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
        <title>NEW - {$SiteTitle} :: {$lang.admin.adminPanel} :: {$PageTitle}</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="{$HOST}css/admin/aquincum/styles.css">
	    <meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
        <meta http-equiv="Content-Type" content="text/html; charset={$lang.charset}">
        <script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/jquery-ui-1.9.2.min.js"></script>

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


</head>
{*
<body{if $FLAGS.ResizeWindowToContentParams neq ''} onload="resizeWin();"{/if}>
{if $FLAGS.ResizeWindowToContentParams neq ''}
<script language="javascript">
function resizeWin()
{ldelim}
var wwidth=(window.innerWidth)?window.innerWidth:((document.all)?document.body.offsetWidth:null);
var wheight=(window.innerHeight)?window.innerHeight:((document.all)?document.body.offsetHeight:null);
window.resizeTo(wwidth,wheight);
{rdelim}
</script>
{/if}

{if $FLAGS.ContentOnly eq ''}
{include file="admin.adminmenu.tpl"}
<table id="contenttab" class="contenttab">
 <tr>
  <td valign="top">
<div class="pagetitle">{$PageTitle}</div>
{/if}
<center> *}

