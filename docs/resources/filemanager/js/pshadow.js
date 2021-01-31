/*
 * PageShadow - simple plugin
 * Version: 1.0 (26/05/2010)
 * Copyright (c) 2010 Dmytro Feshchenko www.df-studio.net
 * Licensed under the MIT License: http://en.wikipedia.org/wiki/MIT_License
 * Requires: jQuery v1.3+


Example:

var bg = new PageShadow({animation:{type:'show',speed:200}});
var bg2 = new PageShadow();
bg.show();
bg.show({type:'slideDown',speed:500,zIndex:100});
bg2.show();

*/

function PageShadow(settings)
{
  var _defaults = {
    style:{
	  	  background:'#000000',
	  	  opacity:'0.2'
    },
    cssClass:'',
    animation:{
    				zIndex:1000,
    				type:'fade',  //  fade/slide/show
	    			speed:'fast',
	    			showMethod:null,
	    			hideMethod:null
    },
    id:'pageshadow'
  };

  var _settings = $.extend(true, {}, _defaults, settings);

  var _create = function()
  {
    if(!$("#"+_settings.id).length)
    {
      $("body").append('<div />').children('div:last').attr('id',_settings.id);
    }
    if(_settings.cssClass)
    {
      $("#"+_settings.id).attr('class',_settings.cssClass);
    }
    else
    {
      $("#"+_settings.id).css({
  			background:_settings.style.background,
  			filter:'alpha(opacity='+_settings.style.opacity*100+')',
  			MozOpacity:_settings.style.opacity,
  			KhtmlOpacity:_settings.style.opacity,
		  	opacity:_settings.style.opacity
  			});
  	}
  	$("#"+_settings.id).css({
  			position:'fixed',
  			display:'none',
  			height:'100%',
  			width:'100%'
  			});
  };

  this.hide = function(animation)
  {
  	if($.browser.msie)
  	{
  	  $('body').attr('scroll','auto');
  	}
  	_hideAnimation(animation);
  };

  this.show = function(animation)
  {
  	_create();
  	var ScrollTop = 0;
  	if($.browser.msie)
  	{
  	  $("#"+_settings.id).css({position:'absolute'});
  	  $('body').attr('scroll','no');
  	  ScrollTop = document.body.scrollTop;
  	}
  	$("#"+_settings.id).css({top:ScrollTop,left:0});
  	_showAnimation(animation);
  };

  var _showAnimation = function(animationObj)
  {
    var animation = $.extend(true, {}, _settings.animation, animationObj);
    $("#"+_settings.id).css({zIndex:animation.zIndex});
    if(animation.showMethod != null)
  	{
  	  animation.showMethod();
  	}
  	else
  	{
  	  switch(animation.type)
  	  {
  	    case 'fade': $("#"+_settings.id).fadeIn(animation.speed);break;
  	    case 'slide': $("#"+_settings.id).slideDown(animation.speed);break;
  	    case 'show': $("#"+_settings.id).show(animation.speed);break;
  	    default: $("#"+_settings.id).fadeIn('fast');
  	  }
  	}
  };

  var _hideAnimation = function(animationObj)
  {
    var animation = $.extend(true, {}, _settings.animation, animationObj);
    if(animation.hideMethod != null)
  	{
  	  animation.hideMethod();
  	}
  	else
  	{
  	  switch(animation.type)
  	  {
  	    case 'fade': $("#"+_settings.id).fadeOut(animation.speed);break;
  	    case 'slide': $("#"+_settings.id).slideUp(animation.speed);break;
  	    case 'show': $("#"+_settings.id).hide(animation.speed);break;
  	    default: $("#"+_settings.id).fadeOut('fast');
  	  }
  	}
  };
}