{*{if $FLAGS.ContentOnly eq ''}*}
<script language="javascript">

function makeLinkName(value)
{ldelim}
    //alert('my test');
	var str = new String();
	str=value;
	var s = new Array({foreach from=$MakeLinkNameSearchArrJVSC item="curr" key="key" name='sjvsc'}/\{$curr|unescape:"addslashes"}/g,{/foreach}/(^\\s+)|(\\s+$)/g,/(\\s+)/g,/(\\s+)/g);
	var r = new Array({foreach from=$MakeLinkNameSearchArrJVSC item="curr" key="key" name='rjvsc'}'{$MakeLinkNameReplaceArr.$key}',{/foreach}""," ",'{$Config.AdminLinkNameDelim}');
	for(i in s)
	{ldelim}
		str=str.replace(s[i],r[i]);
	{rdelim}

	return str;
{rdelim}

</script>
<div class="fluid">
	{include file="admin.javascript_common.tpl"}
	{gen_forms ConfEditForms=$ConfEditForms Item=$Item assign="formsstr"}
	{eval var=$formsstr|unescape}
	{include file="admin.form_image.tpl"}
	{include file="admin.message_window.tpl"}
	{include file="admin.errors.tpl"}
	<form method="post" action="" name="{$Config.AddFormName}" enctype="multipart/form-data" id="validate">
		<input type="hidden" name="act" value="" />
		{if $Item.$WorkTableKeyFieldName != '' && $showAddNewForm eq ''}
			<input type="hidden" name="{$WorkTableKeyVarName}" value="{$Item.$WorkTableKeyFieldName}">
		{/if}
		<fieldset>
			<div class="widget">
				<div class="whead"><h6>{$PageTitle}{if !$Item} - {$lang.admin.addNewItem}{/if}</h6></div>
				{*{foreach from=$ConfFields item="curr" key="key"}
					{if $curr.useInAddForm eq 'y'}
						<div class="formRow">
							<div class="grid{if $curr.useInAddFormLocation eq 'full'}13{else}3{/if}"><label>{$curr.title}:{if $curr.required}<span class="req">*</span>{/if}</label></div>
							<div class="grid{if $curr.useInAddFormLocation eq 'full'}13{elseif $curr.useInAddFormLocation eq 'popup'}13{else}9{/if}">{include file="admin.field_"|cat:$curr.type|cat:".tpl" Field=$curr}</div>
						</div>
					{/if}
				{/foreach}*}
				{gen_fields ConfFields=$ConfFields Item=$Item assign="fieldsstr"}
				{eval var=$fieldsstr|unescape}
           {*
           <div class="formRow">
               <div class="grid3"><label>Password:<span class="req">*</span></label></div>
               <div class="grid9"><input type="password" class="validate[required]" name="password1" id="password1" /></div>
           </div>
           <div class="formRow">
               <div class="grid3"><label>Repeat password:<span class="req">*</span></label></div>
               <div class="grid9"><input type="password" class="validate[required,equals[password]]" name="password2" id="password2" /></div>
           </div>
           <div class="formRow">
               <div class="grid3"><label>Minimum size:<span class="req">*</span></label></div>
               <div class="grid9"><input type="text" class="validate[required,minSize[6]]" name="minValid" id="minValid"/></div>
           </div>
           <div class="formRow">
               <div class="grid3"><label>Maximum size:<span class="req">*</span></label></div>
               <div class="grid9"><input type="text" class="validate[required,maxSize[6]]" value="0123456789" name="maxValid" id="maxValid"/></div>
           </div>
           <div class="formRow">
               <div class="grid3"><label>Only letters:<span class="req">*</span></label></div>
               <div class="grid9"><input type="text" value="this is an invalid char '.'" class="validate[required,custom[onlyLetterSp]]" name="lettersValid" id="lettersValid"/></div>
           </div>
           <div class="formRow">
               <div class="grid3"><label>Only numbers and space:<span class="req">*</span></label></div>
               <div class="grid9"><input type="text" value="10.1" class="validate[required,custom[onlyNumberSp]]" name="numsValid" id="numsValid"/></div>
           </div>
           <div class="formRow">
               <div class="grid3"><label>Regular expressions:<span class="req">*</span></label></div>
               <div class="grid9"><input type="text" value="too many spaces obviously" class="validate[required,custom[onlyLetterNumber]]" name="regexValid" id="regexValid"/></div>
           </div>
           <div class="formRow">
               <div class="grid3"><label>IP address:<span class="req">*</span></label></div>
               <div class="grid9"><input type="text" value="192.168.3." class="validate[required,custom[ipv4]]" name="ipValid" id="ipValid"/></div>
           </div>
           <div class="formRow">
               <div class="grid3"><label>Email address:<span class="req">*</span></label></div>
               <div class="grid9"><input type="text" value="" class="validate[required,custom[email]]" name="emailValid" id="emailValid"/></div>
           </div>
           <div class="formRow">
               <div class="grid3"><label>Date validation:<span class="req">*</span></label></div>
               <div class="grid9"><input type="text" value="2009/06/30" class="validate[custom[date],past[2010/01/01]]" name="dateValid" id="dateValid"/></div>
           </div>
           <div class="formRow">
               <div class="grid3"><label>Select:<span class="req">*</span></label></div>
               <div class="grid9">
                   <select name="selectReq" id="selectReq" class="validate[required]" >
                       <option value="">Usual select box</option>
                       <option value="opt2">Option 2</option>
                       <option value="opt3">Option 3</option>
                       <option value="opt4">Option 4</option>
                       <option value="opt5">Option 5</option>
                       <option value="opt6">Option 6</option>
                       <option value="opt7">Option 7</option>
                       <option value="opt8">Option 8</option>
                   </select>
               </div>
           </div>
           <div class="formRow">
               <div class="grid3"><label>Textarea:<span class="req">*</span></label></div>
               <div class="grid9"><textarea rows="8" cols="" name="textarea" class="validate[required]" id="textareaValid"></textarea></div>
           </div>
           <div class="formRow"><input type="submit" value="Submit" class="buttonM bBlack formSubmit" /></div> *}

			</div>
		</fieldset>
	</form>
