{html_radios name=$Field.name options=$Field.values selected=$Field.value separator="&nbsp;&nbsp;"}{if $Field.textUnderField}<br /><sup>{$Field.textUnderField|unescape}</sup>{/if}</label>