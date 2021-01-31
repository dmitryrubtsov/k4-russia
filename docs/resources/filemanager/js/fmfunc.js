/*
 * DF-FileManager
 * Version: 1.1 (8/02/2011)
 * Copyright (c) 2011 Dmytro Feshchenko www.df-studio.net
 * Licensed under the MIT License: http://en.wikipedia.org/wiki/MIT_License
*/

$.fn.gpos = function()
{
  var prm = $.extend({
   left:0,
   top:0,
   right:0,
   bottom:0,
   width:0,
   height:0
   });

  elem = this.get(0);
  prm.width = elem.offsetWidth;
  prm.height = elem.offsetHeight;
  while (elem)
  {
    prm.left += elem.offsetLeft;
    prm.top += elem.offsetTop;
    elem = elem.offsetParent;
  }
  prm.right = prm.left + prm.width;
  prm.bottom = prm.top + prm.height;
  return prm;
};

function makeAction(paramObj,method)
{
  if(typeof method == 'undefined')method='post';
  $("body").append('<form />');
  $("body").children('form:last').attr('method',method);
  for(key in paramObj)
  {
    $("body").children('form:last').append('<input type="hidden" />');
    $("body").children('form:last').children('input:last').attr('name',key).val(paramObj[key]);
  }
  $("body").children('form:last').get(0).submit();
}

function createFolder()
{
	animation:{
		zIndex:20
	},
	title:dboxLang.createFolder,
	body:$('#create_folder_div').html(),
	buttons:{
		ok:{
			title:dboxLang.create,
			onclick:function(){
				var prm={};
				prm[$.config.pf] = $('#'+dbox.id.body+' :text:first-child').val();
				prm[$.config.pa] = $.config.aa;
				if(prm[$.config.pf])
				{
				  act.go({post:prm});
				  dbox.hide();
				}
				else
				{
				  $('#'+dbox.id.body+' div.error').slideDown(300,function(){dbox.event('resize')});
				  if($.browser.opera)
				  {
				    setTimeout(function(){dbox.event('resize')},400);
				  }
				}
			}
		},
		cancel:{
			title:dboxLang.cancelButton,
			onclick:function(){
				dbox.hide();
			}
		}
	}
	});
}

function uploadFile()
{
	animation:{
		zIndex:20
	},
	title:dboxLang.uploadFile,
	body:$('#upload_file_div').html(),
	buttons:{
		ok:{
			title:dboxLang.upload,
			onclick:function(){
				var form = $('#'+dbox.id.body+' form:first-child').get(0);
				var prm={};
				prm[$.config.pa] = $.config.aa;
				if($(form).find(":file:first").val())
				{
				  act.go({form:form,post:prm});
				  dbox.hide();
				}
				else
				{
				  $('#'+dbox.id.body+' div.error').slideDown(300,function(){dbox.event('resize')});
				  if($.browser.opera)
				  {
				    setTimeout(function(){dbox.event('resize')},400);
				  }
				}
			}
		},
		cancel:{
			title:dboxLang.cancelButton,
			onclick:function(){
				dbox.hide();
			}
		}
	}
	});
}

function makeLink(path)
{
  return link.replace('//','/');
}

function getFile(link)
{
  if(window.opener)
  {
  	{
  		window.opener[$.config.cbfn].call(null,link);
  	}
  	else if(window.opener.CKEDITOR)
  	{
  		window.opener.CKEDITOR.tools.callFunction($.config.efn, link);
  		window.close();
  		window.opener.focus();
  	}
  }
  else
  {
  }
}

$(document).ready(function () {
$("a.lang").bind("click",function(){var get={};get[$.config.lng]=$(this).attr('id');act.go({get:get});});
$("#filter").bind("change",function(){var get={};get[$.config.cflt]=$(this).val();get[$.config.flt]=$(this).val();act.go({get:get});});
$("td.file").bind("click", function(){if($(this).attr('f') != ''){var link = makeLink($(this).attr('f'));getFile(link);}});
$("a.viewf").bind("click", function(){if($(this).attr('f') != ''){var link = makeLink($(this).parent().prevAll("td.file").attr('f'));var wnd=window.open(link, link,"menubar=no,location=no,resizable=yes,scrollbars=auto,status=no");}});
$("#path a").bind("click", function(){if($(this).attr('f') != ''){var prm={};prm[$.config.gp]=$(this).attr('f');act.go({get:prm});}});
$("a.delf").bind("click", function(){
	$.config.dbox.show({
        buttons:{
        		onclick:function(){
					{
						var prm={};
						prm[$.config.pa]=$.config.adf;
						prm[$.config.pf]=$(_this).parent().prevAll("td.file").attr('f');
						act.go({post:prm});
					}
        			$.config.dbox.hide();
        		}
        	cancel:{
        		title:$.config.dboxLang.cancelButton,
        		onclick:function(){$.config.dbox.hide();}
        	}
	});
});
$("a.delfd").bind("click", function(){
	$.config.dbox.show({
		body:$.config.dboxLang.askDelFolder,
        buttons:{
        	ok:{
        		title:$.config.dboxLang.okButton,
        		onclick:function(){
        			if($(_this).parent().prevAll("td.folder").attr('f') != '')
        			{
						var prm={};
						prm[$.config.pa]=$.config.adfd;
						prm[$.config.pf]=$(_this).parent().prevAll("td.folder").attr('f');
						act.go({post:prm});
					}
        			$.config.dbox.hide();
        		}
        	},
        	cancel:{
        		title:$.config.dboxLang.cancelButton,
        		onclick:function(){$.config.dbox.hide();}
        	}
        }
	});
});
});