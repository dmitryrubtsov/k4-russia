
{if $smarty.post.task eq 'html'}
<a href="{$Config.SiteForForumBlackSEO|unescape}link/{$SEOSubTheme.linkname}/said-m33_nv1_20{$Config.webPageFileType}" target="_blank"><img src="{$Config.RemoteImageServerForForumBlackSEO|unescape}ghealthlogo450.gif" border="0" class="linked-sig-image" /></a><br />
{section loop=6 start=1 step=1 name='iterator'}
<a href="{$Config.SiteForForumBlackSEO|unescape}link/{$SEOSubTheme.linkname}/{$smarty.section.iterator.index}_default{$Config.webPageFileType}" target="_blank">
 <img src="{$Config.RemoteImageServerForForumBlackSEO|unescape}imgm33_nv1_20/{$SEOSubTheme.linkname}/{$smarty.section.iterator.index}_default.png" border="0" class="linked-sig-image" />
</a>
<br />
{/section}

<br /><span style="font-size:10pt;line-height:100%"><span style="color:black"><b>&copy; {$smarty.now|date_format:"%Y"}, Trusted Pharmacy Reviews.</b></span></span><br />
{foreach from=$Keywords item="curr"}
<br />{$curr.keyword|unescape}
{/foreach}

{elseif $smarty.post.task eq 'BBCode'}
[url="{$Config.SiteForForumBlackSEO|unescape}link/{$SEOSubTheme.linkname}/said-m33_nv1_20{$Config.webPageFileType}"][img]{$Config.RemoteImageServerForForumBlackSEO|unescape}ghealthlogo450.gif[/img][/url]
{section loop=6 start=1 step=1 name='iterator'}
[url="{$Config.SiteForForumBlackSEO|unescape}link/{$SEOSubTheme.linkname}/{$smarty.section.iterator.index}_default{$Config.webPageFileType}"][img]{$Config.RemoteImageServerForForumBlackSEO|unescape}imgm33_nv1_20/{$SEOSubTheme.linkname}/{$smarty.section.iterator.index}_default.png[/img][/url]
{/section}

[b]&copy; {$smarty.now|date_format:"%Y"}, Trusted Pharmacy Reviews.[/b]

{foreach from=$Keywords item="curr"}
{$curr.keyword|unescape}
{/foreach}
{/if}