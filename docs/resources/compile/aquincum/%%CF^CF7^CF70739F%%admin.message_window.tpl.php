<?php /* Smarty version 2.6.16, created on 2014-03-21 19:37:53
         compiled from admin.message_window.tpl */ ?>
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
function MessageGetClientWidth()
{
  return document.compatMode=='CSS1Compat' && !window.opera?document.documentElement.clientWidth:document.body.clientWidth;
}
function MessageGetClientHeight()
{
  return document.compatMode=='CSS1Compat' && !window.opera?document.documentElement.clientHeight:document.body.clientHeight;
}
function showMessage(id)
{
 initMessage(id);
  document.getElementById('message-div').className='message-show';
 document.getElementById('message-shadow').className='message-show-shadow';
 document.getElementById('message-tab').setAttribute("width", "300");
 document.getElementById('message-div').style.top=(MessageGetClientHeight()-document.getElementById('message-tab').offsetHeight)/2+document.body.scrollTop-100;
 document.getElementById('message-div').style.left=(MessageGetClientWidth()-document.getElementById('message-tab').offsetWidth)/2+document.body.scrollLeft;
 document.getElementById('message-shadow').style.top=(MessageGetClientHeight()-document.getElementById('message-tab').offsetHeight)/2+document.body.scrollTop-95;
 document.getElementById('message-shadow').style.left=(MessageGetClientWidth()-document.getElementById('message-tab').offsetWidth)/2+document.body.scrollLeft+5;
 document.getElementById('message-tab-shadow').setAttribute("width", document.getElementById('message-tab').getAttribute("width"));
 document.getElementById('message-tab-shadow').setAttribute("height", document.getElementById('message-tab').offsetHeight);
}
function hideMessage()
{
  document.getElementById('message-div').className='message-hid';
 document.getElementById('message-shadow').className='message-hid';
}
function initMessage(id)
{
  document.getElementById('mes-message').innerHTML=document.getElementById(id+'-message').innerHTML;
  document.getElementById('mes-buttons').innerHTML=document.getElementById(id+'-buttons').innerHTML;
  document.getElementById('mes-title').innerHTML=document.getElementById(id+'-title').innerHTML;
}
</script>