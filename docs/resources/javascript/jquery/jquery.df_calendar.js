/*
 * DFCalendar (for jQuery)
 * version: 1.4 (08/10/2010)
 * @requires jQuery v1.4 + , DFLib v1.2 +
 * @requires df_calendar.css
 *
 *
 * Licensed under the MIT License: http://en.wikipedia.org/wiki/MIT_License
 *
 * Copyright (c) 2010 Dmytro Feshchenko www.df-studio.net
 *
 * Usage:
 *
 *  var calParams = {
 *	  format:"%d.%m.%Y",
 *	  type:"datetime",
 * 	  weekStart:1,
 *	  language:'ru'
 *  };
 *  var animation = {
 *	  speed:400,
 *	  type:'slide'
 *  };
 *	$(document).ready(function(){
 *	  $(document).dfPageShadow({animation:{type:'fade',speed:300}});
 * 	  $('#cal').dfCalendar(calParams,{event:'mouseover',today:"22.07.1999",type:'date',years:{from:1995,till:2012},showCallback:function(){$(document).trigger($.dfPageShadow.events.show);},hideCallback:function(){$(document).trigger($.dfPageShadow.events.hide);}});
 *	  $('.scal').dfCalendar({returnToId:['cal','cal1'],returnFormat:['%d.%m.%Y','%l, %j %F %Y, %g:%i:%s %a'],dateFunc:function(){return $('#cal').val()},language:'en',weekStart:0});
 *	  $('.cal1').dfCalendar({getDate:function(){alert('URL: '+'http://www.domain.com/'+$.dfCalendar.getBack('%Y/%m/%d/'));}});
 *	  $('.cal3').dfCalendar({animation:{speed:1000,type:'fade'},event:'click',format:'%l, %j %F %Y, %g:%i:%s %a',today:"Понедельник, 1 Август 2011, 12:00:00 am",language:'ru'});
 *	  $('.cal4').dfCalendar({weekStart:1,className:'dfclndr1',type:'date',animation:animation,event:'click',format:'%D, %d %M %Y, %h:%i:%s %A',language:'de'});
 *	  $('.cal5').dfCalendar({type:'datetime',weekStart:0,className:'dfclndr1',format:'%U',language:'eu',icons:{leftArrow:'&larr;',rightArrow:'&rarr;'},showCallback:function(){$(document).trigger($.dfPageShadow.events.show);},hideCallback:function(){$(document).trigger($.dfPageShadow.events.hide);}});
 *	  $.dfCalendar({element:$('#select_date').get(0),showCallback:function(){$(document).trigger($.dfPageShadow.events.show);},hideCallback:function(){$(document).trigger($.dfPageShadow.events.hide);}});
 *	});
 *
 *  <div id="select_date">Select date</div>
 *
 *  Date:<input type="text" value="22.07.1986" class="cal" id="cal">
 *
 *  <a href="#" class="scal" onclick="return false;">Select date</a> <span id="cal1"></span>
 *
 *  <div class="cal1">15.09.2007</div>
 *
 *  <div class="cal3">Set date</div>
 *
 *  <div id="cal4">Fri, 20 Aug 2010, 04:46:55 PM</div>
 *
 *  <div class="cal5">Date</div>
 *
 *  You can also use it programmatically:
 *
 *    jQuery.dfCalendar(Params, {animation:{type:'fade',speed:300,zIndex:100}})
 *
 *
 *  Want to close the DFCalendar?  Trigger the 'closeDFCalendar' event:
 *
 *    jQuery.dfCalendar.elems.main.trigger(jQuery.dfCalendar.events.close);
 *
 *
 */

