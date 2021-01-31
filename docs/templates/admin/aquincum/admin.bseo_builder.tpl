
<br /><br />
<center>
<form name="sitemap" method="post" action="">
<br />
<div class="item">
  {$lang.admin.type}:&nbsp;&nbsp;
  <select name="task">
   <option value="html"{if $smarty.post.task == 'html'} selected{/if}>HTML</option>
   <option value="BBCode"{if $smarty.post.task == 'BBCode'} selected{/if}>BBCode</option>
  </select>
</div>
<br />
<div class="item">
  {$lang.admin.text}:&nbsp;&nbsp;
  <select name="text">
   <option value="account"{if $smarty.post.text == 'account'} selected{/if}>Account</option>
   <option value="message"{if $smarty.post.text == 'message'} selected{/if}>Message</option>
  </select>
</div>
<br />
<div class="item">
  {$lang.admin.seo} {$lang.admin.subTheme}:&nbsp;&nbsp;
  {html_options name=seo_subtheme options=$SEOSubThemesSelect selected=$smarty.post.seo_subtheme}
</div>

<br />
<div class="item"><input type="submit" value="{$lang.admin.submitButton}" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="{$lang.admin.back}" onclick="document.location.href='{$BlankLink}';" /></div>
</form>
</center>

{if $smarty.post.task neq ''}
<b>{$lang.admin.message}</b><br /><br />
<textarea name="message" id="smap" style="width:500px;height:450px;">
{$Message|unescape}
</textarea>
{/if}

