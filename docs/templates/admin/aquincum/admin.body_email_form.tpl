{php}
$FieldSubject = array(
						'name' => 'subject',
						'maxlength' => 100,
						'size' => 46,
						'value' => $_POST['subject'],
);
$FieldText = array(
						'name' => 'text',
						'value' => $_POST['text'],
);

$this->assign('FieldSubject',$FieldSubject);
$this->assign('FieldText',$FieldText);

{/php}
<form method="post" action="" name="{$Config.AddFormName}">
<table class="item">
 <tr><td class="itemtd">
   <table>
        <tr>
          <td class="title">{$lang.admin.subject}&nbsp;<span class="required">*</span></td>
          <td class="field">
          {include file="admin.field_input.tpl" Field=$FieldSubject}
          </td>
        </tr>
        <tr>
          <td class="title">{$lang.admin.text}&nbsp;<span class="required">*</span></td>
          <td class="field">
          {include file="admin.field_fckeditor.tpl" Field=$FieldText}
		  </td>
        </tr>
    <tr>
      <td colspan=2 class="submit">
       {foreach from=$EmailFormButtons item="curr" key="key"}
           {if $curr.newRow neq ''}<br /><br />{/if}
         	<input class="{if $curr.cssClass neq ''}{$curr.cssClass}{else}button{/if}" type="button" value="{$curr.value}" onclick="{eval var=$curr.onclick|unescape}" />
       {/foreach}

                        </td>
    </tr>
  </table>
 </td></tr>
</table>

</form>