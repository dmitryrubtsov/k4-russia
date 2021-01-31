{if $Config.ShowSliderOnHomePage eq 'y'}
    {if $sliderArray|@count > 0}
        <div id="ftHolder">
            <div id="ft">
                {foreach from=$sliderArray item=curr}
                    <img src="{$curr.image}" alt="{$curr.slideTitle}" />
                    <a href='{if $curr.url neq ''}{$curr.url}{else}#{/if}' {if $curr.url neq ''&& $curr.target eq 1} target="__blank"{/if}></a>
                {/foreach}
            </div>
        </div>
        <div class="clear"></div>
    {/if}
{/if}