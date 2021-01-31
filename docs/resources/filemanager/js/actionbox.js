/*
 * ActionBox - simple plugin for send data by POST/GET
 * Version: 1.0 (28/05/2010)
 * Copyright (c) 2010 Dmytro Feshchenko www.df-studio.net
 * Licensed under the MIT License: http://en.wikipedia.org/wiki/MIT_License
 * Requires: jQuery v1.3+


 Example:

var goAddFunc = function()
{
  alert("Sending");
}
var act = new ActionBox({goAddFunc:goAddFunc});

act.go({url:'http://www.google.com/',get:{test1:'myform',test2:'dothis',prm12:'hello world'},post:$('#form :input').toObj()});
act.go({form:$("form").get(0),url:'http://www.google.com/',get:{test1:'myform',test2:'dothis',prm12:'hello world'},post:{task1:'test1',task2:'test2'}});

*/


$.fn.toObj = function()
{
  var obj = {};
  $(this).each(function(){obj[$(this).attr('name')] = $(this).val()});
  return obj;
};

function ActionBox(settings)
{
  settings = settings || {};
  var _defaults = {
    url:'',
    form:null,
    post:{},
    get:{},
    getOnly:false,
    goAddFunc:null
  };

  var _cache = $.extend(true, {}, _defaults, settings);

  var _settings = {};

  var _empty = function(obj)
  {
    if(!obj)
    {      return true;
    }
    if(typeof obj == 'string')
    {      if(obj == '')
      {        return true;
      }
      return false
    }
    else
    {
      for(i in obj)
      {
        if(typeof obj[i] != 'undefined')
        {
          return false;
        }
      }
      return true;
    }
  };

  this.go = function(params)
  {
    if(typeof params == 'object')
    {
      $.extend(true, _settings, _cache, params);
    }
    else if(typeof params == 'string')
    {
      $.extend(true, _settings, _cache, {url:params});
    }
    else
    {
      _settings = _cache;
    }
    if(_settings.goAddFunc instanceof Function)
    {
      _settings.goAddFunc();
    }

    if(_settings.url == '')
    {
      _settings.url = window.location.href;
    }
    if(!_empty(_settings.get))
    {
      var query = {};
      if(!_settings.getOnly)
      {
        if(_settings.url.indexOf('?') >= 0)
        {
         var q = _settings.url.substr((_settings.url.indexOf('?')+1)).split('&');
          for(i in q)
          {
            var prm = q[i].split('=');
            query[prm[0]] = unescape(prm[1]);
          }
        }
        $.extend(query,_settings.get);
      }
      else
      {        query = _settings.get;
      }
      _settings.url = _settings.url.substr(0,_settings.url.indexOf('?'))+"?"+$.param(query);
    }
    if(!_empty(_settings.post))
    {
      if(_empty(_settings.form))
      {
        _settings.form = $("body").append('<div />').children('div:last').css('display','none').html('<form />').children('form:first').get(0);
      }

      $(_settings.form).attr({method:'post',action:_settings.url});
	  for(key in _settings.post)
	  {
	    var field = _settings.post[key];
	    $(_settings.form).append('<div />').children('div:last').css('display','none').append('<input />').children('input:last-child').attr('name',key).val(field);
	  }
	  $(_settings.form).trigger('submit');
	}
	else
	{
	  window.location.href=_settings.url;
	}
  };
}