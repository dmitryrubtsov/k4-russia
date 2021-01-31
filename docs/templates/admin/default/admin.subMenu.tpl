<ul>
    {foreach from=$menu item=item}
       <li>
           <a href="index.php?mode={$item.linkvar}{$Config.adminListPart}{$item.addlinkvars}">{$item.title}</a>
           {if $item.children|@count > 0 }
               {include file="admin.subMenu.tpl" menu=$item.children}
           {/if}
       </li>
    {/foreach}
</ul>