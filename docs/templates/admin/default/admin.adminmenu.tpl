
{if $adminMode != "login"}
<script language="javascript">
function show(id)
{ldelim}
  document.getElementById(id).style.display='block';
{rdelim}
function hide(id)
{ldelim}
  document.getElementById(id).style.display='none';
{rdelim}
function clickmenu(id)
{ldelim}
  if(document.getElementById(id).style.display=='block')
  {ldelim}
    hide(id);
  {rdelim}
  else
  {ldelim}
    show(id);
  {rdelim}
{rdelim}
function getdayinmon(year,mon)
{ldelim}
  D=year%4==0&&(year%100!=0||year%400==0);
  dayInMonth=[31,28+D,31,30,31,30,31,31,30,31,30,31];
  return (dayInMonth[mon]);
{rdelim}
function JSClock()
{ldelim}
  var hour = (document.getElementById('hour').innerHTML != '') ? parseInt(document.getElementById('hour').innerHTML, 10) : {$DB_TIME|date_format:"%H"};
  var minute = (document.getElementById('minute').innerHTML != '') ? parseInt(document.getElementById('minute').innerHTML, 10) : {$DB_TIME|date_format:"%M"};
  var second = (document.getElementById('second').innerHTML != '') ? parseInt(document.getElementById('second').innerHTML, 10) : ({$DB_TIME|date_format:"%S"}-1);
  var day = (document.getElementById('day').innerHTML != '') ? parseInt(document.getElementById('day').innerHTML, 10) : {$DB_TIME|date_format:"%d"};
  var month = (document.getElementById('month').innerHTML != '') ? parseInt(document.getElementById('month').innerHTML, 10) : {$DB_TIME|date_format:"%m"};
  var year = (document.getElementById('year').innerHTML != '') ? parseInt(document.getElementById('year').innerHTML, 10) : {$DB_TIME|date_format:"%Y"};
  second++;
  if(second==60)
  {ldelim}
    second=0;
    minute++;
  {rdelim}
  if(minute==60)
  {ldelim}
    minute=0;
    hour++;
  {rdelim}
  if(hour==24)
  {ldelim}
    hour=0;
    day++;
  {rdelim}
  if(day==(getdayinmon(year,month)+1))
  {ldelim}
    day=1;
    month++;
  {rdelim}
  if(month==13)
  {ldelim}
    month=1;
    year++;
  {rdelim}

  if(second<10)
  {ldelim}
    second="0"+second;
  {rdelim}
  if(minute<10)
  {ldelim}
  	minute="0"+minute;
  {rdelim}
  if(month<10)
  {ldelim}
  	month="0"+month;
  {rdelim}
  if(day<10)
  {ldelim}
  	day="0"+day;
  {rdelim}
  document.getElementById('second').innerHTML = second;
  document.getElementById('minute').innerHTML = minute;
  document.getElementById('hour').innerHTML = hour;
  document.getElementById('day').innerHTML = day;
  document.getElementById('year').innerHTML = year;
  document.getElementById('month').innerHTML = month;
  self.setTimeout("JSClock()",{$Config.AdminJSClockInterval});
{rdelim}
function showSubMenuUni(id,menuid,subMenuClassName,menuClassName)
{ldelim}
  currSubMenu = document.getElementById(id);
  currMenu = document.getElementById(menuid);
  currSubMenu.className=subMenuClassName;
  currSubMenu.style.left=currMenu.offsetLeft-1;
  currMenu.className=menuClassName;
  currSubMenu.style.minWidth=currMenu.offsetWidth;
{rdelim}
function hideSubMenuUni(id,menuid,subMenuClassName,menuClassName)
{ldelim}
  currSubMenu = document.getElementById(id);
  currMenu = document.getElementById(menuid);
  currMenu.className=menuClassName;
  currSubMenu.className=subMenuClassName;
{rdelim}
function showSubMenu(id,menuid,tabid)
{ldelim}
  showSubMenuUni(id,menuid,'adminsubmenu','hover');
{rdelim}
function hideSubMenu(id,menuid)
{ldelim}
  hideSubMenuUni(id,menuid,'hid','menu');
{rdelim}
</script>
<table class="top">
 <tr>
  <td class="time">{$lang.admin.serverDate}:&nbsp;<span class="timeval"><span id="day"></span>.<span id="month"></span>.<span id="year"></span></span>&nbsp;&nbsp;&nbsp;{$lang.admin.serverTime}:&nbsp;<span class="timeval"><span id=hour></span>:<span id=minute></span>:<span id=second></span></span></td>
  <td class="info">{$lang.admin.wellcomeToAdminPanel}, <span>{$Admin.AdmLogin}</span>!</td>
  {count_arr arr=$LANGS assign="LANGSCount"}
  {if $LANGSCount > 1}
  <td class="language" onmouseover="showSubMenuUni('div{$Config.AdminLangVarName}','td{$Config.AdminLangVarName}','langsubmenu','language-hover');" onmouseout="hideSubMenuUni('div{$Config.AdminLangVarName}','td{$Config.AdminLangVarName}','hid','language');" id="td{$Config.AdminLangVarName}">{$LANGS.$language.menutitle}
  <div class="hid" id="div{$Config.AdminLangVarName}">
  <table class="langmenugroup">
  {foreach from=$LANGS item="curr" key="key"}
   {if $key neq $language}
   <tr><td><a href="{$URL_WITHOUT_LANG}&{$Config.AdminLangVarName}={$key}">{$curr.menutitle}</a></td></tr>
   {/if}
  {/foreach}
  </table>
  </div>
  </td>
  {else}
  <td class="languagesimp">{$LANGS.$language.menutitle}</td>
  {/if}
  <td class="logout"><a href="index.php?mode=logout">{$lang.admin.logout}&nbsp;<img src="/images/admin/logout_ico.gif" border="0" align="absmiddle" /></a></td>
 </tr>
