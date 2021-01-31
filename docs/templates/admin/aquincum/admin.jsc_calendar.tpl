{include file="admin.header.tpl"}

{assign var="cdefix" value="jsc_"}
<script language="JavaScript">
<!--
function today()
{ldelim}
  var time=new Date();
  var year=time.getFullYear();
  var month=time.getMonth();
  var day=time.getDate();
  document.all.{$cdefix}year.innerHTML=year;
  document.all.{$cdefix}mon.innerHTML=strmon(month);
  document.getElementById('{$cdefix}m').value=month;
  time_get(year,month);
{rdelim}
function year(i,v)
{ldelim}
  var year=document.all.{$cdefix}year.innerHTML;
  if(i>0)
  {ldelim}	year++;
  {rdelim}
  else
  {ldelim}
	year--;
  {rdelim}
  document.all.{$cdefix}year.innerHTML=year;
  if(v==0)
  {ldelim}
	var m=document.getElementById('{$cdefix}m').value;
	time_get(year,m);
  {rdelim}
{rdelim}
function strmon(m)
{ldelim}
  var mon;
  if(m==0)mon='{$MONTHS.01}';
  else if(m==1)mon='{$MONTHS.02}';
  else if(m==2)mon='{$MONTHS.03}';
  else if(m==3)mon='{$MONTHS.04}';
  else if(m==4)mon='{$MONTHS.05}';
  else if(m==5)mon='{$MONTHS.06}';
  else if(m==6)mon='{$MONTHS.07}';
  else if(m==7)mon='{$MONTHS.08}';
  else if(m==8)mon='{$MONTHS.09}';
  else if(m==9)mon='{$MONTHS.10}';
  else if(m==10)mon='{$MONTHS.11}';
  else if(m==11)mon='{$MONTHS.12}';
  return mon;
{rdelim}
function month(i)
{ldelim}
  var m=document.getElementById('{$cdefix}m').value;
  if(i>0)
  {ldelim}
  	m++;
  	if(m>11)
  	{ldelim}
  	  m=0;
  	  year(1,1);
  	{rdelim}
  {rdelim}
  else
  {ldelim}
  	m--;
  	if(m<0)
  	{ldelim}
  	  m=11;
  	  year(-1,1);
  	{rdelim}
  {rdelim}
  document.all.{$cdefix}mon.innerHTML=strmon(m);
  document.getElementById('{$cdefix}m').value=m;
  var y=document.all.{$cdefix}year.innerHTML;
  time_get(y,m);
{rdelim}
function getdayinmon(year,mon)
{ldelim}
  D=year%4==0&&(year%100!=0||year%400==0);
  dayInMonth=[31,28+D,31,30,31,30,31,31,30,31,30,31];
  return (dayInMonth[mon]);
{rdelim}
function time_get()
{ldelim}
  var year = time_get.arguments[0];
  var m = time_get.arguments[1];
  var Sdate = time_get.arguments[2];
  var day=new Date();
  var today=day.getDate();
  var todayyear=day.getFullYear();
  var todaymonth=day.getMonth();
  day.setDate(1);
  day.setMonth(m);
  day.setFullYear(year);
  var d=day.getDay();
  for(var i=0;i<7;i++)
  {ldelim}
  	for(j=1;j<7;j++)
  	{ldelim}
	  document.getElementById('{$cdefix}'+j+'_'+i).innerHTML='&nbsp;';
	  document.getElementById('{$cdefix}'+j+'_'+i).className='day';
	{rdelim}
  {rdelim}

  var j=1;
  for(var i=1;i<=getdayinmon(year,m);i++)
  {ldelim}
	if(i==today&&todayyear==year&&todaymonth==m)
	{ldelim}
	  document.getElementById('{$cdefix}'+j+'_'+d).className='currday';
	{rdelim}

	document.getElementById('{$cdefix}'+j+'_'+d).innerHTML='<a href="javascript:setdate('+i+');">'+i+'</a>';
    if(d==6)
    {ldelim}
      j++;
    {rdelim}
    d++;
    if(d>6)
    {ldelim}
      d=0;
    {rdelim}
  {rdelim}
{rdelim}
function showCalendar()
{ldelim}
  var x = showCalendar.arguments.length;
  if(x > 0)
  {ldelim}
    var Sdate = showCalendar.arguments[0];
    var SYear=Sdate.substring(0,4);
    var SMonth=parseInt(Sdate.substring(5,7))-1;
    document.all.{$cdefix}year.innerHTML=SYear;
    document.all.{$cdefix}mon.innerHTML=strmon(SMonth);
    document.getElementById('{$cdefix}m').value=SMonth;
    time_get(SYear,SMonth,Sdate);
  {rdelim}
  else
  {ldelim}
    today();
  {rdelim}  document.getElementById('calendar').style.visibility='visible';
  document.getElementById('calendar').style.zIndex=5;
{rdelim}
-->
</script>

<div id="calendar" class="vishid">
<table class="calendar">
 <tr>
  <td colspan="3" class="title">{$lang.calendar|capitalize}</td>
 </tr>
 <tr>
  <td class="nav">
   <a href="javascript:year(-1,0);"><<</a>
  </td>
  <td class="year">
   <span id="{$cdefix}year"></span>
  </td>
  <td class="nav">
   <a href="javascript:year(1,0);">>></a>
  </td>
 </tr>
 <tr>
  <td class="nav">
   <a href="javascript:month(-1);"><<</a>
  </td>
  <td class="month">
   <input type="hidden" id="{$cdefix}m" name="{$cdefix}m">
   <span id="{$cdefix}mon"></span>
  </td>
  <td class="nav">
   <a href="javascript:month(1);">>></a>
  </td>
 </tr>
 <tr>
  <td colspan="3" class="days">
   <table class="daystab">
   <tr>
    {foreach from=$DAYSOFWEEK item=curr key=key}
     <td class="dow">{$curr|truncate:3:"":true}</td>
    {/foreach}
   </tr>
   {section name=foo start=1 loop=7 step=1}
   <tr>
    {foreach from=$DAYSOFWEEK item=curr key=key}<td id="{$cdefix}{$smarty.section.foo.index}_{$key}"></td>{/foreach}
   </tr>
   {/section}
   </table>
  </td>
 </tr>
</table>
</div>


<br /><br /><br /><br /><br /><br /><br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:showCalendar('2006-10-12');">Cal</a>


{include file="admin.footer.tpl"}