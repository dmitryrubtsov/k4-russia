<style type="text/css">
div.main
{ldelim}
  padding: 15px;
{rdelim}

div.text
{ldelim}
  padding: 10px;
{rdelim}

div.error
{ldelim}
  padding: 10px;
  color: red;
  font-weight: bold;
{rdelim}

textarea.code
{ldelim}
  border: 1px solid red;
{rdelim}

</style>

<div class="main">
 {if $AudioInfo.is_img eq 'yes'}
  <div class="text">{$lang.admin.getCodeAudioArticle}</div>
  <textarea cols='60' rows='15' class="code">
    <object height=37 width=250><PARAM NAME="movie" value="{$HOST}/{$Config.AudioFileFolder}ump3player_500x70.swf"><param name="wmode" value="transparent"><param name=FlashVars value="way={$HOST}/{$Config.AudioFileFolder}{$AudioInfo.id}{$Config.mp3FileType}&amp;swf={$HOST}/{$Config.AudioFileFolder}ump3player_500x70.swf&amp;w=250&amp;h=37&amp;time_seconds=0&amp;autoplay=0&amp;q=&amp;skin={$Config.AudioPlayerColor}&amp;volume=100&amp;comment="><embed src="{$HOST}/{$Config.AudioFileFolder}ump3player_500x70.swf" type="application/x-shockwave-flash" wmode="transparent"  flashvars="way={$HOST}/{$Config.AudioFileFolder}{$AudioInfo.id}{$Config.mp3FileType}&amp;swf={$HOST}/{$Config.AudioFileFolder}ump3player_500x70.swf&amp;w=250&amp;h=37&amp;time_seconds=0&amp;autoplay=0&amp;q=&amp;skin={$Config.AudioPlayerColor}&amp;volume=100&amp;comment=" width="250" height="37"></embed></object>
  </textarea>
 {else}
  <div class="error">{$lang.admin.haveNotAudioFile}</div>
 {/if}
</div>