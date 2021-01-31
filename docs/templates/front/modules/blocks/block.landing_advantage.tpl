<section id="landing-advantage">
    <div id="advantage-block">
        <div class="row-1">{$lang.site.clinicalPlusSlogan1}</div>
        <div class="row-2">{$lang.site.clinicalPlusSlogan2}</div>
        <div class="row-3">
            {foreach from=$LandingAdvantage item=curr name="advantage"}
                <div class="advantage-block {if $smarty.foreach.advantage.last eq true}last{/if}">
                    <div class="advantage-block-area">
                        {$curr.text}
                    </div>
                </div>
            {/foreach}
            <div class="clear"></div>
        </div>
    </div>
</section>