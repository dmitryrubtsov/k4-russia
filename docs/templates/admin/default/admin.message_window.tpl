<div class="message-hid" id="message-div">
 <table class="message-tab" id="message-tab">
  <tr>
   <td class="head"><div id="mes-title"></div></td>
  </tr>
  <tr>
   <td><div id="mes-message"></div></td>
  </tr>
  <tr>
   <td class="buttons"><div id="mes-buttons"></div></td>
  </tr>
 </table>
</div>
<div class="message-hid" id="message-shadow">
 <table class="message-shadow" id="message-tab-shadow">
  <tr>
   <td>&nbsp;</td>
  </tr>
 </table>
</div>
<div class="deactivate" id="busy_layer"></div>
<script language="javascript">
{*
function showBusyLayer()
{ldelim}
  var busyLayer = document.getElementById('busy_layer');
  if (window.innerHeight && window.scrollMaxY)
  {ldelim}
    yScroll = window.innerHeight + window.scrollMaxY;
    var deff = document.documentElement;
    var hff = (deff&&deff.clientHeight) || document.body.clientHeight || window.innerHeight || self.innerHeight;
    yScroll -= (window.innerHeight - hff);
  {rdelim}
  else if (document.body.scrollHeight > document.body.offsetHeight || document.body.scrollWidth > document.body.offsetWidth)
  {ldelim}
    yScroll = document.body.scrollHeight;
  {rdelim}
  else
  {ldelim}
    yScroll = document.body.offsetHeight;
  {rdelim}
  if (busyLayer != null)
  {ldelim}
    busyLayer.style.height = yScroll;
    busyLayer.className='deactivate-act';
  {rdelim}
{rdelim}
*}
function MessageGetClientWidth()
{ldelim}
  return document.compatMode=='CSS1Compat' && !window.opera?document.documentElement.clientWidth:document.body.clientWidth;
{rdelim}
function MessageGetClientHeight()
{ldelim}
  return document.compatMode=='CSS1Compat' && !window.opera?document.documentElement.clientHeight:document.body.clientHeight;
{rdelim}
function showMessage(id)
{ldelim}
 initMessage(id);
 {*showBusyLayer();*}
 document.getElementById('message-div').className='message-show';
 document.getElementById('message-shadow').className='message-show-shadow';
 document.getElementById('message-tab').setAttribute("width", "300");
 document.getElementById('message-div').style.top=(MessageGetClientHeight()-document.getElementById('message-tab').offsetHeight)/2+document.body.scrollTop-100;
 document.getElementById('message-div').style.left=(MessageGetClientWidth()-document.getElementById('message-tab').offsetWidth)/2+document.body.scrollLeft;
 document.getElementById('message-shadow').style.top=(MessageGetClientHeight()-document.getElementById('message-tab').offsetHeight)/2+document.body.scrollTop-95;
 document.getElementById('message-shadow').style.left=(MessageGetClientWidth()-document.getElementById('message-tab').offsetWidth)/2+document.body.scrollLeft+5;
 document.getElementById('message-tab-shadow').setAttribute("width", document.getElementById('message-tab').getAttribute("width"));
 document.getElementById('message-tab-shadow').setAttribute("height", document.getElementById('message-tab').offsetHeight);
{rdelim}
function hideMessage()
{ldelim}
 {*document.getElementById('busy_layer').className='deactivate';*}
 document.getElementById('message-div').className='message-hid';
 document.getElementById('message-shadow').className='message-hid';
{rdelim}
function initMessage(id)
{ldelim}
  document.getElementById('mes-message').innerHTML=document.getElementById(id+'-message').innerHTML;
  document.getElementById('mes-buttons').innerHTML=document.getElementById(id+'-buttons').innerHTML;
  document.getElementById('mes-title').innerHTML=document.getElementById(id+'-title').innerHTML;
{rdelim}
</script>