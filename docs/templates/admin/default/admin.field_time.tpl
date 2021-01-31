<input type="hidden" name="{$Field.name}" id="{$Field.id}" value="{$Field.value}" />
	<script language="javascript">
		function {$Field.name}Set()
		{ldelim}
			document.forms['{$Config.AddFormName}'].{$Field.name}.value=document.forms['{$Config.AddFormName}'].{$Field.name}Hour.value+'{$Config.AdminDoubleDoteDelim}'+document.forms['{$Config.AddFormName}'].{$Field.name}Minute.value+'{$Config.AdminDoubleDoteDelim}00';
		{rdelim}
	</script>
{html_select_time prefix=$Field.name time=$Field.value  all_extra='class="'|cat:$Field.className|cat:'" onkeyup="'|cat:$Field.name|cat:'Set();"'|cat:' onchange="'|cat:$Field.name|cat:'Set();"' use_24_hours=true minute_interval=$Field.minInterval second_interval=60}
<script language="javascript">
	{$Field.name}Set();
</script>