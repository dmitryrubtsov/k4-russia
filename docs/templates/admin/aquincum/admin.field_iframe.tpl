<iframe name="{$Field.name}" id="{$Field.id}" src="{$Field.src|unescape}" width="{if $Field.width neq ''}{$Field.width}{else}20{/if}" height="{if $Field.height neq ''}{$Field.height}{else}20{/if}" align="{if $Field.align neq ''}{$Field.align}{else}left{/if}" frameborder="{if $Field.frameborder neq ''}{$Field.frameborder}{else}no{/if}" scrolling="{if $Field.scrolling neq ''}{$Field.scrolling}{else}auto{/if}"{if $Field.resizeToChildParams neq ''} onload="resize{$Field.id}iframe();"{/if}></iframe>
{if $Field.JSfunction neq ''}
<script language="javascript">
{$Field.JSfunction|unescape}
</script>
{/if}
{if $Field.resizeToChildParams neq ''}
<script language="javascript">
function resize{$Field.id}iframe()
{ldelim}
document.getElementById('{$Field.id}').style.height=document.getElementById('{$Field.id}').contentDocument.body.offsetHeight+'px';
document.getElementById('{$Field.id}').style.width=document.getElementById('{$Field.id}').contentDocument.body.scrollWidth+'px';
setTimeout('resize{$Field.id}iframe();',100);
{rdelim}
</script>
{/if}