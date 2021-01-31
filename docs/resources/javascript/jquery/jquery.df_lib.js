/*
 * DFLib (for jQuery)
 * version: 1.2.2 (06/10/2010)
 * @requires jQuery v1.3 +
 *
 *
 *
 * Licensed under the MIT License: http://en.wikipedia.org/wiki/MIT_License
 *
 * Copyright (c) 2010 Dmytro Feshchenko www.df-studio.net
 *
 *
 */

;(function($) {

  $.dfLib = function(){};

  $.extend($.dfLib, {

    repeat: function(str,count)
    {
      var newStr = '';
      for(i=0;i<count;i++)
      {
        newStr += str;
      };
      return newStr;
    },
    position: function(elem)
	{
	  var prm = {
	    left:0,
	    top:0,
	    right:0,
	    bottom:0,
	    width:0,
	    height:0,
	    centerTop:0,
	    centerLeft:0
	  };
	  prm.width = elem.offsetWidth;
	  prm.height = elem.offsetHeight;
	  var elem1 = elem;
	  while (elem)
	  {
	    prm.left += elem.offsetLeft;
	    prm.top += elem.offsetTop;
	    elem = elem.offsetParent;
	  }
	  while (elem1.tagName !== undefined)
	  {
	    prm.left -= elem1.scrollLeft;
	    prm.top -= elem1.scrollTop;
	    elem1 = elem1.parentNode;
	  }
	  prm.left += $.dfLib.scrollLeft();
	  prm.top += $.dfLib.scrollTop();
	  prm.right = prm.left + prm.width;
	  prm.bottom = prm.top + prm.height;
	  prm.centerTop = prm.top + prm.height/2;
	  prm.centerLeft = prm.left + prm.width/2;
	  return prm;
	},
	scrollTop: function()
    {
	  return window.pageYOffset || (document.documentElement && document.documentElement.scrollTop) || (document.body && document.body.scrollTop);
    },
    scrollLeft: function()
    {
	  return window.pageXOffset || (document.documentElement && document.documentElement.scrollLeft) || (document.body && document.body.scrollLeft);
    },
	clientHeight: function()
    {
  	  return document.compatMode=='CSS1Compat' && !window.opera?document.documentElement.clientHeight:document.body.clientHeight;
    },
    clientWidth: function()
    {
  	  return document.compatMode=='CSS1Compat' && !window.opera?document.documentElement.clientWidth:document.body.clientWidth;
    },
    isEmpty: function(obj)
	{
	  if(!obj)return true;
	  if(typeof obj == 'string')
	  {
	    if(obj == '')return true;
	    return false;
	  }
	  else
	  {
	    for(i in obj)
	    {
	      if(typeof obj[i] != 'undefined')return false;
	    }
	    return true;
	  }
	},
    cloneObj:function(o)
    {
	  if(!o || "object" !== typeof o)
	  {
		return o;
	  }
	  var c = "function" === typeof o.pop ? [] : {};
	  var p, v;
	  for(p in o)
	  {
		if(o.hasOwnProperty(p))
		{
		  v = o[p];
		  if(v && "object" === typeof v)
		  {
			c[p] = $.dfLib.cloneObj(v);
		  }
		  else c[p] = v;
		}
	  }
	  return c;
    },
	showAnimation: function(elem, animation)
	{
	  if(animation.showMethod != null)
	  {
	    animation.showMethod();
	  }
	  else
	  {
	    switch(animation.type)
		  {
		    case 'fade':
		    			elem.fadeIn(animation.speed);
		    			break;
		    case 'slide':
		    			elem.slideDown(animation.speed);
		    			break;
		    case 'show':
		    			elem.show(animation.speed);
		    			break;
		    default:
		    			elem.fadeIn('fast');
		  }
		}
	},
	hideAnimation: function(elem, animation)
	{
	  if(animation.hideMethod != null)
	  {
	    animation.hideMethod();
	  }
	  else
	  {
		  switch(animation.type)
		  {
		    case 'fade':
		    			elem.fadeOut(animation.speed);
		    			break;
		    case 'slide':
		  				elem.slideUp(animation.speed);
		    			break;
		    case 'show':
		    			elem.hide(animation.speed);
		    			break;
		    default:
		    			elem.fadeOut('fast');
		  }
	  }
	}
  });
})(jQuery);