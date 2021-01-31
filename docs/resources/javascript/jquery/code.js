	Cufon.replace('h1', { fontFamily: 'Myriad Pro Bold Condensed', hover: true });
	Cufon.replace('h4', { fontFamily: 'Myriad Pro Regular', hover: true });
	Cufon.replace('.mpro', { fontFamily: 'Myriad Pro Regular', hover: true });

	$(document).ready(function()
	{
        $('#mainslider').slides({
			play: 6000,
			pause: 6000,
			fadeSpeed: 450,
			effect: 'fade',
			hoverPause: true
		});

		$('.shadow, .popup .close').click(function(e) {
			$('.shadow').hide();
			$('.popup').fadeOut(200);
		});


        /**
		* for each menu element, on mouseenter,
		* we enlarge the image, and show both sdt_active span and
		* sdt_wrap span. If the element has a sub menu (sdt_box),
		* then we slide it - if the element is the last one in the menu
		* we slide it to the left, otherwise to the right
		*/
        /*      $('#sdt_menu > li').bind('mouseenter',function(){
			var $elem = $(this);
			$elem.find('img')
				 .stop(true)
				 .animate({
					'width':'165px',
					'height':'165px',
					'left':'0px'
				 },400,'easeOutBack')
				 .andSelf()
				 .find('.sdt_wrap')
			     .stop(true)
				 .animate({'top':'140px'},500,'easeOutBack')
				 .andSelf()
				 .find('.sdt_active')
			     .stop(true)
				 .animate({'height':'165px'},300,function(){
				var $sub_menu = $elem.find('.sdt_box');
				if($sub_menu.length){
					var left = '165px';
					if($elem.parent().children().length == $elem.index()+1)
						left = '-165px';
					$sub_menu.show().animate({'left':left},200);
				}
			});
		}).bind('mouseleave',function(){
			var $elem = $(this);
			var $sub_menu = $elem.find('.sdt_box');
			if($sub_menu.length)
				$sub_menu.hide().css('left','0px');

			$elem.find('.sdt_active')
				 .stop(true)
				 .animate({'height':'0px'},300)
				 .andSelf().find('img')
				 .stop(true)
				 .animate({
					'width':'0px',
					'height':'0px',
					'left':'85px'},400)
				 .andSelf()
				 .find('.sdt_wrap')
				 .stop(true)
				 .animate({'top':'25px'},500);
		});

		$('#bannerscollection_kenburns_generous').bannerscollection_kenburns({
			skin: 'generous',
			responsive:true,
			width: 990,
			height: 500,
			width100Proc:false,
			numberOfThumbsPerScreen:7,
			thumbsOnMarginTop:14,
			thumbsWrapperMarginTop: -110,
			autoHideBottomNav:true
		});

        $("area[rel^='prettyPhoto']").prettyPhoto();

		$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: true});
		$(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});

		$("#custom_content a[rel^='prettyPhoto']:first").prettyPhoto({
			custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
			changepicturecallback: function(){ initialize(); }
		});

		$("#custom_content a[rel^='prettyPhoto']:last").prettyPhoto({
			custom_markup: '<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',
			changepicturecallback: function(){ _bsap.exec(); }
		});

        /*$("a.gallery").fancybox();

		var firstli = $('#mainmenu-left');
		var firstitem = $('#first-item');
		var firstitema = firstitem.children().eq(0);

		if(!firstli.hasClass('mainmenu-left-hover') && !firstitema.hasClass('curr'))
		{
			firstitem.bind("mouseover", function(){
				firstli.removeClass('mainmenu-left');
				firstli.addClass('mainmenu-left-hover');
				firstitema.css('paddingLeft', '0');
			});
			firstitem.bind("mouseout", function(){
				firstli.removeClass('mainmenu-left-hover');
				firstli.addClass('mainmenu-left');
			});
		}

		if(firstitema.hasClass('curr'))
		{
			firstli.removeClass('mainmenu-left');
			firstli.addClass('mainmenu-left-hover');
			firstitema.css('paddingLeft', '0');
		}

		var lastli = $('#mainmenu-right');
		var lastitem = $('#last-item');
		var lastitema = lastitem.children().eq(0);

		if(!lastli.hasClass('mainmenu-right-hover') && !lastitema.hasClass('curr'))
		{
			lastitem.bind("mouseover", function(){
				lastli.removeClass('mainmenu-right');
				lastli.addClass('mainmenu-right-hover');
				lastitema.css('paddingRight', '0');
			});
			lastitem.bind("mouseout", function(){
				lastli.removeClass('mainmenu-right-hover');
				lastli.addClass('mainmenu-right');
			});
		}
		if(lastitema.hasClass('curr'))
		{
			lastli.removeClass('mainmenu-right');
			lastli.addClass('mainmenu-right-hover');
			lastitema.css('paddingRight', '0');
		}
		else
		{
			lastli.removeClass('mainmenu-right-hover');
			lastli.addClass('mainmenu-right');
		}
		*/

		// refresh images on captcha
		$('.re-cpt').each(function(){
			$(this).click(function(){
				var img = $(this).prev('img');
				if(img.length)
				{
					img.attr('src', (img.attr('src')+'&'+Math.random(999)));
				}
				return false;
			});
		});

		$('form .input-form').each(function()
			{
				var input = $(this);

				input.val(input.attr('title'));
				input.focus(function()
				{
					if(input.val() == input.attr('title'))
					{
						input.val('');
					}
				});

			input.blur(function()
			{
				if(!input.val())
				{
					input.val(input.attr('title'));
				}
			});
		});

		$('form').df('formSubmitter',{
			validateCallback: function(formSubmitter){
				var emptyFlag = false;
				this.find(':input').each(function()
				{
					var obj = $(this);
					if(obj.hasClass(formSubmitter.getOptions().submitButtonClassName) || obj.hasClass('not-req'))
					{
						return false;
					}
					if(obj.hasClass('input-form') && obj.val() == obj.attr('title'))
					{
						emptyFlag = true;
					}
				});
				if(emptyFlag)
				{
					formSubmitter.getElems().button.prev('.form-not-send').slideDown(200);
				}
				else
				{
					formSubmitter.getElems().button.prev('.form-not-send').slideUp(200);
				}
				return emptyFlag;
			}
		});


	});


function show_modal(id){
	if ($(id).length){
		$('.shadow').css({opacity:0.7}).show();
		$(id).fadeIn(300);
	}
}

function show_more()
{
	var button = $('#button-more');
    var url = button.find('a').attr('href');
	var mainblock = $('#page-content');

	$.ajax({
		type: "POST",
		url: url,
		success:function(result){
			button.remove();
			mainblock.append(result);
  		},
      data: {act: "showmore"}
	});
}

