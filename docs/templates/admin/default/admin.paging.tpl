
    <table class="paging"><tr><td class="onpage">
     <form method="get" action="" name="paging{$position}">

     {foreach from=$smarty.get item="curr" key="key"}
      {if $key neq 'onpage' && $curr neq ''}
      <input type="hidden" name="{$key}" value="{$curr}" />
      {/if}
     {/foreach}
     {$lang.admin.onPage}:&nbsp;
     <select name="onpage" onChange="document.forms['paging{$position}'].submit();">
      {foreach from=$onPageList item="curr"}
       <option value="{$curr}"{if $curr eq $smarty.get.onpage && $smarty.get.onpage neq '' || $curr eq $Config.onPage && $smarty.get.onpage eq ''} selected{/if}>{$curr}</option>
      {/foreach}
     </select>&nbsp;
    </form>
    </td><td>
    <span class="pages"> {$lang.admin.pages}:
     {if $listInfo.prev ne 0}
      <a class="pages" href="?mode={$adminMode}{foreach from=$listInfo.useInLink item='curr' key='key'}{if $curr neq '' && $listInfo.$curr neq '' && $curr neq 'page'}&{$curr}={$listInfo.$curr}{/if}{/foreach}&page={$listInfo.firstpage}{foreach from=$listInfo.where item='curr' key='key'}{if $curr.value neq ''}&{$key}={$curr.value}{/if}{/foreach}"><<<</a>&nbsp;&nbsp;
      <a class="pages" href="?mode={$adminMode}{foreach from=$listInfo.useInLink item='curr' key='key'}{if $curr neq '' && $listInfo.$curr neq '' && $curr neq 'page'}&{$curr}={$listInfo.$curr}{/if}{/foreach}&page={$listInfo.prev}{foreach from=$listInfo.where item='curr' key='key'}{if $curr.value neq ''}&{$key}={$curr.value}{/if}{/foreach}"><<</a>
     {/if}
     {section name=Page loop=$listInfo.pages}
           {if $listInfo.pages[Page] == $listInfo.page}
                   <span class="currpage">{$listInfo.pages[Page]}</span> {if not $smarty.section.Page.last}|{/if}
           {else}
                   <a class="pages"  href="?mode={$adminMode}{foreach from=$listInfo.useInLink item='curr' key='key'}{if $curr neq '' && $listInfo.$curr neq '' && $curr neq 'page'}&{$curr}={$listInfo.$curr}{/if}{/foreach}&page={$listInfo.pages[Page]}{foreach from=$listInfo.where item='curr' key='key'}{if $curr.value neq ''}&{$key}={$curr.value}{/if}{/foreach}">{$listInfo.pages[Page]}</a>&nbsp;{if not $smarty.section.Page.last}|{/if}
        {/if}
     {sectionelse}
        {$lang.admin.noPages}
     {/section}
     {if $listInfo.next ne 0}
      <a class="pages" href="?mode={$adminMode}{foreach from=$listInfo.useInLink item='curr' key='key'}{if $curr neq '' && $listInfo.$curr neq '' && $curr neq 'page'}&{$curr}={$listInfo.$curr}{/if}{/foreach}&page={$listInfo.next}{foreach from=$listInfo.where item='curr' key='key'}{if $curr.value neq ''}&{$key}={$curr.value}{/if}{/foreach}">>></a>&nbsp;&nbsp;
      <a class="pages" href="?mode={$adminMode}{foreach from=$listInfo.useInLink item='curr' key='key'}{if $curr neq '' && $listInfo.$curr neq '' && $curr neq 'page'}&{$curr}={$listInfo.$curr}{/if}{/foreach}&page={$listInfo.lastpage}{foreach from=$listInfo.where item='curr' key='key'}{if $curr.value neq ''}&{$key}={$curr.value}{/if}{/foreach}">>>></a>
     {/if}   &nbsp
    </span>
    </td>
    {math assign='countFin' equation="a + b" a=$listInfo.countSt b=$listInfo.onpage}
    <td class="countresult">{math equation="a + b" a=$listInfo.countSt b=1} - {if $countFin > $listInfo.count}{$listInfo.count}{else}{$countFin}{/if} {$lang.admin.from} {$listInfo.count}</td>
    </tr></table>

