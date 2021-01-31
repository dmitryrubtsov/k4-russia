{*{html_options name=$Field.name options=$Field.values selected=$Field.value id=$Field.id other=$Field.other|unescape} *}

{assign var="fieldName" value=`$Field.name`}
<select name="{$Field.name}" id="{$Field.id}" >
	{foreach from=$Field.values item="group1" key="key1"}
		<option value="{$group1.value}" {if $group1.value eq $smarty.get.$fieldName} selected {/if} >{$group1.name} {$group1.lastname} ({$group1.email})</option>
		{foreach from=$group1.group item="group2" key="key2"}
			<option value="{$group2.value}" {if $group2.value eq $smarty.get.$fieldName} selected {/if} >
				---
				{$group2.name} {$group2.lastname} ({$group2.email})
			</option>
			{foreach from=$group2.group item="group3" key="key3"}
				<option value="{$group3.value}" {if $group3.value eq $smarty.get.$fieldName} selected {/if} >
					------
					{$group3.name} {$group3.lastname} ({$group3.email})
				</option>
				{foreach from=$group3.group item="group4" key="key4"}
					<option value="{$group4.value}" {if $group4.value eq $smarty.get.$fieldName} selected {/if} >
						---------
						{$group4.name} {$group4.lastname} ({$group4.email})
						{foreach from=$group4.group item="group5" key="key5"}
							<option value="{$group5.value}" {if $group5.value eq $smarty.get.$fieldName} selected {/if} >
								------------
								{$group5.name} {$group5.lastname} ({$group5.email})
								{foreach from=$group5.group item="group6" key="key6"}
									<option value="{$group6.value}" {if $group6.value eq $smarty.get.$fieldName} selected {/if} >
										---------------
										{$group6.name} {$group6.lastname} ({$group6.email})
									</option>
								{/foreach}
							</option>
						{/foreach}
					</option>
				{/foreach}
			{/foreach}
		{/foreach}
	{/foreach}
</select>

{if $Field.textAfterField}
	&nbsp;{$Field.textAfterField|unescape}
{/if}
{if $Field.textUnderField}
	<br /><sup>{$Field.textUnderField|unescape}</sup>
{/if}