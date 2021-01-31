$(document).ready(function(){

    //var $ = jQuery;


    $('body').append("<div  id='size_m'>" + $(window).width() + "</div>");
    $('#size_m').css({position: 'fixed', top:'100px', 'zIndex': 1000, left: '10px', backgroundColor: 'rgba(89, 89,161, 0.8)',fontWeight: 'bold', fontSize: '15px', padding:'5px', color:'#FFC236', borderRadius:'9px'});
    $(window).resize(function () {
        $('#size_m').html($(window).width());
    });

    var stepBlockHeight = 60;
    $('.step-block-text').each(function(){
        if($(this).height() > stepBlockHeight)
        {
            stepBlockHeight = $(this).height();
        }
    });
    $('.step-block-text').each(function(){
        $(this).height(stepBlockHeight);
    });



/*
    $("#to-top").click(function(){
        $(this).removeAttr("href");
        $("html, body").animate({scrollTop:0},"slow");
    });

    var superAction = $('#super-action');
    var superActionPlace = $('#super-action-place');
    superActionPlace.height(superAction.height());

    setTimeout(function() {
        superAction.css({
            'top':superActionPlace.offset().top + 'px'
        });
    }, 2000);

    $(window).resize(function () {
        superAction.css({
            'top':superActionPlace.offset().top + 'px'
        });
    });

    setInterval(function() {
        superAction.css({
            'top':superActionPlace.offset().top + 'px'
        });
    }, 1000);


    $('.shadow, .popup .close').click(function(e) {
        $('.shadow').hide();
        $('.popup').fadeOut(200);
    });

    //$('#mysel').customStyle1();

/*
    $("a[rel^='prettyPhoto']").prettyPhoto({
        socialToolsCallback: function($item){
            var imageId = $item.attr('data-imageId');
            var rand = Math.random();
            var cleanUrl = $("meta[property='og:url']").attr('content');
            var location_href_encoded = encodeURIComponent(cleanUrl + '?hash=' + location.hash.substring(1));
            var location_href = location.href;

            var cnt = ' \
				<div style="margin-bottom:-20px;"><div class="like-button"><iframe src="//www.facebook.com/plugins/like.php?href='+location_href_encoded+'&amp;send=false&amp;layout=button_count&amp;show_faces=true&amp;font=verdana&amp;colorscheme=light&amp;action=like&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:21px;" allowTransparency="true"></iframe></div> \
				<div class="like-button"><a href="https://twitter.com/share" class="twitter-share-button" data-url="'+location_href_encoded+'" data-via="VDesyatnikova" data-lang="ru">Твитнуть</a> \
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs'+ rand +'");</script></div> \
				<div id="vk_like'+ rand +'" class="like-button"></div><script type="text/javascript">VK.Widgets.Like("vk_like'+rand+'", {type: "mini", pageUrl: "'+location_href_encoded+'", height: 18}, '+imageId+');</script> \
				<div class="like-ok"><a target="_blank" class="mrc__plugin_uber_like_button" href="http://connect.mail.ru/share" data-mrc-config="{\'cm\' : \'1\', \'ck\' : \'3\', \'sz\' : \'20\', \'st\' : \'1\', \'tp\' : \'ok\'}">Нравится</a> \
				<script src="http://cdn.connect.mail.ru/js/loader.js" type="text/javascript" charset="UTF-8"></script></div><div class="clear">&nbsp;</div> \
				</div>';
            return cnt;
        }
    });
    */

    /*

    $('#category-list li :checkbox').each(function(){
        var item = $(this);
        item.change(function(){

            if(item.attr('rel')=='all')
            {
                $('#category-list li :checkbox').each(function(){
                    if($(this).attr('rel')!='all')
                    {
                        $(this).removeAttr('checked');
                        $(this).parent('li').css('display','block');
                        $(this).parent('li').next().css('display','none');
                    }
                });
            }
            else
            {
                var parent = $("#category-list input[rel='all']");
                parent.removeAttr('checked');
                parent.parent('li').css('display','block');
                parent.parent('li').next().css('display','none');
            }

            item.parent('li').next().css('display','block');
            item.parent('li').css('display','none');
            item.attr('checked', 'checked');
        });
    });

    $('#category-list li.selected').each(function(){
        var item = $(this);
        item.click(function(){
            item.prev().css('display','block');
            item.prev().children('input').removeAttr('checked');
            item.css('display','none');
        });
    });

    $('#type-list li :checkbox').each(function(){
        var item = $(this);
        item.change(function(){

            if(item.attr('rel')=='all')
            {
                $('#type-list li :checkbox').each(function(){
                    if($(this).attr('rel')!='all')
                    {
                        $(this).removeAttr('checked');
                        $(this).parent('li').css('display','block');
                        $(this).parent('li').next().css('display','none');
                    }
                });
            }
            else
            {
                var parent = $("#type-list input[rel='all']");
                parent.removeAttr('checked');
                parent.parent('li').css('display','block');
                parent.parent('li').next().css('display','none');
            }

            item.parent('li').next().css('display','block');
            item.parent('li').css('display','none');
            item.attr('checked', 'checked');
        });
    });

    $('#type-list li.selected').each(function(){
        var item = $(this);
        item.click(function(){
            item.prev().css('display','block');
            item.prev().children('input').removeAttr('checked');
            item.css('display','none');
        });
    });


    // refresh images on captcha
    $('.cptch').each(function(){
        $(this).click(function(){
            var img = $(this).prev('img');
            if(img.length)
            {
                img.attr('src', (img.attr('src')+'&'+Math.random(999)));
            }
            return false;
        });
    });

    // DF form submitter
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
        //debug: true,
        validateCallback: function(formSubmitter){
            var emptyFlag = false;
            this.find(':input').each(function()
            {
                var obj = $(this);
                if(obj.hasClass(formSubmitter.getOptions().submitButtonClassName) || obj.hasClass('not-req'))
                {
                    return false;
                }

                if(obj.hasClass('req-field') && (obj.val() == '' || obj.val() == obj.attr('title')))
                {
                    emptyFlag = true;
                }
            });
            if(emptyFlag)
            {
                formSubmitter.getElems().button.parent('.order-form-button').prev('.form-not-send').slideDown(200);
            }
            else
            {
                formSubmitter.getElems().button.parent('.order-form-button').prev('.form-not-send').slideUp(200);
            }
            return emptyFlag;
        }
    });

*/

});

function show_modal(id){
    if($(id).length){
        $('.shadow').css({opacity:0.7}).show();
        $(id).css({
            'left': $(window).width()/2 - $(id).width()/2 + 'px',
            'top': $(document).scrollTop() + 20 + 'px'
        }).fadeIn(300);
    }
}
/*
function addSomeItemToShoppingCart($id)
{
    var url = $('#a-' + $id).attr('href');
    var navBlock = $('#shopping-cart');
    var navBlockMini = $('#shopping-cart-mini');

    $.ajax({
        type: "POST",
        url: url,
        success:function(result){
            navBlock.empty();
            navBlock.html(result);
            navBlockMini.empty();
            navBlockMini.html(result);
        },
        data: {
            act: "itemtocart",
            id: $id
        }
    });
}

function deleteSomeItemFromShoppingCart($id)
{
    var url = $('.remove-' + $id).attr('href');
    var navBlock = $('#shopping-cart');
    var navBlockMini = $('#shopping-cart-mini');

    $.ajax({
        type: "POST",
        url: url,
        success:function(result){
            navBlock.empty();
            navBlock.html(result);
            navBlockMini.empty();
            navBlockMini.html(result);
        },
        data: {
            act: "itemfromcart",
            id: $id
        }
    });

}
    */