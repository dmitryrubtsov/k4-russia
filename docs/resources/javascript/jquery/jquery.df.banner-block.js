



;(function($) {

	try
	{
		$.df.bannerBlock = function(params, block){		
		    var _this = this;
			var development =
			{
				name:		'DFBannerBlock',
				version:	'1.0',
				year:		'2012'
			};
			var options = {
				debug: false,
				url: 'http://www.my-url.com',
				hideMethod: null, 	//  function(callbackHandler){}
				showMethod: null,	//  function(callbackHandler){}
				onBuild: null		//  function(banParams, bannerBlock){}
			};
			var elems = {};
			this.enableRotation = true;
		
			var init = function(settings, block)
			{
				elems.block = block;
				settings = settings || {};
				options = $.extend(true, options, settings);
				loadBanner();				
			};
			
			var build = function(banParams)
			{
				var oldA = elems.block.find('a:first');
				
				elems.block.attr('rel', banParams.id).append('<a style="display:none;"><img /></a>').find('img:last').attr({
					src: banParams.src,
					width: banParams.width,
					height: banParams.height,
					title: banParams.title,
					alt: banParams.title
				}).bind('load', function(){
					var newA = elems.block.find('a:last').attr({
						href: banParams.link,
						target: "_blank"
					});
					
					if(oldA.length)
					{
						try
						{
							options.hideMethod.call(oldA, function(){
								removeOldBanner.call(oldA);
							});
						}
						catch(e)
						{
							oldA.fadeOut(200, function(){
								removeOldBanner.call(oldA);
							});
						}
					}				
					try
					{
						options.showMethod.call(newA, function(){
							activateNewBanner.call(newA, banParams);
						});
					}
					catch(e)
					{
						newA.fadeIn(200, function(){
							activateNewBanner.call(newA, banParams);
						});
					}
					if(typeof(banParams.handler) == 'function')
					{
						banParams.handler.call(elems.block, banParams, _this);
					}
				});
				
				if(typeof(options.onBuild) == 'function')
				{
					options.onBuild.call(elems.block, banParams, _this);
				}
				
			};
			
			var removeOldBanner = function()
			{
				this.remove();
			}
			
			var activateNewBanner = function(banParams)
			{
				setTimeout(loadBanner, banParams.time*1000);
			}
			
			var loadBanner = function()
			{
				if(!_this.enableRotation)
				{
					return false;
				}
				var requestParams = 
				{
					blockBannerId: elems.block.attr('id'),
					bannerId: elems.block.attr('rel')
				};
				
				$.post(options.url, requestParams, function(data){
					if(options.debug)
					{
						alert(data);
					}				
					eval('var response = ' + data);
					response = response || {};
					build(response);
				});				
			}
			
			init(params, block);
		
		};
		
		$.fn.df.bannerBlock = function(settings)
		{
			settings = settings || {};
			//alert(this.length);
			var blocks = [];
			return this.each(function(i){				block = $(this);
				blocks[i] = new $.df.bannerBlock(settings, block);
			});
		};
	}
	catch(e)
	{
		alert("jQuery.df library is undefined. Unable to load DFBannerBlock plugin.");
	}

})(jQuery);

