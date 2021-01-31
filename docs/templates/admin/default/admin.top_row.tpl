
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
            <td class="info">{$lang.admin.wellcomeToAdminPanel}, <span>{$headAdmin}</span>!</td>
            <td style="text-align: center">
                <div class="all-languages">
                    <div id="lang-switch">
                        <a href="#" class="language-{$language}"></a>
                            {foreach from=$LangMenu item='curr' name='lmenu'}
                                {if $language neq $curr.locale}
                                    <a href="{$URL_WITHOUT_LANG}&{$Config.AdminLangVarName}={$curr.locale}" class="language-{$curr.locale}"></a>
                                {/if}
                            {/foreach}

                    </div>
                </div>
            </td>
            <td class="logout"><a href="index.php?mode=logout">{$lang.admin.logout}&nbsp;<img src="/images/admin/logout_ico.gif" border="0" align="absmiddle" /></a></td>
        </tr>
    </table>
    <script language="javascript">
        JSClock();
    </script>
    <div style="background: #A3B5C8;">
        <ul class="new-menu">
            {foreach from=$AdminMenuTree item=item}
                <li>
                    <a href="#">{$item.title}</a>
                    {if $item.children|@count > 0 }
                        {include file="admin.subMenu.tpl" menu=$item.children}
                    {/if}
                </li>
            {/foreach}
        </ul>
        </div>

{/if}
