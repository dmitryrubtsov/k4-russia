{assign var="cost" value=$POST.cost}

<div id="contract_mail">
<div class="article">{eval var=$NeedArticles[74].$Fbody|unescape}</div>

<p>
  <div class="cont_title"><b>{$lang.user.firstname}, {$lang.site.patientLastnameContract|lower}, {$lang.site.patientBirthdateFormString|lower}</b></div>
  <div class="cont_value">&nbsp;&nbsp;{$POST.name} {$POST.lastname}, {$POST.birthDay}.{$POST.birthMonth}.{$POST.birthYear}</div>
</p>
<p>
  <div class="cont_title"><b>{$lang.site.patientAddress}</b></div>
  <div class="cont_value">&nbsp;&nbsp;{$POST.address}</div>
</p>
<p>
  <div class="cont_title"><b>{$lang.site.patientDiagnosisContract}</b></div>
  <div class="cont_value">&nbsp;&nbsp;{$POST.diagnosis}</div>
</p>

<div class="article">{eval var=$NeedArticles[75].$Fbody|unescape}</div>
<div style="text-align:right">
	{if $POST.agreename || $POST.agreelastname}
		{$POST.agreename} {$POST.agreelastname}
	{else}
		{$POST.name} {$POST.lastname}
	{/if}
</div>
<div class="date">{$lang.site.contractSendDate}: {$smarty.now|date_format:"%d.%m.%Y    %H:%M"}</div>
</div>