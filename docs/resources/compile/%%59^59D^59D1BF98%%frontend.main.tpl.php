<?php /* Smarty version 2.6.16, created on 2014-04-10 09:54:27
         compiled from frontend.main.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'frontend.main.tpl', 14, false),array('modifier', 'unescape', 'frontend.main.tpl', 56, false),)), $this); ?>
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

    <title><?php echo ((is_array($_tmp=$this->_tpl_vars['Page']->MetaTitle)) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</title>
    <link rel="stylesheet" type="text/css" href="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
css/k4_style.css">
    <!--[if IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
css/k4_ie10_style.css">
    <![endif]-->
    <link href='http://fonts.googleapis.com/css?family=Exo+2:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <?php echo '
    <script>
        (function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,\'script\',\'//www.google-analytics.com/analytics.js\',\'ga\');

        ga(\'create\', \'UA-49892616-1\', \'k4-russia.ru\');
        ga(\'send\', \'pageview\');

    </script>
    '; ?>

</head>


<body>
<div id="wrapper">
    <header id="header">
        <div class="head-content">
            <div class="head-table">
                <div class="head-column-text">
                    <?php $_from = ((is_array($_tmp=$this->_tpl_vars['HeadText'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['advantage'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['advantage']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['curr']):
        $this->_foreach['advantage']['iteration']++;
?>
                        <p class="text">
                            <?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['text'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

                        </p>
                    <?php endforeach; endif; unset($_from); ?>
                </div>
                <div class="head-column-contacts">
                    <?php if (((is_array($_tmp=$this->_tpl_vars['Config']['headerPhone'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
                        <p class="phone"><span><?php if (((is_array($_tmp=$this->_tpl_vars['Config']['headerPhoneCode'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))):  echo ((is_array($_tmp=$this->_tpl_vars['Config']['headerPhoneCode'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  endif; ?></span><?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['headerPhone'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</p>
                    <?php endif; ?>
                    <?php if (((is_array($_tmp=$this->_tpl_vars['Config']['adress'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
                        <p class="where"><span><?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['adress'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</span></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Blocks']['MainMenuBlock'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp)); ?>

        </div>
        <div class="logo">
            <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"></a>
        </div>
    </header>
        <section class="main-content">
            <div id="content-k4-h" class="content">
                <?php if (((is_array($_tmp=$this->_tpl_vars['isHome'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
                    <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Blocks']['LandingSteps'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp)); ?>

                <?php else: ?>
                    <div id="content-block">
                        <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['MainContent'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp)); ?>

                    </div>
                <?php endif; ?>
            </div>
            <div class="right-bar">
                <div class="right-logo"></div>
            </div>
            <div class="clearfix"></div>
        </section>
</div>
<footer id="footer">
    <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Blocks']['Footer'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp)); ?>

</footer>
<script type="text/javascript" src="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
js/jquery-1.10.2.min.js"></script>
<?php echo '
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
        $( \'img\' ).load(function() {
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
'; ?>

<?php echo '
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
'; ?>

</body>
</html>