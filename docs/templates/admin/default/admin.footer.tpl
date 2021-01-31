
{if $FLAGS.ContentOnly eq ''}


{if $adminMode != "login"}
<div class="footer" >
    {*<div class="bottom" id="contenttabbottd">*}
        {*<td class="developer">{$lang.admin.poweredBy} <a href="mailto:{$Config.DeveloperEmail}" title="{$Config.DeveloperName}">{$Config.DeveloperNickname}</a> ( ICQ: {$Config.DeveloperICQ} )</td>
        <td class="version">{$lang.admin.version}: {$Config.AdminVersion}</td>*}
        <div class="copyright">{$lang.admin.copyright} &copy; {if $Config.AdminCreateYear < $smarty.now|date_format:'%Y'}{$Config.AdminCreateYear} - {/if}{$smarty.now|date_format:'%Y'} {*<a href="{$Config.DeveloperCompanySite}">{$Config.DeveloperCompany}</a>.*} {$lang.admin.allRightsReserved}</div>
      {*</div>*}
</div>
{/if}


{*<script language="javascript">*}
{*function getClientHeight()*}
{*{ldelim}*}
  {*return document.compatMode=='CSS1Compat' && !window.opera?document.documentElement.clientHeight:document.body.clientHeight;*}
{*{rdelim}*}
{*function resizeBody()*}
{*{ldelim}*}
  {*document.getElementById('contenttab').style.height=(getClientHeight()-56)+'px';*}
  {*setTimeout('resizeBody()', 1000);*}
{*{rdelim}*}
{*resizeBody();*}
{*</script>*}
{/if}
{*<script language="JavaScript" type="text/javascript" src="/{$Config.JSPath}wz_tooltip.js"></script>*}

