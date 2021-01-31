<html>
<head>
    <title>{$SiteTitle} :: {$lang.admin.adminPanel} :: {$PageTitle}</title>
    <link rel="stylesheet" type="text/css" href="{$HOST}{$templatePass}css/style.css">
    <link rel="stylesheet" type="text/css" href="{$HOST}{$templatePass}css/df_admin_menu.css">
    <link rel="stylesheet" type="text/css" href="{$HOST}{$templatePass}css/prettyPhoto.css" media="screen" title="prettyPhoto main stylesheet" charset="{$lang.charset}">
    <meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
    <meta http-equiv="Content-Type" content="text/html; charset={$lang.charset}">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="{$HOST}{$templatePass}js/jquery.prettyPhoto.js" charset="{$lang.charset}"></script>
    <script type="text/javascript" src="{$HOST}{$templatePass}js/df_admin_menu.js"></script>
    <script type="text/javascript" src="{$HOST}{$templatePass}js/code.js"></script>
</head>
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
{*
{if $FLAGS.ContentOnly eq ''}
{include file="admin.adminmenu.tpl"}
<table id="contenttab" class="contenttab">
 <tr>
  <td valign="top">
<div class="pagetitle">{$PageTitle}</div>
{/if}
<center> *}


