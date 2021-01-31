<div class="footer-left">
    <p>
        {if $Config.copyright }
            <span>Copyright&#169;{$Config.copyright}</span>
            <span>|</span>
        {/if}
        <span>{if $Config.companyType}{$Config.companyType}{/if} &laquo;{if $Config.companyName}{$Config.companyName}{/if}&raquo;</span>
        <span>|</span>
        <span>Все права защищены.</span>
    </p>
</div>
<div class="footer-right">
    {if $Config.contactsEmail}
        <a href="mailto:mos@k4-russia.ru">{$Config.contactsEmail}</a>
    {/if}

</div>
<div class="clearfix"></div>