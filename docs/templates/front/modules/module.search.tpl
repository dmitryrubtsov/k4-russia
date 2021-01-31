<form action="" id="cse-search-box">
  <div>
    <input type="hidden" name="cx" value="{$GoogleSearchKey}" />
    <input type="hidden" name="cof" value="FORID:10" />
    <input type="hidden" name="ie" value="UTF-8" />
    <input type="text" name="q" size="31" value="{$smarty.get.q|unescape}" />
    <input type="submit" name="sa" value="{$lang.search.search}" />
  </div>
</form>
{if $smarty.get.q neq '' && $smarty.get.cx eq ''}
<script type="text/javascript">
$('#cse-search-box').submit();
</script>
{/if}


{literal}
<div id="cse-search-results"></div>
<script type="text/javascript">
  var googleSearchIframeName = "cse-search-results";
  var googleSearchFormName = "cse-search-box";
  var googleSearchFrameWidth = 800;
  var googleSearchDomain = "www.google.com";
  var googleSearchPath = "/cse";
</script>
<script type="text/javascript" src="http://www.google.com/afsonline/show_afs_search.js"></script>
<script type="text/javascript">
$('#cse-search-results').find('iframe').width('600px');
</script>
{/literal}