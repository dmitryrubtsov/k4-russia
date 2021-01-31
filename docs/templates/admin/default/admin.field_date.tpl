<input type="hidden" name="{$Field.name}" id="{$Field.id}" value="{$Field.value}" />
<script language="javascript">
	function {$Field.name}Set()
	{ldelim}
 		document.forms['{$Config.AddFormName}'].{$Field.name}.value=document.forms['{$Config.AddFormName}'].{$Field.name}Year.value+'-'+document.forms['{$Config.AddFormName}'].{$Field.name}Month.value+'-'+document.forms['{$Config.AddFormName}'].{$Field.name}Day.value;
	{rdelim}
</script>
{if $Field.value eq ''}
	{assign var="mTime" value=$Field.defaultValue}
{else}
	{assign var="mTime" value=$Field.value}
{/if}
{html_select_date prefix=$Field.name time=$mTime field_separator="&nbsp;" day_value_format="%02d" all_extra='class="'|cat:$Field.className|cat:'" onkeyup="'|cat:$Field.name|cat:'Set();"'|cat:' onchange="'|cat:$Field.name|cat:'Set();"' reverse_years=$Field.reverseYears end_year=$Field.endYear start_year=$Field.startYear}
<script language="javascript">
	{$Field.name}Set();
</script>