/*
 * DialogBox - simple plugin
 * Version: 1.0 (21/05/2010)
 * Copyright (c) 2010 Dmytro Feshchenko www.df-studio.net
 * Licensed under the MIT License: http://en.wikipedia.org/wiki/MIT_License
 * Requires: jQuery v1.3+ , PageShadow (pshadow.js)


 Example:

var PShad = new PageShadow({animation:{type:'slide',speed:200}});

var DialogBoxParams = {
	animation:{
		type:'fade',
		speed:500
	},
	pShadow:PShad,   PageShadow Object or null
	title:'Importent!'
};

var d = new DialogBox(DialogBoxParams);
d.show({body:'Are you good?',cssClass:'dialog3'});

*/

function DialogBox(settings)
{
  settings = settings || {};
  var _this;
  var _defaults = {
    style:{
	  	  width:'300px',

	  	  boxColor:'#FFFFFF',
	  	  boxBorder:'2px solid #109FED',
	  	  boxPadding:'1px',
	  	  boxElemPadding:'10px',
	  	  boxFont:'normal 11px tahoma',
	  	  boxFontColor:'#109FED',

	  	  titleColor:'#109FED',
	  	  titleFontColor:'#FFFFFF',
	  	  titleFont:'bold 12px tahoma',

	  	  shadowColor:'#000000',
	  	  shadowOpacity:'0.2',
	  	  shadowTop:'4px',
	  	  shadowLeft:'4px',

	  	  buttonColor:'#109FED',
	  	  buttonHoverColor:'#44B6F2',
	  	  buttonFontColor:'#FFFFFF',
	  	  buttonFont:'normal 11px tahoma',
	  	  buttonPadding:'3px 10px 3px 10px',
	  	  buttonMargin:'0px 5px 0px 5px'
    },
    cssClass:'',
    event:{    	resize:'DBResize'    },
    animation:{
    				zIndex:1000,
    				type:'show',  //  fade/slide/show
	    			speed:'300',
	    			showMethod:null,
	    			hideMethod:null
    },
    id:'dbox',
    subId:{box:'_bx',title:'_t',body:'_b',buttons:'_bt',shadow:'_sh'},
    title:'Attention!',
    body:'',
    buttons:{
  			ok:{
  				title:'OK',
  				onclick:function(){_this.hide()}
  			}
    }
  };

  var _cache = $.extend(true, {}, _defaults, settings);

  if(settings.pShadow != 'undefined' && !(settings.pShadow instanceof PageShadow))
  {
    _cache.pShadow = new PageShadow();
  }

  var _settings = {};

  var _init = function(params)
  {
    $.extend(true, _settings, _cache, params);
    this.id = {
    	main:_settings.id,
    	box:_settings.id+_settings.subId.box,
    	shadow:_settings.id+_settings.subId.shadow,
    	title:_settings.id+_settings.subId.title,
    	body:_settings.id+_settings.subId.body,
    	buttons:_settings.id+_settings.subId.buttons
    };
    _this = this;

    _create();
    _setStyle();
  };

  var _clientHeight = function()
  {
  	return document.compatMode=='CSS1Compat' && !window.opera?document.documentElement.clientHeight:document.body.clientHeight;
  };

  var _clientWidth = function()
  {
  	return document.compatMode=='CSS1Compat' && !window.opera?document.documentElement.clientWidth:document.body.clientWidth;
  };

  var _create = function()
  {
    if($("#"+_this.id.main).length > 0)
    {
      $("#"+_this.id.main).replaceWith('<div id="'+_this.id.main+'" />');
    }
    else
    {
      $("body").append('<div />').children('div:last').attr('id',_this.id.main);
    }
    $("#"+_this.id.main).append('<div />').children('div:last').attr('id',_this.id.shadow).attr('class',_this.id.shadow);
    $("#"+_this.id.main).append('<div />').children('div:last').attr('id',_this.id.box).attr('class',_this.id.box);
  	$("#"+_this.id.box).append('<div />').children('div:last').attr('id',_this.id.title).html(_settings.title).attr('class',_this.id.title);
  	$("#"+_this.id.box).append('<div />').children('div:last').attr('id',_this.id.body).html(_settings.body).attr('class',_this.id.body);
  	$("#"+_this.id.box).append('<div />').children('div:last').attr('id',_this.id.buttons).attr('class',_this.id.buttons);

  	for(i in _settings.buttons)
  	{
  	  $("#"+_this.id.buttons).append('<a />').children('a:last').click(_settings.buttons[i].onclick).html(_settings.buttons[i].title);
  	}
  };

  var _setStyle = function()
  {
    $("#"+_this.id.main).css({
  			zIndex:(_settings.animation.zIndex+1),
  			position:'fixed',
  			display:'none'
  			});
  	$("#"+_this.id.shadow).css({
  			zIndex:(_settings.animation.zIndex+2),
  			position:'fixed',
  			display:'none',
  			filter:'alpha(opacity='+_settings.style.shadowOpacity*100+')',
  			MozOpacity:_settings.style.shadowOpacity,
  			KhtmlOpacity:_settings.style.shadowOpacity,
		  	opacity:_settings.style.shadowOpacity
  			});
  	$("#"+_this.id.box).css({
  			zIndex:(_settings.animation.zIndex+3),
  			position:'fixed',
  			width:_settings.style.width,
  			display:'none'
  			});

    if(_settings.cssClass == '')
    {
  	  $("#"+_this.id.box).css({
  			background:_settings.style.boxColor,
  			border:_settings.style.boxBorder,
  			padding:_settings.style.boxPadding
  			});
  	  $("#"+_this.id.shadow).css({
  			background:_settings.style.shadowColor
  			});
  	  $("#"+_this.id.title).css({
  			font:_settings.style.titleFont,
  			color:_settings.style.titleFontColor,
  			background:_settings.style.titleColor,
  			padding:_settings.style.boxElemPadding
  			});
  	  $("#"+_this.id.body).css({
  			font:_settings.style.boxFont,
  			color:_settings.style.boxFontColor,
  			padding:_settings.style.boxElemPadding
  			});
  	  $("#"+_this.id.buttons).css({
  			textAlign:'center',
  			padding:_settings.style.boxElemPadding
  			});
  	  $("#"+_this.id.buttons+' a').css({
  			display:'inline-block',
  			padding:_settings.style.buttonPadding,
  			margin:_settings.style.buttonMargin,
  			cursor:'pointer',
  			background:_settings.style.buttonColor,
  			color:_settings.style.buttonFontColor,
  			font:_settings.style.buttonFont,
  			textDecoration:'none'
  			});
  	  $("#"+_this.id.buttons+' a').hover(function(){$(this).css({background:_settings.style.buttonHoverColor})}, function(){$(this).css({background:_settings.style.buttonColor})});
  	}
  	else
  	{
  	  $("#"+_this.id.main).addClass(_settings.cssClass);
  	}
  };

  this.hide = function()
  {
  	$("#"+_this.id.box).unbind();
  	if($.browser.msie)
  	{
  	  $('body').attr('scroll','auto');
  	}
  	_hideAnimation();
  	_settings.pShadow.hide();
  };

  this.show = function(params)
  {
  	_init.call(this,params);
  	if($.browser.msie)
  	{
  	  $("#"+_this.id.bg).css({position:'absolute'});
  	  $("#"+_this.id.shadow).css({position:'absolute'});
  	  $("#"+_this.id.main).css({position:'absolute'});
	  $("#"+_this.id.box).css({position:'absolute'});
  	  $('body').attr('scroll','no');
  	}

  	$("#"+_this.id.main).css({visibility:'hidden',display:'block'});

  	var Height = $("#"+_this.id.box).outerHeight();
  	var Width = $("#"+_this.id.box).outerWidth();
  	var Top = Math.round((_clientHeight()-Height)/2);
  	var Left = Math.round((_clientWidth()-Width)/2);
  	var ScrollTop = 0;
  	var ShadowTop = Top+parseInt(_settings.style.shadowTop);
  	var ShadowLeft = Left+parseInt(_settings.style.shadowLeft);

  	$("#"+_this.id.main).css({visibility:'visible',display:'none'});

  	if($.browser.msie)
  	{
  	  ScrollTop = document.body.scrollTop;
  	  ShadowTop = _settings.style.shadowTop;
  	  ShadowLeft = _settings.style.shadowLeft;
  	}

  	$("#"+_this.id.main).css({top:(Top+ScrollTop),left:Left});
  	$("#"+_this.id.bg).css({top:ScrollTop,left:0});
  	$("#"+_this.id.shadow).css({
  		top:ShadowTop,
  		left:ShadowLeft,
  		width:Width,
		height:Height
	});

  	$("#"+_this.id.main).show();
  	_settings.pShadow.show({zIndex:_settings.animation.zIndex});
  	_showAnimation();
  	$("#"+_this.id.box).bind(_settings.event.resize,function(){$('#'+_this.id.shadow).css({width:$(this).outerWidth(),height:$(this).outerHeight()})});
  };

  var _showAnimation = function()
  {
    if(_settings.animation.showMethod != null)
  	{
  	  _settings.animation.showMethod();
  	}
  	else
    {
      switch(_settings.animation.type)
  	  {
  	    case 'fade':
  	    			$("#"+_this.id.shadow).fadeIn(_settings.animation.speed);
  	  				$("#"+_this.id.box).fadeIn(_settings.animation.speed);
  	    			break;
  	    case 'slide':
  	    			$("#"+_this.id.shadow).slideDown(_settings.animation.speed);
  	  				$("#"+_this.id.box).slideDown(_settings.animation.speed);
  	    			break;
  	    case 'show':
  	    			$("#"+_this.id.shadow).show(_settings.animation.speed);
  	    			$("#"+_this.id.box).show(_settings.animation.speed);
  	    			break;
  	    default:
  	    			$("#"+_this.id.shadow).fadeIn('fast');
  	    			$("#"+_this.id.box).fadeIn('fast');
  	  }
  	}
  };

  var _hideAnimation = function()
  {
    if(_settings.animation.hideMethod != null)
  	{
  	  _settings.animation.hideMethod();
  	}
    else
    {
  	  switch(_settings.animation.type)
  	  {
  	    case 'fade':
  	    			$("#"+_this.id.shadow).fadeOut(_settings.animation.speed);
  	  				$("#"+_this.id.box).fadeOut(_settings.animation.speed);
  	    			break;
  	    case 'slide':
  	    			$("#"+_this.id.shadow).slideUp(_settings.animation.speed);
  	  				$("#"+_this.id.box).slideUp(_settings.animation.speed);
  	    			break;
  	    case 'show':
  	    			$("#"+_this.id.shadow).hide(_settings.animation.speed);
  	    			$("#"+_this.id.box).hide(_settings.animation.speed);
  	    			break;
  	    default:
  	    			$("#"+_this.id.shadow).fadeOut('fast');
  	    			$("#"+_this.id.box).fadeOut('fast');
  	  }
  	}
  };

  this.event = function(name)
  {
    $('#'+_this.id.box).trigger(_settings.event[name]);
  };
};