<select id="{$Field.id}" name="{$Field.name}"{if $Field.other neq ''} {$Field.other|unescape}{/if}>
 <option>{$lang.admin.browserNotHandleScript}</option>
</select>
<script language="javascript">
 var stList{$Field.id} = new Array();
 stList{$Field.id}[''] = new Array('{if $Field.emptyValue neq ''}{$Field.emptyValue}{else}{$lang.admin.noValues}{/if}','');
{foreach from=$Field.values item="current" key="key"}
 stList{$Field.id}['{$key}'] = new Array({foreach from=$current item="curr" key="subkey" name="sub"}'{$curr|unescape:"addslashes"}','{$subkey}'{if $smarty.foreach.sub.last eq ''},{/if}{foreachelse}'{$lang.admin.noValues}',''{/foreach});
{/foreach}

function init{$Field.id}()
{ldelim}
  optionTest{$Field.id} = true;
  lgth = document.getElementById('{$Field.id}').options.length - 1;
  document.getElementById('{$Field.id}').options[lgth] = null;
  if (document.getElementById('{$Field.id}').options[lgth]) optionTest = false;
  set{$Field.id}(document.getElementById('{$Field.parentID}').value);
{rdelim}

function set{$Field.id}(item)
{ldelim}
  if (!optionTest{$Field.id}) return;
  var box = document.getElementById('{$Field.parentID}');
  var number = box.options[box.selectedIndex].value;
  if (item) number = item;


  var list = stList{$Field.id}[number];
  var box2 = document.getElementById('{$Field.id}');
  box2.options.length = 0;
  for(i=0;i<list.length;i+=2)
  {ldelim}
    box2.options[i/2] = new Option(list[i],list[i+1]);
  {rdelim}
{if $Field.value neq ''}
  for(i=0;i<box2.options.length;i++)
  {ldelim}
    if(box2.options[i].value == '{$Field.value}')
    {ldelim}
      box2.options[i].selected = true;
    {rdelim}
  {rdelim}
{/if}
{if $Field.childID neq ''}
  set{$Field.childID}(box2.value);
{/if}

{rdelim}
init{$Field.id}();
</script>