</div>
<ul class="middleNavR">
	{if $NoUse.SaveItemButton == ''}
		{include file="admin.button_add_edit.tpl"}
	{/if}
	{if $Item.$WorkTableKeyFieldName != '' && $showAddNewForm eq ''}
		{if $NoUse.BackButton == ''}
			{include file="admin.button_back.tpl"}
		{/if}
		{foreach from=$ItemButtons item="curr" key="key"}
			{if $curr.newRow neq ''}<br /><br />{/if}
			<li>
				<a href="#" title="{$curr.value}" class="tipN" onclick="{eval var=$curr.onclick|unescape}">
					<img src="{$HOST}{$Config.MainImageFolder}{$Config.adminImageFolder}{$Config.adminTheme}/icons/middlenav/{$curr.img}" alt="" />
				</a>
			</li>
			{*<input class="{if $curr.cssClass neq ''}{$curr.cssClass}{else}button{/if}" type="button" value="{$curr.value}" onclick="{eval var=$curr.onclick|unescape}" />*}
		{/foreach}
	{else}
		{if $onlyAddItem && $ItemButtons|@count}
			{foreach from=$ItemButtons item="curr" key="key"}
				{if $curr.newRow neq ''}<br /><br />{/if}
				<li>
					<a href="#" title="{$curr.value}" class="tipN" onclick="{eval var=$curr.onclick|unescape}">
						<img src="{$HOST}{$Config.MainImageFolder}{$Config.adminImageFolder}{$Config.adminTheme}/icons/middlenav/{$curr.img}" alt="" />
					</a>
				</li>
			{/foreach}
		{/if}
		{if $NoUse.BackButton == ''}
			<li>
				<a href="#" title="{$lang.admin.cancelButton}" class="tipN" onclick="hideAddNewForm(); return false;">
					<img src="{$HOST}{$Config.MainImageFolder}{$Config.adminImageFolder}{$Config.adminTheme}/icons/middlenav/cancel_ico.png" alt="" />
				</a>
			</li>
		{/if}
	{/if}
</ul>