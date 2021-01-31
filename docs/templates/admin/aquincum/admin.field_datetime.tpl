<input type="hidden" name="{$Field.name}" id="{$Field.id}" value="{$Field.value}" />
<script language="javascript">
	function {$Field.name}Set()
	{ldelim}
 		document.forms['{$Config.AddFormName}'].{$Field.name}.value=document.forms['{$Config.AddFormName}'].{$Field.name}Year.value+'-'+document.forms['{$Config.AddFormName}'].{$Field.name}Month.value+'-'+document.forms['{$Config.AddFormName}'].{$Field.name}Day.value+' '+document.forms['{$Config.AddFormName}'].{$Field.name}Hour.value+':'+document.forms['{$Config.AddFormName}'].{$Field.name}Minute.value+':'+document.forms['{$Config.AddFormName}'].{$Field.name}Second.value;
	{rdelim}
</script>
{if $Field.value eq ''}
	{assign var="mTime" value=$Field.defaultValue}
{else}
	{assign var="mTime" value=$Field.value}
{/if}
{html_select_date prefix=$Field.name time=$mTime field_separator="&nbsp;" day_value_format="%02d" all_extra='class="'|cat:$Field.className|cat:'" onkeyup="'|cat:$Field.name|cat:'Set();"'|cat:' onchange="'|cat:$Field.name|cat:'Set();"' reverse_years=$Field.reverseYears end_year=$Field.endYear start_year=$Field.startYear}
&nbsp;&nbsp;&nbsp;&nbsp;{html_select_time prefix=$Field.name time=$mTime use_24_hours=true all_extra='class="'|cat:$Field.className|cat:'" onkeyup="'|cat:$Field.name|cat:'Set();"'|cat:' onchange="'|cat:$Field.name|cat:'Set();"' display_meridian=false minute_interval=5 second_interval=60}
<script language="javascript">
	{$Field.name}Set();
</script>