<hr />
    <input type="file" name="{$Field.name}[]" value="" multiple=""/>
{if $Item[$Field.name]}
    {assign var='imarray' value=$Item[$Field.name]}

    <div class="wrapper-file">
    <table>
    {foreach from=$imarray.files item=curr key=key}
                <tr>
                    <td>
                        <a  href="{$HOST}/{$curr.path}" class="wrraper-title-file">{$curr.file_name}</a>
                    </td>
                    <td>
                        <a href="#" onClick="if(confirm('{$lang.admin.askToDelFile}'))
                                {ldelim}
                                document.forms['{$Config.ImageFormName}'].imageId.value='{$curr.file_id}';
                                document.forms['{$Config.ImageFormName}'].fieldName.value='{$Field.name}';
                                document.forms['{$Config.ImageFormName}'].dirName.value='{$curr.path}';
                                document.forms['{$Config.ImageFormName}'].act.value='deletefile';
                                document.forms['{$Config.ImageFormName}'].submit();
                        {rdelim}
                                else{ldelim}return false{rdelim}" class="delete-img" title="{$lang.admin.delete}">
                            <img src="{$HOST}{$Config.MainImageFolder}{$Config.adminImageFolder}{$Config.generalImageFolder}close_ico.png" width="20" height="20" title="{$lang.admin.deleteImage}" style="width: 20px;top:0px; position: absolute; margin-left: 10px;"/>
                        </a>
                    </td>
                </tr>
    {/foreach}
    </table>
    </div>
{/if}
