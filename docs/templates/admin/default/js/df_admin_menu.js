;(function($){
    $.df_admin_menu = function(options, elem){
        var docWidth = $(document).width();
        $('>li', elem).on('mouseover', function(){
            if($(document).width() > docWidth)
            {
                $('>ul', $(this)).css({right: 0 + 'px', left: 'inherit'});
            }
        });
        $('>li li', elem).on('mouseover', function(e){
            e.stopPropagation();
            $(this).siblings().children('ul').hide();
            var _this = $('>ul', $(this));
            _this.show().css({left:100 + '%', top: 0});
            setTimeout(function(){
                if($(document).width() > docWidth)
                {
                    _this.removeAttr('style').show().css({right: 100 + '%', top: 0});
                }
            }, 10);
        });
        $('>li li', elem).on('mouseout', function(){
            $(this).siblings().children('ul').hide();
        });

    }

    $.fn.df_admin_menu = function(options) {
        return this.each(function(i){
            new $.df_admin_menu(options, $(this));
        });
    };
})(jQuery);
