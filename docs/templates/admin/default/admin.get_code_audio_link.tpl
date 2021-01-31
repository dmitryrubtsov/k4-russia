<style type="text/css">
div.main
{ldelim}
  padding: 15px;
{rdelim}

div.text
{ldelim}
  padding: 10px;
{rdelim}

div.tooltip
{ldelim}
  padding: 5px 0;
{rdelim}

div.error
{ldelim}
  padding: 10px;
  color: red;
  font-weight: bold;
{rdelim}

div.result
{ldelim}
{rdelim}

textarea.code
{ldelim}
  border: 1px solid red;
{rdelim}

</style>


<div class="main">
 {if $needBlock eq 'error'}
 <div class="error">{$lang.admin.writeLinkCorrect}</div>
 {/if}
 <div class="tooltip">{$lang.admin.writeLinkInField}</div>
 <div class="query">
  <form method="post" action="" name="get_link">
   <input type="hidden" name="task" value="send">
   <input type="text" name="link" size="70" />
   <br /><br />
   <input type="submit" value="{$lang.admin.submitButton}" onclick="document.forms['get_link'].submit();" />
  </form>
 </div>
 {if $needBlock eq 'block'}
 <div class="result" id="block">
  <textarea cols='60' rows='15' class="code">
    <object height=37 width=250><PARAM NAME="movie" value="{$HOST}/{$Config.AudioFileFolder}ump3player_500x70.swf"><param name="wmode" value="transparent"><param name=FlashVars value="way={$smarty.post.link}&amp;swf={$HOST}/{$Config.AudioFileFolder}ump3player_500x70.swf&amp;w=250&amp;h=37&amp;time_seconds=0&amp;autoplay=0&amp;q=&amp;skin={$Config.AudioPlayerColor}&amp;volume=100&amp;comment="><embed src="{$HOST}/{$Config.AudioFileFolder}ump3player_500x70.swf" type="application/x-shockwave-flash" wmode="transparent"  flashvars="way={$smarty.post.link}&amp;swf={$HOST}/{$Config.AudioFileFolder}ump3player_500x70.swf&amp;w=250&amp;h=37&amp;time_seconds=0&amp;autoplay=0&amp;q=&amp;skin={$Config.AudioPlayerColor}&amp;volume=100&amp;comment=" width="250" height="37"></embed></object>
  </textarea>
 </div>
 {/if}
</div>