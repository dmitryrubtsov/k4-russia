<hr />
    <input type="file" name="{$Field.name}" value="" />
{if $Item[$Field.name]}
    {assign var='imarray' value=$Item[$Field.name]}

    {foreach from=$imarray.files item=curr key=key}
        <div class="wrapper-file">
            <a  href="{$HOST}/{$curr.path}" class="wrraper-title-file">{$curr.file_name}</a>
            <a href="#" onClick="if(confirm('{$lang.admin.askToDelFile}'))
                   {ldelim}
                        document.forms['{$Config.ImageFormName}'].imageId.value='{$curr.file_id}';
                        document.forms['{$Config.ImageFormName}'].fieldName.value='{$Field.name}';
                        document.forms['{$Config.ImageFormName}'].dirName.value='{$curr.path}';
                        document.forms['{$Config.ImageFormName}'].act.value='deletefile';
                        document.forms['{$Config.ImageFormName}'].submit();
                   {rdelim}
                    else{ldelim}return false{rdelim}" class="delete-img" title="{$lang.admin.delete}"></a>
        </div>
    {/foreach}
{/if}
<hr />