

//	$('form').dfFormSubmiter({test:'TEST'});


;(function($) {

	try
	{
		$.df.formSubmitter = function(params, form){
		    var _this = this;
			var development =
			{
				name:		'DFFormSubmiter',
				version:	'1.0',
				year:		'2012'
			};
			var options =
			{
				divId: 		'dffsd'+Math.round(Math.random()*100000),
				frameId: 	'dffsf'+Math.round(Math.random()*100000),
				frameSource: 'about:blank',
				submitButtonClassName: 'df-form-submit',
				processSubmitButtonClassName: 'df-form-submit-process',
				submitCallback: function(formSubmitter, data)
				{
					eval('var response = ' + data);
					var r = response.handler.call(this, formSubmitter);
				},
				validateCallback: function(formSubmitterObject){},
				frame: {
					attrs: {
						width: 1,
						height: 1
					},
					visible: false
				}
			};
			var elems = {};

			this.getElems = function()
			{
				return elems;
			}

			this.getOptions = function()
			{
				return options;
			}

			var init = function(settings, form)
			{
				settings = settings || {};
				options = $.extend(true, options, settings);
				var button = form.find('.' + options.submitButtonClassName);
				elems = $.extend(true, elems, {
					form: form,
					button: button.length ? button : null
				});

				if(elems.button)
				{
					elems.button.bind('click', function(event){
						_this.submit();
					})
				}
			};

			this.submit = function()
			{
				if(typeof(options.validateCallback) == 'function' && options.validateCallback.call(elems.form, this) || elems.button.hasClass(options.processSubmitButtonClassName))
				{
					return false;
				}

				elems.button.addClass(options.processSubmitButtonClassName);
				build();
				elems.frame.bind('load', function(){

					var frame = $(this).contents().get(0);
					try
					{
						var url = frame.URL;
					}
					catch(e)
					{						var url = options.frameSource;
						alert('ERROR!!! There are no access to iframe document');
					}
					if(url != options.frameSource)
					{
						data = $(frame.body).html();
						if(!options.frame.visible)
						{
							destroy();
						}
						elems.button.removeClass(options.processSubmitButtonClassName);
						options.submitCallback.call(elems.form, _this, data);
					}
				});
				elems.form.submit();
			};

			var build = function()
			{
				var divId = options.divId;
				var frameId = options.frameId;
				var frameSource = options.frameSource;
				var form = elems.form;
				var div = $("#"+divId);
				var frame = $('#'+frameId);
				if(!div.length)
				{
					div = form.after('<div/>').next('div:first').attr('id', divId).css('display', ((options.frame.visible) ? 'block' : 'none'));
					frame = div.prepend('<iframe id="'+frameId+'" name="'+frameId+'" src="'+frameSource+'"></iframe>').children('iframe:first').attr(options.frame.attrs);
				}

				elems = $.extend(true, elems, {
					div:div,
					frame:frame
				});
				form.attr('target', frameId);
			};

			var destroy = function()
			{
				elems.div.remove();
			};

			init(params, form);		};


		$.fn.df.formSubmitter = function(settings)
		{
			settings = settings || {};
			//alert(this.length);
			var forms = [];
			return this.each(function(i){				form = $(this);
				forms[i] = new $.df.formSubmitter(settings, form);
			});
		};
	}
	catch(e)
	{
		alert("jQuery.df library is undefined. Unable to load DFFormSubmitter plugin.");
	}

})(jQuery);

