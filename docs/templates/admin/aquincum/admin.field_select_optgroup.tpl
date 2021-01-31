{assign var="fieldName" value=`$Field.name`}
<select name="{$Field.name}" id="{$Field.id}">
    {if $Field.valueTooltip}
        <option value="">{$Field.valueTooltip}</option>
    {/if}
    {foreach from=$Field.values item=optcurr key=optkey name="optgroup"}
        <optgroup label="{$optcurr.title}">
            {foreach from=$optcurr.group item=curr key=key name="group"}
                <option value="{$curr.id}" {if $curr.id eq $Field.value} selected {/if}>{$curr.title}</option>
            {/foreach}
        </optgroup>
    {/foreach}
</select>
{if $Field.textAfterField}
	&nbsp;{$Field.textAfterField|unescape}
{/if}
{if $Field.textUnderField}
	<br /><sup>{$Field.textUnderField|unescape}</sup>
{/if}