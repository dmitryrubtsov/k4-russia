
	$(document).ready(function()
	{
        $(window).resize(function () {
			$('#test').html($(window).width());
		});

        //copy count scroll
         $('#go_count_copy').live('click', function(){
            $("html:not(:animated),body:not(:animated)").animate({scrollTop: $("#go_count_copy").offset().top}, 500);
         });

        /*
        var countTd = $('#checkAll thead tr td').length;
        $('#checkAll .navigation').attr('colspan',countTd);

        $("#checkAll thead input:checkbox").click(function() {
			var checkedStatus = this.checked;
			$("#checkAll tbody tr td.check input:checkbox").each(function() {
				this.checked = checkedStatus;
				//this.attr("checked","checked");
				if (checkedStatus == this.checked)
				{
					$(this).closest('.checker > span').removeClass('checked');
					$(this).closest('table tbody tr').removeClass('thisRow');
				}
				if (this.checked) {
					$(this).closest('.checker > span').addClass('checked');
					$(this).closest('table tbody tr').addClass('thisRow');
				}
			});
		});
		*/

		$("a[rel^='prettyPhoto']").prettyPhoto();

		$("a.iframe").fancybox(
		{
			"frameWidth" : 500,	 // ������ ����, px (425px - �� ���������)
			"frameHeight" : 500 // ������ ����, px(355px - �� ���������)
		});

		/*$('input:checkbox').each(function(){
			$this.click(function(){
				alert('Hello, world');
			});
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

		$('.shadow, .popup .close').click(function(e) {
			$('.shadow').hide();
			$('.popup').fadeOut(200);
		});  */

		$('#put-req-amount').blur(function(){
			if($(this).val())
			{
				var moneyCount = $(this).val() * $(this).attr('data-coef');
				$('#put-req-tooltip span').html(moneyCount);
				$('#put-req-tooltip').fadeIn().css('visibility','visible');
			}
		});

		$()

	});

function OnlyNum(e)
{
	var keynum;
	var keychar;
	var numcheck;
	var return2;
	if(window.event) // IE
	{
		keynum = e.keyCode;
	}
	else if(e.which) // Netscape/Firefox/Opera
	{
		keynum = e.which;
	}
	keychar = String.fromCharCode(keynum);
	if (keynum < 45 || keynum > 57)
	{ // ��������� ������ ���� ����
		return2 = false;
		if (keynum == 8) return2 = true; // ��������� ������� ������� backspace
	}
	else return2 = true;
	return return2;
}


