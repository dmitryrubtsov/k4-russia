<input class="{if $Field.className eq ''}inp_inpt{else}{$Field.className}{/if} styled" type="file" name="{$Field.name}" {if $Field.id neq ''} id="{$Field.id}"{/if}{if $Field.other neq ''} {$Field.other|unescape}{/if} />

{if $Field.textAfterField}&nbsp;{$Field.textAfterField|unescape}{/if}{if $Field.textUnderField}<br /><sup>{$Field.textUnderField|unescape}</sup>{/if}

{if $Item[$Field.name]}
	{assign var='imarray' value=$Item[$Field.name]}
	{if $imarray.images && $imarray.images|@count > 0}

     	<div class="image-field-area">
	     	{foreach from=$imarray.images item=curr key=key}
	     		{*{if $curr.path_small neq ''}
	     			<a href="http://vd.recreator.ru/1961/index.php?mode=image&key_image_id={$curr.image_id}&pmode=image_list&cntonly=y" class="iframe">
		     			<img src="{$HOST|cat:$curr.path_small}" border="0" width="{$curr.width_small}" height="{$curr.height_small}" />
		  			</a>
		    	{else}
		    		<a href="http://vd.recreator.ru/1961/index.php?mode=image&key_image_id={$curr.image_id}&pmode=image_list&cntonly=y" class="iframe">
		    			<img src="{$HOST|cat:$curr.path_orig}" border="0" />
		 			</a>
		    	{/if}*}
		    	{foreach from=$Field.sizes item=size key=sizekey}
		    		{if $curr[$size.tableFieldPath]}
			    		<div class="image-each-block">
			    			<img src="{$HOST|cat:$curr[$size.tableFieldPath]}" border="0" class="im" />
			    			<div class="icon-area">
			    				<div class="icon-block">
			    					<a href="#" onClick="if(confirm('{$lang.admin.askToDelImage}')){ldelim}document.forms['{$Config.ImageFormName}'].imageId.value='{$curr.id}';document.forms['{$Config.ImageFormName}'].fieldName.value='{$Field.name}';document.forms['{$Config.ImageFormName}'].tableName.value='{$Field.storeTable.tableName}';document.forms['{$Config.ImageFormName}'].tableInfoName.value='{$Field.storeTable.tableInfoName}';document.forms['{$Config.ImageFormName}'].tableKeyField.value='{$Field.storeTable.keyField}';document.forms['{$Config.ImageFormName}'].act.value='deleteimage';document.forms['{$Config.ImageFormName}'].submit();return false;{rdelim}else{ldelim}return false{rdelim}">
			    						<img src="{$HOST}{$Config.MainImageFolder}{$Config.adminImageFolder}{$Config.generalImageFolder}close_ico.png" width="20" height="20" title="{$lang.admin.deleteImage}" />
			   						</a>
			   					</div>
			    				<div class="icon-block hide-def">
			    					<a href="{$BaseURL}index.php?mode=image&key_image_id={$curr.id}&pmode=image_list&cntonly=y&iframe=true&width=600&height=550" rel="prettyPhoto" >
			    						<img src="{$HOST}{$Config.MainImageFolder}{$Config.adminImageFolder}{$Config.generalImageFolder}edit_ico.png" width="20" height="20" title="{$lang.admin.editImage}" />
			    					</a>
			   					</div>
	                            {*
			    				<div class="icon-block hide-def">
			    					<img src="{$HOST}{$Config.MainImageFolder}{$Config.adminImageFolder}{$Config.generalImageFolder}view_ico.png" width="20" height="20" title="{$lang.admin.viewImage}" />
			   					</div>
	                            *}
			    			</div>
			 			</div>
		 			{/if}
		    	{/foreach}
		    {/foreach}
		</div>
	{/if}
{/if}