</table>
<script language="javascript">
JSClock();
</script>
<table class="adminmenu">
 <tr>
  <td class="bufer"></td>
{count_arr arr=$adminMenu assign="menuCount"}
{if $menuCount < $Config.adminMenuMinGroupCount - 1}
 <td class="menu" width="{math equation='round(x/y)' x=100 y=$Config.adminMenuMinGroupCount}%"></td>
 {assign var="leftCol" value="1"}
{else}
 {assign var="leftCol" value="0"}
{/if}
{foreach from=$adminMenu item="curr" key="key" name="admmenu"}
  <td class="menu" onmouseover="showSubMenu('div{$curr.code}','td{$curr.code}','menugroup{$curr.code}');" onmouseout="hideSubMenu('div{$curr.code}','td{$curr.code}');" id="td{$curr.code}" width="{if $menuCount < $Config.adminMenuMinGroupCount}{math equation='round(x/y)' x=100 y=$Config.adminMenuMinGroupCount}{else}{math equation='round(x/y)' x=100 y=$menuCount}{/if}%">{$curr.title}
  <div class="hid" id="div{$curr.code}">
  <table class="menugroup" id="menugroup{$curr.code}">
  {foreach from=$curr.items item="current" key="key1"}
   <tr><td><a href="index.php?mode={$current.linkvar}{$Config.adminListPart}{$current.addlinkvars}">{$current.title}</a></td></tr>
  {/foreach}
  </table>
  </div></td>
{/foreach}
{if $smarty.foreach.admmenu.total < $Config.adminMenuMinGroupCount}
 {math equation='x-y' x=$Config.adminMenuMinGroupCount y=$leftCol assign="itemsCount"}
 {section name="missmenu" loop=$itemsCount start=$smarty.foreach.admmenu.total}
  <td class="menu" width="{math equation='round(x/y)' x=100 y=$Config.adminMenuMinGroupCount}%"></td>
 {/section}
{/if}
 <td class="bufer"></td>
 </tr>
</table>
{/if}
