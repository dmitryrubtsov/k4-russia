$(document).ready(function(){
    $("a[rel^='prettyPhoto']").prettyPhoto();
// language switch

    var languageBlock = $('#lang-switch');
    var widthLanguageBlock = languageBlock.innerWidth();
    var currLanguage = $('#lang-switch a:eq(0)');
    var allLang = $('.all-languages');
    $(allLang).width($(currLanguage).outerWidth());
    $(languageBlock).css({width: widthLanguageBlock }).parents('td').css({width: widthLanguageBlock });
    currLanguage.on('click', function(el){
        el.stopPropagation();
        $(allLang).innerWidth(($(allLang).innerWidth() === widthLanguageBlock) ? $(currLanguage).outerWidth(): widthLanguageBlock);
    });
    $(document).on('click',function(e){
        if (!$(e.target).hasClass('all-languages')){
            $(allLang).innerWidth($(currLanguage).outerWidth());
        }
    });

// end language switch

    $('.new-menu').df_admin_menu();
});

	function checkItems(checkvalue)
	{
		var itemsList = $('input[name^="item"]');

		itemsList.each(function() {
			this.checked = checkvalue;
		});
	}

	function itemCheck(id)
	{		document.getElementById(id).checked='true';	}
