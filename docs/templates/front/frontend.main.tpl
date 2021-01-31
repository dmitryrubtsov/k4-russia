<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=8"/>
    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <meta http-equiv="Lang" content="ru">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>{$Page->MetaTitle}</title>
    <link rel="stylesheet" type="text/css" href="{$HOST}css/k4_style.css">
    <!--[if IE 8]>
    <link rel="stylesheet" type="text/css" href="{$HOST}css/k4_ie10_style.css">
    <![endif]-->
    <link href='http://fonts.googleapis.com/css?family=Exo+2:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    {literal}
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-49892616-1', 'k4-russia.ru');
        ga('send', 'pageview');

    </script>
    {/literal}
</head>


<body>
<div id="wrapper">
    <header id="header">
        <div class="head-content">
            <div class="head-table">
                <div class="head-column-text">
                    {foreach from=$HeadText item=curr name="advantage"}
                        <p class="text">
                            {$curr.text}
                        </p>
                    {/foreach}
                </div>
                <div class="head-column-contacts">
                    {if $Config.headerPhone}
                        <p class="phone"><span>{if $Config.headerPhoneCode}{$Config.headerPhoneCode}{/if}</span>{$Config.headerPhone}</p>
                    {/if}
                    {if $Config.adress}
                        <p class="where"><span>{$Config.adress}</span></p>
                    {/if}
                </div>
            </div>
            {$Blocks.MainMenuBlock|unescape}
        </div>
        <div class="logo">
            <a href="{$HOST}"></a>
        </div>
    </header>
        <section class="main-content">
            <div id="content-k4-h" class="content">
                {if $isHome}
                    {$Blocks.LandingSteps|unescape}
                {else}
                    <div id="content-block">
                        {$MainContent|unescape}
                    </div>
                {/if}
            </div>
            <div class="right-bar">
                <div class="right-logo"></div>
            </div>
            <div class="clearfix"></div>
        </section>
</div>
<footer id="footer">
    {$Blocks.Footer|unescape}
</footer>
<script type="text/javascript" src="{$HOST}js/jquery-1.10.2.min.js"></script>
{literal}
<script type="text/javascript">

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");

    if (msie > 0){
    //console.log(h);
        var h = $("div.content").height();
        // console.log(h);
        if(h !== 0)
        {
            $("div.right-bar").height(h);
        }
    }
    else{
        $( 'img' ).load(function() {
            var h = $("div.content").height();
            if(h !== 0)
            {
                $("div.right-bar").height(h);
            }
        });
        var h = $("div.content").height();
        if(h !== 0)
        {
            $("div.right-bar").height(h);
        }
    }
</script>
{/literal}
{literal}
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter24609902 = new Ya.Metrika({id:24609902,
webvisor:true,
clickmap:true,
trackLinks:true,
accurateTrackBounce:true});
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/24609902" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
{/literal}
</body>
</html>