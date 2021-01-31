

;(function($) {

	$.extend(true, $, {df:{}});
	$.extend(true, $.fn, {df:function(method, params){
		if(typeof($.fn.df[method]) == 'function')
		{
			return $.fn.df[method].call(this, params);
		}
		return this;
	}});

})(jQuery);