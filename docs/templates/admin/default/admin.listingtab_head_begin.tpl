{if $NoUse.Nomer eq ''}
	<td>#</td>
{/if}
{if $NoUse.Checkbox eq ''}
	<td><input type="checkbox" onclick="checkItems(this.checked);" /></td>
{/if}
{if $NoUse.Edit eq '' || $NoUse.SaveButton eq '' || $NoUse.DeleteButton eq ''}
	<td></td>
{/if}