;(function($) {

  $.dfCalendar = function(settings, params) {
    settings = settings || {};
    params = params || {};
    if(!$.dfLib.isEmpty(params) && !$.dfCalendar.inited) $.dfCalendar.init(settings);
    else if($.dfLib.isEmpty(params) && !$.dfCalendar.inited) $.dfCalendar.init({});
    if($.dfLib.isEmpty(params)) params = settings;
    $.dfCalendar.element = settings.element || params.element || null;
    $.dfCalendar.elems.main.trigger($.dfCalendar.events.show, [params]);
  };

  var _this = $.dfCalendar;
  var today = {};
  setToday();

  $.extend(_this, {
    development: {
	  name:		'DFCalendar',
	  version:	'1.4',
	  year:		'2010',
	  author:{
		name:	'Dmytro Feshchenko',
		webSite:'www.df-studio.net'
	  }
    },
    settings: {
      event:'click',
      language:'en',
      id:'dfc'+Math.round(Math.random()*100000),
      className:'dfclndr',
      subId:{
      		copy:		'c',
      		copyBlock:	'cb',
      		current:	'curr',
      		days:		'd',
      		daysBlock:	'db',
      		daysOff:	'do',
      		daysSelected:	'ds',
      		daysToday:	'dt',
      		loadingBlock:	'lb',
      		mainBlock:	'mnb',
      		monthBlock:	'mb',
      		month:		'm',
      		monthList:	'ml',
      		monthM:		'mm',
      		monthP:		'mp',
      		tdLeft:		'tdl',
      		tdMid:		'tdm',
      		tdRight:	'tdr',
      		todayBlock:	'tb',
      		today:		't',
      		timeBlock:	'tmb',
      		timeText:	'tmt',
      		timeHours:	'tmh',
      		timeMinutes:'tmm',
      		timeSeconds:'tms',
      		close:		'x',
      		yearBlock:	'yb',
      		year:		'y',
      		yearList:	'yl',
      		yearM:		'ym',
      		yearP:		'yp'
      },
      date:null,
      dateFunc:null,
      today:null,
      format:'%Y-%m-%d',
      returnFormat:null,
      returnToId:null,
      type:'date',
      years:{
    		from: today.year-100,
    		till: today.year+100
      },
      animation:{
    				left:-1,
    				top:-1,
    				zIndex:1000,
    				type:'show',  //  fade/slide/show
	    			speed:'300',
	    			showMethod:null,
	    			hideMethod:null
      },
      icons:{        close:'&times;',
        leftArrow:'&laquo;',
        rightArrow:'&raquo;'
      },
      showCallback:null,
	  hideCallback:null,
      setDate:null,
      getDate:null,
      weekStart:0,
      showCopy:true,
      lang:{
     		en:{
     				today:'Today',
     				time:'Time',
     				close:'Close',
     				loading:'Loading',
     				month:['January','February','March','April','May','June','July','August','September','October','November','December'],
     				mon:['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
     				weekDay:['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],
     				wDay:['Sun','Mon','Tue','Wed','Thu','Fri','Sat']
     		},
     		ru:{
     				today:'Сегодня',
     				time:'Время',
     				close:'Закрыть',
     				loading:'Загрузка',
     				month:['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
     				mon:['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'],
     				weekDay:['Воскресенье','Понедельник','Вторник','Среда','Четверг','Пятница','Суббота'],
     				wDay:['Вс','Пн','Вт','Ср','Чт','Пт','Сб']
     		},
     		ua:{
     				today:'Сьогодні',
     				time:'Час',
     				close:'Закрити',
     				loading:'Завантаження',
     				month:['Січень','Лютий','Березень','Квітень','Травень','Червень','Липень','Серпень','Вересень','Жовтень','Листопад','Грудень'],
     				mon:['Січ','Лют','Бер','Кві','Тра','Чер','Лип','Сер','Вер','Жов','Лис','Гру'],
     				weekDay:['Неділя','Понеділок','Вівторок','Середа','Четвер','П\'ятниця','Субота'],
     				wDay:['Нд','Пн','Вт','Ср','Чт','Пт','Сб']
     		},
     		de:{
			        today:'Heute',
			        time:'Uhrzeit',
			        close:'Schliessen',
			        loading:'&Ouml;ffnen',
			        month:['Januar','Februar','M&auml;rz','April','May','Juni','Juli','August','September','Oktober','November','Dezember'],
			        mon:['Jan','Feb','M&auml;r','Apr','Mai','Juni','Juli','Aug','Sep','Okt','Nov','Dez'],
			        weekDay:['Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag'],
			        wDay:['So','Mo','Di','Mi','Do','Fr','Sa']
			}
      }
    },

    setEvents:function()
    {      var events = ['close','fill','show','returnBack','showYearList','showMonthList','hideYearList','hideMonthList','showHideCopy'];

      var _name = _this.development.name;
      var eventsObj = {};
      for(i in events)
      {        eventsObj[events[i]] = events[i]+_name;
      }
      $.extend(_this, {events:eventsObj});

      var _e = _this.elems;
      var _event = _this.events;

      _e.main.bind(_event.close, function(event) {
     	event.stopPropagation();
     	$(document).unbind('keydown');
     	if(_e.main.is(':visible'))
    	{
    	  _e.main.trigger(_event.hideYearList);
	      _e.main.trigger(_event.hideMonthList);
	      _this.hide();
    	}
  	  });

  	  _e.main.bind(_event.show, function(event,params){
  	  	event.stopPropagation();
  	  	$(_this.element).blur();
  	  	$(document).bind('keydown', function(event){
          if (event.which == 27)
          {
            _e.main.trigger(_event.close);
          }
        });
        _e.timeBlock.find('input').bind('keydown',function(event){
            event.stopPropagation();
            if(event.which == 13)
	   		{
	   		   $(this).trigger('click');
	   		   _e.main.trigger(_event.returnBack,[$('#'+_this.id.daysSelected).find('a').text()]);
	   		}
        });
        _e.main.trigger(_event.hideYearList);
	    _e.main.trigger(_event.hideMonthList);
  	  	_this.show(params);  	  });

	  _e.main.bind(_event.hideMonthList, function(event,month) {
     	event.stopPropagation();
     	_this.hideMonthList(month);
  	  });

  	  _e.main.bind(_event.hideYearList, function(event,year) {
     	event.stopPropagation();
     	_this.hideYearList(year);
  	  });

  	  _e.main.bind(_event.showMonthList, function(event,month) {  	  	event.stopPropagation();  	  	_e.main.trigger(_event.hideYearList);
     	_this.showList({month:month});
  	  });

  	  _e.main.bind(_event.showYearList, function(event,year) {  	  	event.stopPropagation();
     	_e.main.trigger(_event.hideMonthList);
     	_this.showList({year:year});
  	  });

  	  _e.main.bind(_event.fill, function(event,params) {  	  	event.stopPropagation();  	  	_e.main.trigger(_event.hideYearList);
	    _e.main.trigger(_event.hideMonthList);
  	  	_this.fill(params);
  	  });

  	  _e.main.bind(_event.showHideCopy, function(event) {  	  	event.stopPropagation();
  	  	_e.main.trigger(_event.hideYearList);
	    _e.main.trigger(_event.hideMonthList);
  	  	_this.showHideCopy();
  	  });

  	  _e.main.bind(_event.returnBack, function(event,date) {  	  	event.stopPropagation();
  	  	date = date || null;
  	  	if(date)
  	  	{
  	  	  _this.setDate(date);
  	  	}
  	  	_this.returnBack();
	  	_e.main.trigger(_event.close);
  	  });

    },

    returnBack: function()
    {
      var _s = _this.settings;
      if(typeof(_s.getDate) == 'function')
      {
        _s.getDate();
      }
      else
      {
        if(typeof(_s.returnToId) == 'string')
        {
          _this.setBack(_s.returnToId,_s.returnFormat);
        }
        else if(typeof(_s.returnToId) == 'object' && _s.returnToId != null)
        {
          if(typeof(_s.returnFormat) != 'object' || !_s.returnFormat)
          {
            _s.returnFormat = {};
          }
          for(i in _s.returnToId)
          {
            _this.setBack(_s.returnToId[i],_s.returnFormat[i]);
          }
        }
        else
        {
          var value = _this.getBack(_s.returnFormat);
          $(_this.element).is(':input') ? $(_this.element).val(value) : $(_this.element).text(value);
        }
      }
    },

    setBack: function(id, format)
    {
      format = _this.getBack(format);
      var elem = _this.element;

      if($("#"+id).length)
      {
        elem = $("#"+id).get(0);
      }
      if($(elem).is(":input"))
      {
        $(elem).val(format);
      }
      else
      {
        $(elem).text(format);
      }
    },

    getBack: function(format)
    {
      if(!format)
      {
        format = _this.settings.format;
      }
      for(key in _format.labels)
      {
        format = format.replace("%"+key, _format.labels[key].fromJS(null));
      }
      return format;
    },

    showList: function(param)
    {      var List = null;
      if(param.year)
      {
        List = _this.elems.yearList;
        prm = param.year;
      }
      else if(param.month)
      {        List = _this.elems.monthList;
        prm = param.month;
      }

      if(List.is(':hidden'))
      {
        List.css({
      	  display:'block',
      	  visible:'hidden',
      	  position:'absolute',
      	  zIndex:_this.settings.animation.zIndex+5,
      	  overflow:'auto'
        });
        if(List.attr('scrollHeight') > 150)
      	{
          List.height(150);
      	}
        List.show();
      }
      var position = List.parent().position();
      var pos = List.prev().position();
      List.css({left:(List.parent().width()-List.width())/2+position.left,top:pos.top});
      List.find('a').removeClass(_this.className.current);
      List.scrollTop(0);
      position = List.find('a:contains('+prm+')').addClass(_this.className.current).position();
      List.scrollTop(position.top);
    },

    hideYearList: function(year)
    {
      var _e = _this.elems;
      _e.yearList.hide();
      if(parseInt(year))
      {
        _this.setYear(year);
        _e.year.html(year);
        _this.fill();
      }
    },
    hideMonthList: function(month)
    {
      var _e = _this.elems;
      _e.monthList.hide();
      if(parseInt(month) >= 0)
      {
        _this.setMonth(month);
        var lang = getLangs(null);
        _e.month.html(lang.month[month]);
        _this.fill();
      }
    },

    showHideCopy: function()
    {
  	  var _e = _this.elems;
  	  if(_e.copyBlock.is(':visible'))
  	  {
  	    _e.mainBlock.show();
  	    _e.copyBlock.hide();
  	  }
  	  else
  	  {
  	    _e.mainBlock.hide();
  	    _e.copyBlock.show();
  	  }
    },

    checkDate: function()
    {      var _e = _this.elems;
      var _s = _this.settings;
      if(_this.date.getFullYear() == _s.years.from)
      {        _e.yearM.hide();
        if(_this.date.getMonth() == 0)
        {          _e.monthM.hide();
        }
        else
        {          if(_e.monthM.is(':hidden'))
          {
            _e.monthM.show();
          }
        }
      }
      else
      {        if(_e.yearM.is(':hidden'))
        {          _e.yearM.show();
        }
        if(_e.monthM.is(':hidden'))
        {
          _e.monthM.show();
        }
      }
      if(_this.date.getFullYear() == _s.years.till)
      {
        _e.yearP.hide();
        if(_this.date.getMonth() == 11)
        {
          _e.monthP.hide();
        }
        else
        {
          if(_e.monthP.is(':hidden'))
          {
            _e.monthP.show();
          }
        }
      }
      else
      {
        if(_e.yearP.is(':hidden'))
        {
          _e.yearP.show();
        }
        if(_e.monthP.is(':hidden'))
        {
          _e.monthP.show();
        }
      }
    },

    setYear: function(year)
    {
      if(year == 'add')
      {
        year = _this.date.getFullYear()+1;
      }
      else if(year == 'sub')
      {
        year = _this.date.getFullYear()-1;
      }
      year = checkYear(year);
      _this.date.setFullYear(year);
      _this.checkDate();
    },

    setMonth: function(month)
    {
      if(month == 'add')
      {
        month = _this.date.getMonth()+1;
      }
      else if(month == 'sub')
      {
        month = _this.date.getMonth()-1;
      }
      _this.date.setDate(1);
      _this.date.setMonth(month);
      var year = _this.date.getFullYear();
      var yearChecked = checkYear(year);
      if(parseInt(year) < parseInt(yearChecked))
      {
        _this.date.setMonth(0);
        _this.date.setFullYear(yearChecked);
      }
      if(parseInt(year) > parseInt(yearChecked))
      {
        _this.date.setMonth(11);
        _this.date.setFullYear(yearChecked);
      }
      _this.checkDate();
    },

    setDate: function(day)
    {
      _this.date.setDate(day);
    },

    fill: function(params)
	{
	  params = params || {};
	  var lang = getLangs(null);
	  var _e = _this.elems;
	  var _s = _this.settings;
	  var _cn = _this.className;
	  var _event = _this.events;
	  if(params.full)
	  {
	    _e.loadingBlock.css({display:'block'}).html(lang.loading+'...');
	    _e.copyBlock.css({display:'none'});
	    _e.mainBlock.css({display:'none'});
	    if(_s.showCopy)_e.copy.html('&copy;').unbind('click').bind('click',function(){_e.main.trigger(_event.showHideCopy);});
	    _e.today.html(lang.today).unbind('click').bind('click',function(){_this.date = new Date(today.dateObj.getTime());_this.setYear(_this.date.getFullYear());_this.setMonth(_this.date.getMonth());_e.main.trigger(_event.fill,[{chTime:true}]);});
	    _e.close.html(_s.icons.close).unbind('click').bind('click',function(){_e.main.trigger(_event.close);});
	    _e.yearM.html(_s.icons.leftArrow).unbind('click').bind('click',function(){_this.setYear('sub');_e.main.trigger(_event.fill);});
	    _e.yearP.html(_s.icons.rightArrow).unbind('click').bind('click',function(){_this.setYear('add');_e.main.trigger(_event.fill);});
	    _e.monthM.html(_s.icons.leftArrow).unbind('click').bind('click',function(){_this.setMonth('sub');_e.main.trigger(_event.fill);});
	    _e.monthP.html(_s.icons.rightArrow).unbind('click').bind('click',function(){_this.setMonth('add');_e.main.trigger(_event.fill);});
	    var years = '';
	    for(i=parseInt(_s.years.from);i<=parseInt(_s.years.till);i++)
	    {
	      years += '<a>'+i+'</a>';
	    }
	    _e.yearList.html(years).find('a').bind('click',function(){_e.main.trigger(_event.hideYearList,[$(this).text()]);});
	    var months = '';
	    for(i in lang.month)
	    {
	      months += '<a>'+lang.month[i]+'</a>';
	    }
	    _e.monthList.html(months).find('a').bind('click',function(){_e.main.trigger(_event.hideMonthList,[$(this).prevAll('a').length]);});

	    if(_s.type == 'datetime')
	    {
	      _e.timeBlock.css({display:'block'});
	      _e.timeText.text(lang.time);
	      _e.timeBlock.find('input').unbind('click change').bind('click change', function(){	   			val = $(this).val();
	   			if(val)
	   			{
	   			  if(isNaN(parseInt(val)))
	   			  {
	   			    val = 0;
	   			  }
	   			  if(val > 59) val = 59;
	   			  else if(val < 0) val = 0;
	   			  val = getLeadingZeros(val);
	   			  $(this).val(val);
	   			  if($(this).attr('id') == _this.id.timeMinutes)
	   			  {
	   			    _this.date.setMinutes(parseInt(val,10));
	   			  }
	   			  else if($(this).attr('id') == _this.id.timeSeconds)
	   			  {
	   			    _this.date.setSeconds(parseInt(val,10));
	   			  }
	   			}	      });
	      _e.timeHours.unbind('click change').bind('click change', function(){
	   			val = $(this).val();
	   			if(val)
	   			{
	   			  if(isNaN(parseInt(val)))
	   			  {
	   			    val = 0;
	   			  }
	   			  if(val > 23) val = 23;
	   			  else if(val < 0) val = 0;
	   			  val = getLeadingZeros(val);
	   			  $(this).val(val);
	   			  _this.date.setHours(parseInt(val,10));
	   			}
	      });
	    }
	    else
	    {	      _e.timeBlock.css({display:'none'});
	    }
	    for(i=0;i<7;i++)
	    {
	      if(_s.weekStart == 1)
	      {
	   	    j = i+1;
	        if(j >= 7)
	        {
	          j = 0;
	        }
	      }
	      else
	      {
	        j = i;
	      }
	      _e.daysBlock.find('th:eq('+i+')').html(lang.wDay[j]);
	    }
	  }

	  _e.year.html(_this.date.getFullYear()).unbind('click').bind('click',function(){if(_e.yearList.is(':hidden')){_e.main.trigger(_event.showYearList,[$(this).text()]);}else{_e.main.trigger(_event.hideYearList);}});
	  _e.month.html(lang.month[_this.date.getMonth()]).unbind('click').bind('click',function(){if(_e.monthList.is(':hidden')){_e.main.trigger(_event.showMonthList,[$(this).text()]);}else{_e.main.trigger(_event.hideMonthList);}});

	  var j=1;
	  var date = {
	  	Date:_this.date,
	   	year:_this.date.getFullYear(),
	   	month:_this.date.getMonth()
	  };
	  date.Date.setDate(1);
	  var d = date.Date.getDay();
	  if(_s.weekStart == 1)
	  {
	    d--;
	    if(d < 0)
	    {
	      d = 6;
	    }
	  }
	  var days = monthDaysCount(date.year,date.month);
	  var n = 0;
	  var m = 1;
	  for(j=1;j<=6;j++)
	  {
	    var $tr = _e.daysBlock.find('tr:eq('+j+')');
	    $tr.show();
	    for(k=0;k<7;k++)
	    {
	      $td = $tr.find('td:eq('+k+')');
	      $td.html(' ').unbind('click').removeClass(_cn.daysToday+' '+_cn.daysSelected+' '+_cn.daysOff).attr('id',null);
	      if(_s.weekStart && (k==5 || k==6) || !_s.weekStart && (k==0 || k==6))
		  {
		    $td.addClass(_cn.daysOff);
		  }
          if(n >= d && n < (days + d))
	      {
	        $td.html("<a>"+m+"</a>").bind('click',function(){_e.main.trigger(_event.returnBack,[$(this).find('a').text()]);});
	        if(date.year == today.year && date.month == today.month && m == today.date)
		  	{
		  	  $td.addClass(_cn.daysToday).attr('id',_this.id.daysToday);
		    }
			if(date.year == _this.inDate.year && date.month == _this.inDate.month && m == _this.inDate.date)
			{
			  $td.addClass(_cn.daysSelected).attr('id',_this.id.daysSelected);
			}
	        m++;
	      }
	      else
	      {
	        if(j == 6 && k == 0)
	        {
	          $tr.hide();
	          break;
	        }
	      }
	      n++;
	    }
	  }
	  if(params.chTime)
	  {
	    _e.timeHours.val(getLeadingZeros(_this.date.getHours()));
	    _e.timeMinutes.val(getLeadingZeros(_this.date.getMinutes()));
	    _e.timeSeconds.val(getLeadingZeros(_this.date.getSeconds()));
	  }
	  if(params.full)
	  {	    _e.loadingBlock.hide();
	    _e.mainBlock.show();
	  }
	},

	hide: function()
    {
      var _e = _this.elems;
	  var _s = _this.settings;
	  if(typeof _s.hideCallback == 'function')
      {
      	_s.hideCallback();
      }
      $.dfLib.hideAnimation(_e.main, _s.animation);
    },

    show: function(params)
    {
      params = params || {};
      today={};
      _this.settings = $.extend(true, {}, _this.cache, params);
      var pos = $.dfLib.position(_this.element);
      var _s = _this.settings;
      var _e = _this.elems;
      _e.main.css({
    	  position:'absolute',
    	  left:((_s.animation.left >= 0)?_s.animation.left:pos.left)+'px',
    	  top:((_s.animation.top >= 0)?_s.animation.top:pos.top)+'px',
    	  zIndex:_s.animation.zIndex
      });
      setFormat(_s.format);
      if(_s.today != null)
      {
        setToday(setDate(_s.today));
      }
      else
      {        setToday();
      }
      if(typeof(_s.setDate) == 'function')
      {
        _this.date = _s.setDate();
      }
      else
      {
        if(typeof(_s.dateFunc) == 'function')
        {
          _s.date = _s.dateFunc();
        }
        var date = _s.date || (($(_this.element).is(':input')) ? $(_this.element).val() : $(_this.element).text());
        _this.date = setDate(date);
      }
      _this.inDate = {
    			year:_this.date.getFullYear(),
    			month:_this.date.getMonth(),
    			date:_this.date.getDate(),
    			Date:new Date(_this.date.getFullYear(),_this.date.getMonth(),_this.date.getDate())
      };
      _this.setYear(_this.date.getFullYear());
      _this.setMonth(_this.date.getMonth());
      _this.fill({full:true,chTime:true});

      _e.main.removeClass().addClass(_s.className);
      if(typeof _s.showCallback == 'function')
      {
      	_s.showCallback();
      }
      $.dfLib.showAnimation(_e.main, _s.animation);
    },

    build: function()
    {
      var _s = _this.settings;
      var _cn = _this.className;
      var _id = _this.id;
      if(!$("#"+_id.main).length)
      {
        $("body").prepend('<div style="display:none;" />').children('div:first').attr('id',_id.main).addClass(_cn.main);
        var _e = {};
        _e.main = $("#"+_id.main);
        _e.main.html('<div /><div /><div />').find('div:first').attr('id',_id.loadingBlock).addClass(_cn.loadingBlock);
        _e.main.find('div:eq(1)').css({display:'none'}).attr('id',_id.copyBlock).addClass(_cn.copyBlock);
        _e.main.find('div:last').css({display:'none'}).attr('id',_id.mainBlock).addClass(_cn.mainBlock);

        var struct = '<table><tr>'+$.dfLib.repeat('<td></td>',3)+'</tr></table>';
        _e.mainBlock = $("#"+_id.mainBlock);
        _e.mainBlock.html('<div />').children('div:last').attr('id',_id.todayBlock).addClass(_cn.todayBlock).html(struct);
        _e.mainBlock.append('<div />').children('div:last').attr('id',_id.yearBlock).addClass(_cn.yearBlock).html(struct);
        _e.mainBlock.append('<div />').children('div:last').attr('id',_id.monthBlock).addClass(_cn.monthBlock).html(struct);

        _e.todayBlock = $("#"+_id.todayBlock);
        _e.yearBlock = $("#"+_id.yearBlock);
        _e.monthBlock = $("#"+_id.monthBlock);

        _e.todayBlock.find('td:first').addClass(_cn.tdLeft).html('<a />').find('a:last').attr('id',_id.copy).addClass(_cn.copy);
        _e.todayBlock.find('td:eq(1)').addClass(_cn.tdMid).html('<a />').find('a:last').attr('id',_id.today).addClass(_cn.today);
        _e.todayBlock.find('td:last').addClass(_cn.tdRight).html('<a />').find('a:last').attr('id',_id.close).addClass(_cn.close);

        _e.yearBlock.find('td:first').addClass(_cn.tdLeft).html('<a />').find('a:last').attr('id',_id.yearM).addClass(_cn.yearM);
        _e.yearBlock.find('td:eq(1)').addClass(_cn.tdMid).html('<a />').find('a:last').attr('id',_id.year).addClass(_cn.year).after('<div />').next('div').attr('id',_id.yearList).addClass(_cn.yearList);
        _e.yearBlock.find('td:last').addClass(_cn.tdRight).html('<a />').find('a:last').attr('id',_id.yearP).addClass(_cn.yearP);

        _e.monthBlock.find('td:first').addClass(_cn.tdLeft).html('<a />').find('a:last').attr('id',_id.monthM).addClass(_cn.monthM);
        _e.monthBlock.find('td:eq(1)').addClass(_cn.tdMid).html('<a />').find('a:last').attr('id',_id.month).addClass(_cn.month).after('<div />').next('div').attr('id',_id.monthList).addClass(_cn.monthList);
        _e.monthBlock.find('td:last').addClass(_cn.tdRight).html('<a />').find('a:last').attr('id',_id.monthP).addClass(_cn.monthP);

        _e.mainBlock.append('<div />').children('div:last').attr('id',_id.daysBlock).addClass(_cn.daysBlock).html("<table>\ <tr>"+$.dfLib.repeat("<th></th>",7)+"</tr>\ "+$.dfLib.repeat("<tr>"+$.dfLib.repeat("<td></td>",7)+"</tr>\ ",6)+"</table>");
        _e.mainBlock.append('<div />').children('div:last').hide().attr('id',_id.timeBlock).addClass(_cn.timeBlock).html("<span />").find('span:first').attr('id',_id.timeText).addClass(_cn.timeText).after(':&nbsp;<input />').next('input:first').attr({id:_id.timeHours,size:1,maxlength:2}).addClass(_cn.timeHours).after(":<input />").next('input:first').attr({id:_id.timeMinutes,size:1,maxlength:2}).addClass(_cn.timeMinutes).after(":<input />").next('input:first').attr({id:_id.timeSeconds,size:1,maxlength:2}).addClass(_cn.timeSeconds);
        lang = getLangs();
        $("#"+_id.copyBlock).bind('click',function(){_e.main.trigger(_this.events.showHideCopy);}).html(_this.development.name+' v'+_this.development.version+'<br />'+'Licensed under the <a href="http://en.wikipedia.org/wiki/MIT_License">MIT License</a>'+'<br />'+'Copyright &copy; '+_this.development.year+' '+_this.development.author.name+' <a href="http://'+_this.development.author.webSite+'">'+_this.development.author.webSite+'</a>'+'<br /><br />').append('<a />').find('a:last').text(lang.close);
      }
      var elems = {};
      for(i in _id)
      {        elems[i] = $('#'+_id[i]);
      }
      $.extend(_this, {elems:elems});
    },

    reset: function()
    {      _this.settings = _this.cache;
    },

    init: function(settings)
    {
      settings = settings || {};
      if(_this.cache)
      {
      	_this.reset();
      }
      else
      {
      	_this.settings = $.extend(true, _this.settings, settings);
      	_this.cache = _this.settings;
      }

      if (_this.inited) return true
      else _this.inited = true


      var _s = _this.settings;
      $.extend(_this, {
        id: {
    	  main:			_s.id,
    	  todayBlock:	_s.id+_s.subId.todayBlock,
    	  today:		_s.id+_s.subId.today,
    	  yearBlock:	_s.id+_s.subId.yearBlock,
    	  year:			_s.id+_s.subId.year,
    	  yearList:		_s.id+_s.subId.yearList,
    	  yearM:		_s.id+_s.subId.yearM,
    	  yearP:		_s.id+_s.subId.yearP,
    	  monthBlock:	_s.id+_s.subId.monthBlock,
    	  month:		_s.id+_s.subId.month,
    	  monthList:	_s.id+_s.subId.monthList,
    	  monthM:		_s.id+_s.subId.monthM,
    	  monthP:		_s.id+_s.subId.monthP,
    	  daysBlock:	_s.id+_s.subId.daysBlock,
    	  days:			_s.id+_s.subId.days,
    	  daysToday:	_s.id+_s.subId.daysToday,
    	  daysSelected:	_s.id+_s.subId.daysSelected,
    	  daysOff:		_s.id+_s.subId.daysOff,
    	  timeBlock:	_s.id+_s.subId.timeBlock,
    	  timeText:		_s.id+_s.subId.timeText,
    	  timeHours:	_s.id+_s.subId.timeHours,
    	  timeMinutes:	_s.id+_s.subId.timeMinutes,
    	  timeSeconds:	_s.id+_s.subId.timeSeconds,
    	  tdLeft:		_s.id+_s.subId.tdLeft,
    	  tdMid:		_s.id+_s.subId.tdMid,
    	  tdRight:		_s.id+_s.subId.tdRight,
    	  copy:			_s.id+_s.subId.copy,
    	  copyBlock:	_s.id+_s.subId.copyBlock,
    	  mainBlock:	_s.id+_s.subId.mainBlock,
    	  loadingBlock:	_s.id+_s.subId.loadingBlock,
    	  close:		_s.id+_s.subId.close
        },
        className: {
    	  main:			_s.className,
    	  todayBlock:	_s.subId.todayBlock,
    	  today:		_s.subId.today,
    	  yearBlock:	_s.subId.yearBlock,
    	  year:			_s.subId.year,
    	  yearList:		_s.subId.yearList,
    	  yearM:		_s.subId.yearM,
    	  yearP:		_s.subId.yearP,
    	  monthBlock:	_s.subId.monthBlock,
    	  month:		_s.subId.month,
		  monthList:	_s.subId.monthList,
    	  monthM:		_s.subId.monthM,
    	  monthP:		_s.subId.monthP,
    	  daysBlock:	_s.subId.daysBlock,
    	  days:			_s.subId.days,
     	  daysToday:	_s.subId.daysToday,
    	  daysSelected:	_s.subId.daysSelected,
    	  daysOff:		_s.subId.daysOff,
    	  timeBlock:	_s.subId.timeBlock,
    	  timeText:		_s.subId.timeText,
    	  timeHours:	_s.subId.timeHours,
    	  timeMinutes:	_s.subId.timeMinutes,
    	  timeSeconds:	_s.subId.timeSeconds,
    	  tdLeft:		_s.subId.tdLeft,
    	  tdMid:		_s.subId.tdMid,
    	  tdRight:		_s.subId.tdRight,
    	  copy:			_s.subId.copy,
    	  copyBlock:	_s.subId.copyBlock,
    	  mainBlock:	_s.subId.mainBlock,
    	  loadingBlock:	_s.subId.loadingBlock,
    	  close:		_s.subId.close,
    	  current:		_s.subId.current
        }
      });
      _this.build();
      _this.setEvents();
    }
  });

  $.fn.dfCalendar = function(settings, params)
  {
    settings = settings || {};
    params = params || {};
    if(!$.dfLib.isEmpty(params) && !$.dfCalendar.inited) $.dfCalendar.init(settings);
    else if($.dfLib.isEmpty(params) && !$.dfCalendar.inited) $.dfCalendar.init({});
    if($.dfLib.isEmpty(params)) params = settings;
    var event = (params.event) ? params.event : $.dfCalendar.settings.event;
    return this.live(event, function(){
    	        $.dfCalendar.reset();
    			$.dfCalendar.element = this;
    			$.dfCalendar.elems.main.trigger($.dfCalendar.events.show, [params]);
    });
  };

  function setToday(t)
  {    t = t || new Date();
    today = {
  	  dateObj:t,
  	  year:t.getFullYear(),
      month:t.getMonth(),
      date:t.getDate(),
      hours:t.getHours(),
      minutes:t.getMinutes(),
      seconds:t.getSeconds()
    };
  };

  var _format = {
  	labels:{
	  	d:{ // Day of the month, 2 digits with leading zeros 01 to 31
	  		re:'\\d{2}',
	  		toJS:function(val)
	  		{
	  		  val = parseInt(val,10);
	  		  _this._date.setDate(val);
	  		  return val;
	  		},
	  		fromJS:function(val)
	  		{
	  		  if(!val)val=_this.date.getDate();
	  		  return getLeadingZeros(val);
	  		}
	  	},
	  	D:{ // A textual representation of a day, two/three letters
	  		re:'\\w{2,3}',
	  		toJS:function(val)
	  		{
	  		  var lang = getLangs('en');
	  		  for(i in lang.wDay)
	  		  {
	  		    if(lang.wDay[i] == val)
	  		    {
	  		      return i;
	  		    }
	  		  }
	  		  return null;
	  		},
	  		fromJS:function(val)
	  		{
	  		  if(!val)val=_this.date.getDay();
	  		  var lang = getLangs();
	  		  return lang.wDay[val];
	  		}
	  	},
	  	j:{ // Day of the month without leading zeros 1 to 31
	  		re:'\\d{1,2}',
	  		toJS:function(val)
	  		{
	  		  val = parseInt(val,10);
	  		  _this._date.setDate(val);
	  		  return val;
	  		},
	  		fromJS:function(val)
	  		{
	  		  if(!val)val=_this.date.getDate();
	  		  return val;
	  		}
	  	},
	  	l:{ // A full textual representation of the day of the week Sunday through Saturday
	  		re:'\\w+',
	  		toJS:function(val)
	  		{
	  		  var lang = getLangs('en');
	  		  for(i in lang.weekDay)
	  		  {
	  		    if(lang.weekDay[i] == val)
	  		    {
	  		      return i;
	  		    }
	  		  }
	  		  return null;
	  		},
	  		fromJS:function(val)
	  		{
	  		  if(!val)val=_this.date.getDay();
	  		  var lang = getLangs();
	  		  return lang.weekDay[val];
	  		}
	  	},
	  	N:{ // ISO-8601 numeric representation of the day of the week 1 (for Monday) through 7 (for Sunday)
	  		re:'\\d{1}',
	  		toJS:function(val)
	  		{
	  		  val = parseInt(val,10);
	  		  if(val===0)val=7;
	  		  return val;
	  		},
	  		fromJS:function(val)
	  		{
	  		  if(!val)val=_this.date.getDay();
	  		  if(val===0)val=7;
	  		  return val;
	  		}
	  	},
	  	w:{ // Numeric representation of the day of the week 0 (for Sunday) through 6 (for Saturday)
	  		re:'\\d{1}',
	  		toJS:function(val)
	  		{
	  		  return parseInt(val,10);
	  		},
	  		fromJS:function(val)
	  		{
	  		  if(!val)val=_this.date.getDay();
	  		  return val;
	  		}
	  	},
	  	F:{ // A full textual representation of a month, such as January or March
	  		re:'\\w+',
	  		toJS:function(val)
	  		{
	  		  var lang = getLangs('en');
	  		  for(i in lang.month)
	  		  {
	  		    if(lang.month[i] == val)
	  		    {
	  		      _this._date.setMonth(i);
	  		      return i;
	  		    }
	  		  }
	  		  return null;
	  		},
	  		fromJS:function(val)
	  		{
	  		  if(!val)val=_this.date.getMonth();
	  		  var lang = getLangs();
	  		  return lang.month[val];
	  		}
	  	},
	  	m:{ // Numeric representation of a month, with leading zeros 01 through 12
	  		re:'\\d{2}',
	  		toJS:function(val)
	  		{
	  		  val = parseInt(val,10)-1;
	  		  _this._date.setMonth(val);
	  		  return val;
	  		},
	  		fromJS:function(val)
	  		{
	  		  if(!val)val=_this.date.getMonth();
	  		  val++;
	  		  return getLeadingZeros(val);
	  		}
	  	},
	  	M:{ // A short textual representation of a month, three letters Jan through Dec
	  		re:'\\w{3}',
	  		toJS:function(val)
	  		{
	  		  var lang = getLangs('en');
	  		  for(i in lang.month)
	  		  {
	  		    if(lang.month[i].substr(0,3) == val)
	  		    {
	  		      _this._date.setMonth(i);
	  		      return i;
	  		    }
	  		  }
	  		  return null;
	  		},
	  		fromJS:function(val)
	  		{
	  		  if(!val)val=_this.date.getMonth();
	  		  var lang = getLangs();
	  		  return lang.month[val].substr(0,3);
	  		}
	  	},
	  	n:{ // Numeric representation of a month, without leading zeros 1 through 12
	  		re:'\\d{1,2}',
	  		toJS:function(val)
	  		{
	  		  val = parseInt(val,10)-1;
	  		  _this._date.setMonth(val);
	  		  return val;
	  		},
	  		fromJS:function(val)
	  		{
	  		  if(!val)val=_this.date.getMonth();
	  		  val++;
	  		  return val;
	  		}
	  	},
	  	Y:{ // A full numeric representation of a year, 4 digits Examples: 1999 or 2003
	  		re:'\\d{4}',
	  		toJS:function(val)
	  		{
	  		  _this._date.setFullYear(val);
	  		  return val;
	  		},
	  		fromJS:function(val)
	  		{
	  		  if(!val)val=_this.date.getFullYear();
	  		  return val;
	  		}
	  	},
	  	a:{ // Lowercase Ante meridiem and Post meridiem am or pm
	  		re:'\\w{2}',
	  		toJS:function(val)
	  		{
	  		  if(val == 'am' || val == 'pm')
	  		  {
	  		    _this.settings._ampm = val;
	  		    setHour();
	  		  }
	  		  else
	  		  {	  		    val = null;
	  		  }
	  		  return val;
	  		},
	  		fromJS:function(val)
	  		{
	  		  if(!val)val=_this.date.getHours();
	  		  if (val<12)return 'am';
	  		  else return 'pm'
	  		}
	  	},
	  	A:{ // Uppercase Ante meridiem and Post meridiem AM or PM
	  		re:'\\w{2}',
	  		toJS:function(val)
	  		{
	  		  if(val == 'AM' || val == 'PM')
	  		  {
	  		    _this.settings._ampm = val.toLowerCase();
	  		    setHour();
	  		  }
	  		  else
	  		  {
	  		    val = null;
	  		  }
	  		  return val;
	  		},
	  		fromJS:function(val)
	  		{
	  		  if(!val)val=_this.date.getHours();
	  		  if (val<12)return 'AM';
	  		  else return 'PM'
	  		}
	  	},
	  	g:{ // 12-hour format of an hour without leading zeros 1 through 12
	  		re:'\\d{1,2}',
	  		toJS:function(val)
	  		{
	  		  val = parseInt(val,10);
	  		  _this.settings._ampmHour = parseInt(val);
	  		  setHour();
	  		  return val;
	  		},
	  		fromJS:function(val)
	  		{
	  		  if(!val)val=_this.date.getHours();
	  		  if (val>12)val-=12;
	  		  else if(val==0)val=12;
	  		  return val;
	  		}
	  	},
	  	G:{ // 24-hour format of an hour without leading zeros 0 through 23
	  		re:'\\d{1,2}',
	  		toJS:function(val)
	  		{
	  		  val = parseInt(val,10);
	  		  _this._date.setHours(val);
	  		  return val;
	  		},
	  		fromJS:function(val)
	  		{
	  		  if(!val)val=_this.date.getHours();
	  		  return val;
	  		}
	  	},
        h:{ // 12-hour format of an hour with leading zeros	01 through 12
	  		re:'\\d{2}',
	  		toJS:function(val)
	  		{
	  		  val = parseInt(val,10);
	  		  _this.settings._ampmHour = parseInt(val);
	  		  setHour();
	  		  return val;
	  		},
	  		fromJS:function(val)
	  		{
	  		  if(!val)val=_this.date.getHours();
	  		  if (val>12)val-=12;
	  		  else if(val==0)val=12;
	  		  return getLeadingZeros(val);
	  		}
	  	},
	  	H:{ // 24-hour format of an hour with leading zeros 00 through 23
	  		re:'\\d{2}',
	  		toJS:function(val)
	  		{
	  		  val = parseInt(val,10);
	  		  _this._date.setHours(val);
	  		  return val;
	  		},
	  		fromJS:function(val)
	  		{
	  		  if(!val)val=_this.date.getHours();
	  		  return getLeadingZeros(val);
	  		}
	  	},
	  	i:{ // Minutes with leading zeros 00 to 59
	  		re:'\\d{2}',
	  		toJS:function(val)
	  		{
	  		  val = parseInt(val,10);
	  		  _this._date.setMinutes(val);
	  		  return val;
	  		},
	  		fromJS:function(val)
	  		{
	  		  if(!val)val=_this.date.getMinutes();
	  		  return getLeadingZeros(val);
	  		}
	  	},
	  	s:{ // Seconds, with leading zeros 00 through 59
	  		re:'\\d{2}',
	  		toJS:function(val)
	  		{
	  		  val = parseInt(val,10);
	  		  _this._date.setSeconds(val);
	  		  return val;
	  		},
	  		fromJS:function(val)
	  		{
	  		  if(!val)val=_this.date.getSeconds();
	  		  return getLeadingZeros(val);
	  		}
	  	},
	  	U:{ // Seconds since the Unix Epoch (January 1 1970 00:00:00 GMT)
	  		re:'\\d+',
	  		toJS:function(val)
	  		{
	  		  val = parseInt(val,10)*1000;
	  		  _this._date.setTime(val);
	  		  return val;
	  		},
	  		fromJS:function(val)
	  		{
	  		  if(!val)val=Math.round(_this.date.getTime()/1000);
	  		  return val;
	  		}
	  	},
	  	t:{ // Number of days in the given month  	28 through 31
	  	    re:'\\d+',
	  	    toJS:function(val)
	  		{
	  		  return parseInt(val,10);
	  		},
	  		fromJS:function(val)
	  		{
	  		  if(!val)val=_this.date.getMonth();
	  		  return monthDaysCount(_this.date.getFullYear(),val);
	  		}
	  	}
  	},
  	regExp:null,
  	format:null,
  	pos:[]
  };

  function getLeadingZeros(val)
  {    val = parseInt(val,10);
    if(val<10)val='0'+val;
    return val;
  };

  function setHour()
  {
	var _s = _this.settings;
	if(_s._ampmHour > 0)
	{
	  if(_s._ampm == 'pm')
	  {
		if(_s._ampmHour < 12)
		{
		  var val = _s._ampmHour + 12;
		}
        else
        {
		  var val=12;
		}
	    _this._date.setHours(val);
      }
      else if(_s._ampm == 'am')
      {
        if(_s._ampmHour == 12)
        {          _s._ampmHour = 0;
        }
        _this._date.setHours(_s._ampmHour);
      }
    }
  };

  function setFormat(format)
  {
    var _s = _this.settings;
	format = format || _s.format;
    _format.format = format;
    position = [];
    labelPosition = [];
    var k=0;
    for(key in _format.labels)
    {
      pos = _format.format.indexOf('%'+key);
      if(pos >= 0)
      {
        position[k] = pos;
        k++;
        labelPosition[pos] = key;
      }
      format = format.replace('%'+key,'('+_format.labels[key].re+')');
    }
    function sortFunction(a, b)
    {
	  if(parseInt(a) < parseInt(b))return -1;
	  if(parseInt(a) > parseInt(b))return 1;
	  return 0
	};
    p = position.sort(sortFunction);
    _format.pos=[];
    for(i in p)
    {
      _format.pos[labelPosition[p[i]]] = (parseInt(i)+1);
    }
    _format.regExp = format;
  };

  function setDate(date)
  {
    var _s = _this.settings;
    var re = new RegExp('^'+_format.regExp+'$');
    if(_s.language != 'en')
    {
      var langEN = getLangs('en');
      var langCurr = getLangs();
      for(j in langCurr)
      {
        if(typeof(langCurr[j]) == 'object')
        {
          for(i in langCurr[j])
          {
            date = date.replace(new RegExp(langCurr[j][i],'g'),langEN[j][i]);
          }
        }
      }
    }
    if(typeof(today.dateObj) == 'object')
    {
      _this._date = new Date(today.year, today.month, today.date, today.hours, today.minutes, today.seconds);
    }
    else
    {
      _this._date = new Date();
    }

    if(re.test(date))
    {
      var result = re.exec(date);
      for(key in _format.labels)
      {
        if(_format.pos[key])
        {
          var value = _format.labels[key].toJS(result[_format.pos[key]]);
          if(isNaN(value))
          {
            value = null;
          }
          _format.labels[key].value = value;
        }
      }
    }
    return _this._date;
  };

  function checkYear(year)
  {
    var _s = _this.settings;
	year = parseInt(year);
    if(year < parseInt(_s.years.from))
    {
      year = _s.years.from;
    }
    if(year > parseInt(_s.years.till))
    {
      year = _s.years.till;
    }
    return year;
  };

  function getLangs(language)
  {
    var _s = _this.settings;
	if(language && typeof(_s.lang[language]) == 'object')
    {      return _s.lang[language];
    }
    else if(language == _s.language)
    {      for(i in _s.lang)
      {        return	_s.lang[i];
      }
    }
    else
    {
      return getLangs(_s.language);
    }
  };

  function monthDaysCount(year,month)
  {
    var D = (year%4 == 0 && (year % 100 != 0 || year % 400 == 0)) ? 1 : 0;
    var daysCount = [31,28+D,31,30,31,30,31,31,30,31,30,31];
    return daysCount[month];
  };
})(jQuery);