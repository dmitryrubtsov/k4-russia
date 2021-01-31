<?php

/* получатели */
$to= "nikolife86@mail.ru" . ", " ; //обратите внимание на запятую
$to .= "nick.sun86@gmail.com";
/*
$to .= "d.mas.ja@gmail.com" . ", ";
$to .= "info@df-studio.net";
*/

/* тема/subject */
$subject = "Main test 1";

/* сообщение */
$message = '
<html xmlns="http://www.w3.org/1999/xhtml">
<head>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
<link href="http://fonts.googleapis.com/css?family=Questrial" rel="stylesheet" type="text/css">

<style type="text/css">
/*
*Project:	B&M - Responsive Email Template
*Version:	1.0
*Creat:		01/13/14
*Author: 	digith
*Website: 	http://themeforest.net/user/digith
*/

/* Client-specific Styles */
  #outlook a { padding: 0; }
  .ReadMsgBody { width: 100%; }
  .ExternalClass { width: 100%; }
  body { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; }
  .yshortcuts, .yshortcuts a, .yshortcuts a:link, .yshortcuts a:visited, .yshortcuts a:hover, .yshortcuts a span { text-decoration: none !important; border-bottom: none !important; background: none !important; }

/* Reset styles */
  body { width: 100% !important; margin: 0; padding: 0; }
  h1, p { margin: 0 0 10px !important; }
  h2,h3, h4, h5, h6 { margin: 0 0 5px !important; }
  table { border-collapse: collapse; }
  table[align=left], table[align=right] { border: none; mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
  img { border: 0; display: block; -ms-interpolation-mode: bicubic; }
  a img { border:0;}
  .img-inline { display: inline; border: 0; vertical-align:-3px;}
  .small-img{font-size:0px; line-height:0px; border-collapse:collapse;}
  .BGtable { height: 100% !important; margin: 0; padding: 0; width: 100% !important; }
  br { line-height: 20px; }

/*Default Email template setting*/

/*link style*/
  a { color: #04b99e;  text-decoration: none ; outline: none; }
  .menu a { color: #c1c9cc; }
  .home a { color: #5c656f; }
  .dark a, .dark-gray a, .color a, .button-gray a { color:#fff; }
  .footer a { color: #eee; }
  a:hover { text-decoration:underline !important; }
  .button a:hover { text-decoration:none !important; }

/*background*/
  body, .BGtable	{ background-color: #26292c; }
  .light			{ background-color:#34383c;}
  .dark-gray		{ background-color:#2F3336;}
  .d-gray			{ background-color:#2d3134;}
  .button-gray		{ background-color:#656871;}
  .color			{ background-color:#04b99e;}/*color-bg*/
  .dark				{ background-color: #1f2227; }
  .gray 			{ background-color: #3d4850; }
  .header-img{ background-image: url(http://digith.net/b-m/img/header-bg1.jpg); background-repeat:repeat; background-position:center top; background-size:900px 400px; }
  .header-img2{ background-image: url(http://digith.net/b-m/img/header-bg2.jpg); background-repeat:repeat; background-position:center top; background-size:900px 400px; }

/*font*/
  .content, .content p, h4, .h4, h5, .h5 {
  		font-family: Questrial,Arial,Tohama;
		font-size: 13px;
		line-height: 20px;
		font-weight: 400;
		color: #ccd3db;
		-webkit-font-smoothing: antialiased;
  }
  .button .content{color:#383c40;}
  .dark .content, .dark .content p, .dark-gray .content, .dark-gray .content p, .color .content, .color .content p
  {color:#fff;}
  .dark.content, .dark.content p, .dark-gray.content, .dark-gray.content p, .color.content, .color.content p
  {color:#fff;}
  h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5 { font-family: Questrial,Arial,Tohama; color: #fff; font-weight: 400; vertical-align:baseline; }
  h1, .h1 { font-size: 36px; line-height:36px; font-weight:bold; }
  h2, .h2 { font-size: 24px; line-height:30px; }
  h3, .h3 { font-size: 18px; line-height:24px; }
  h4, .h4 { font-size: 16px; line-height:20px; }
  h5, .h5 { font-size: 14px; line-height:20px; /*font-weight:700;*/ }
  .big-price{ font-size:48px; line-height:48px; color:#fff;}
  .color h1, .color .h1, .color h2, .color .h2,  .color h3, .color .h3, .color h4, .color .h4, .color h5, .color .h5  {color:#fff;}
  .italic { font-style: italic; }
  .hlight { color: #04b99e;  font-style: italic; }
  .hlight2 { color: #04b99e; }
  .white{color:#fff;}
  .justify{text-align: justify;}
  .thin{font-weight:300;}
  .old-price{font-weight:300; text-decoration:line-through;}

/*border radius*/
  .home{-moz-border-radius: 4px;border-radius: 4px;}
  .button td{-moz-border-radius: 18px;border-radius: 18px; display:block;}
  .img-border{-webkit-border-radius: 60px;-moz-border-radius: 60px;border-radius: 60px; display:block;}
  .tag{-moz-border-radius: 0 0 15px 15px;border-radius: 0 0 15px 15px; }
/*table size*/
	.wrap{width:600px; margin:0 auto;}
	.row{width:600px; margin:0 auto;}
	.col-1-3{width:200px;}
	.col-2-3{width:380px;}
	.col2{width:50%;}
	.col3{width:192px;}
/*border*/
	.content-border	{ border:#44474e 1px solid;border-top:none; background-color:#2f3336;}
	.comment-border	{ border:#44474e 1px solid;border-bottom:none;background-color:#2f3336;}
	.wrap-border	{ border:#44474e 1px solid; background-color:#2f3336;}
	.border-bottom	{ border-bottom:#44474e 1px solid;}
	.color-border	{ border-top:#04b99e 2px solid;}
	.white-border	{ border:#fff 1px solid;}
	.dashed-border	{ border-bottom:#414850 1px dotted;}
	.img-border		{ border:#04b99e 3px solid; }

/*margin and padding*/

	/*button-box*/
	.button { display:inline-block;}
	.button .in{padding:5px 17px;}
	.button .header-button{padding:5px 50px;}
	/*module padding*/
	.header-content-td{padding:30px;}
	.p-r-10{padding-right:10px;}
	.img-title{padding: 10px 20px;}
	.no-top{padding-top:0px;}
	.module-td { padding: 0 10px; }
	.header-td { padding: 10px; }
	.module-td.alone { padding: 15px 10px; }
	.logo td{padding:0 10px;}
	.no-top{padding-top:0px;}
	.normal-L-td{padding:0 20px 0 0;}
	.space{height:18px;width:100px;}
	.tag{ padding:3px 10px;}
	/*img box padding and style*/
	.img-rounded .in { padding: 0 10px 0 0; }
	.img-rounded2 .in { padding: 0 20px 0 0; }
	/*common padding*/
	.general-td { padding: 10px 10px 0 10px; }
	.general-img-td { padding: 10px; }
	.LR-price{ padding-top: 25px; padding-bottom:25px; }
	.full-content-td { padding: 20px; }
	.cols-content-td { padding: 15px 20px; }
	.col3 .general-img-td,.col3 .general-td{padding-right:9px;}
	/*menu*/
	.menu-box{height:30px;padding: 15px 0;}
	.menu .content{ padding: 5px 10px;}
	/*footer*/
	.footer-left td { text-align: left; }
	.footer-right td { text-align: right; }

/*Max img */
	.img { width:600px; max-width: 600px ; }
	.col1 .img{ width:560px; max-width:560px;}
	.col2 .img{ width:270px; max-width:270px;}
	.col3 .img{ width:173px; max-width:173px;}
	.col-1-3 .img{ width:180px; max-width:180px;}
	.col-2-3 .img{ width:360px; max-width:360px;}
	.img_172{ width:172px; max-width:172px;}
	.s-social{ width:16px; height:16px; max-width:16px; max-height:16px;}
	.social{ width:32px; height:32px; max-width:32px; max-height:32px;}
	.hIcon{ width:55px; height:61px; max-width:55px; max-height:61px;}
	.lable{ height:18px; max-height:18px; max-width:25px;}


@media only screen and (max-width: 599px) {
table[class~=wrap]							{ width: 440px !important; }
/*table[class~=wrap]						{ width: 440px !important; }*/
table[class~=row]							{ width: 440px !important; }
/*tables*/
table[class=footer-left]					{ width: 100% !important; }
table[class=footer-left] td					{ text-align: center !important; }
table[class=footer-right]					{ width: 100% !important; }
table[class=footer-right] td				{ text-align: center !important;}
td[class~=col2],td[class~=col-1-3],td[class~=col-2-3]{ display:block !important; float:left !important;}
td[class~=col2]								{ width:100% !important;}
td[class~=col-1-3]							{ width:100% !important;}
td[class~=col-2-3]							{ width:100% !important;}
table[class~=col3]							{ width:80% !important;margin:0 auto !important; float:none !important;}
table[class~=logo]							{ width:100% !important;margin-bottom:10px !important;}
td[class~=menu-box]							{ height:40px !important;}
td[class~=header-content-td]				{ height:240px !important;}
td[class~=nH]								{ height:10px !important;}
/*img*/
img 										{ height: auto !important; }
img[class~=img]								{ width: 100% !important; height: auto !important; max-width:100% !important; display:block !important;}
img[class~=img_s2]							{ width:150px !important;}
img[class~=comment-border-img]				{ width:100% !important;}
/*padding and margin*/
table[class~=menu-tb]						{ float:none !important; margin:0 auto !important;}
table[class~=menu] td						{ text-align:center !important;}
td[class~=header]							{ padding-bottom:10px !important;}
td[class~=normal-L-td]						{ padding:20px !important;}
td[class~=banner-btn]						{ padding:5px 20px 10px !important;}
table[class~=col3] .general-img-td, table[class~=col3] .general-td{ padding-right:10px !important;}
td[class~=center]							{ text-align:center !important;padding:10px !important;}
td[class~=banner-text]						{ text-align:center !important;}
td[class~=LR-price]							{ padding-top:10px !important;padding-bottom:10px !important;}
td[class~=menu-box]							{ padding:0 !important;}
/*display*/
td[class~=space]							{ display:none !important;}
}
@media only screen and (max-width: 439px) {
table[class~=wrap]							{ width: 100% !important; }
table[class~=row]							{ width: 100% !important; }
table[class~=menu-tb]						{ width:100% !important;}
table[class~=col3]							{ width:100% !important;}
img[class~=img_s2]							{ width:100px !important;}
table[class~=logo] img						{ max-width:100% !important;}
table[class~=menu] .content					{ padding: 4px 5px !important;}
}
@media only screen and (max-width: 339px) {
table[class~=menu-tb]						{ width:100% !important;}
table[class~=logo] img						{ max-width:260px !important;}
table[class~=menu] .content					{ padding: 4px 5px !important;}
}
</style>
</head>
<body style="margin:0;padding:0;width:100%;height:100%;">



<div class="preheader" style="display:none; visibility:hidden; height:0px; font-size:0px; line-height:0px;">Email Newsletter of this month.</div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="BGtable">
  <tbody><tr>
    <td valign="top" class="BGtable-inner">

      <!-- start header-area -->
      <table width="100%" border="0" cellpadding="0" cellspacing="0" class="wrap dark">
        <tbody><tr>
          <td class="header-modules">
<!-- start ?header-4s? -->
            <table width="100%" border="0" cellpadding="0" cellspacing="0" class="wrap header-img2" background="http://digith.net/b-m/img/header-bg2.jpg">
              <tbody><tr>
                <td>
                  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="row">
                    <tbody><tr>
                      <td height="110" align="center" class="header-td header">

                      <img src="images/logo1.png" width="100" height="110" alt="logo"></td>
                    </tr>
                  </tbody></table>
                  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="row">
                    <tbody><tr>
                      <td height="240" align="center" class="header-content-td no-top">
                      <h1 class="h1">20% OFF This Week</h1>
                      <h2 class="h2"><strong>Shopping mail</strong><br>
                        <span class="hlight2"><strong>B &amp; M Email Newsletter</strong></span></h2><br>
                      <table border="0" cellpadding="0" cellspacing="0" class="button">
                                <tbody><tr>
                                  <td class="header-button h3 thin white-border"><a href="#">Read More</a></td>
                                </tr>
                        </tbody></table>
                      </td>
                    </tr>
                  </tbody></table>
                </td>
              </tr>
            </tbody></table>
            <!-- end - ?header-4s? -->
</td>
        </tr>
      </tbody></table>
      <!-- end - header-area -->

      <!-- start light module area -->
      <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="wrap light">
        <tbody><tr>
          <td class="main-modules">
<!-- start ?space15px? -->
            <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="row">
              <tbody><tr>
                <td height="15" class="small-img"></td>
              </tr>
            </tbody></table>
            <!-- end - ?space15px? -->

<!-- start ?col3-icons-text-button? -->
            <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="row">
              <tbody><tr>
                <td class="module-td">

                  <!--start col3 big-icon+text row1-->
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody><tr>
                      <td>

                        <!--col3 big-icon1 + text 1-->
                        <table width="192" border="0" align="left" cellpadding="0" cellspacing="0" class="col3">
                          <tbody><tr>
                            <td align="center" class="general-td"><img src="images/rocket.png" alt="icon1" width="55" height="61" class="hIcon">                            </td>
                          </tr>
                          <tr>
                            <td align="center" class="general-img-td content">
                              <h3 class="h3"><a href="#">Aenean ligula dolor</a></h3>
                              <p>Nunc at velit quis lectus nonummy eleifend. Curabitur eros.</p>
                              <table border="0" cellpadding="0" cellspacing="0" class="button">
                                <tbody><tr>
                                  <td class="in content color"><a href="#">Read More<img src="images/arrow.png" alt="arrow" width="12" height="18" class="img-inline"></a></td>
                                </tr>
                              </tbody></table>
                            </td>
                          </tr>
                        </tbody></table>
                        <!--end col3 big-icon1 + text 1-->

                        <!--col3 big-icon2 + text 2-->
                        <table width="192" border="0" align="left" cellpadding="0" cellspacing="0" class="col3">
                          <tbody><tr>
                            <td align="center" class="general-td"><img src="images/icon_gear.png" alt="icon2" width="55" height="61" class="hIcon"></td>
                          </tr>
                          <tr>
                            <td align="center" class="general-img-td content">
                              <h3 class="h3"><a href="#">Aenean ligula dolor</a></h3>
                              <p>Nunc at velit quis lectus nonummy eleifend. Curabitur eros.</p>
                              <table border="0" cellpadding="0" cellspacing="0" class="button">
                                <tbody><tr>
                                  <td class="in content color"><a href="#">Read More<img src="images/arrow.png" alt="arrow" width="12" height="18" class="img-inline"></a></td>
                                </tr>
                              </tbody></table>
                            </td>
                          </tr>
                        </tbody></table>
                        <!--end col3 big-icon2 + text 2-->

                        <!--col3 big-icon3 + text 3-->
                        <table width="192" border="0" align="center" cellpadding="0" cellspacing="0" class="col3">
                          <tbody><tr>
                            <td align="center" valign="top" class="general-td"><img src="images/Shoping-cart.png" alt="icon3" width="55" height="61" class="hIcon"></td>
                          </tr>
                          <tr>
                            <td align="center" valign="top" class="content general-img-td">
                              <h3 class="h3"><a href="#">Aenean ligula dolor</a></h3>
                              <p>Nunc at velit quis lectus nonummy eleifend. Curabitur eros.</p>
                              <table border="0" cellpadding="0" cellspacing="0" class="button">
                                <tbody><tr>
                                  <td class="in content color"><a href="#">Read More<img src="images/arrow.png" alt="arrow" width="12" height="18" class="img-inline"></a></td>
                                </tr>
                              </tbody></table>
                            </td>
                          </tr>
                        </tbody></table>
                        <!--end col3 big-icon3 + text 3-->

                      </td>
                    </tr>
                  </tbody></table>
                  <!--end col3 big-icon+text row1-->
                </td>
              </tr>
            </tbody></table>
            <!-- end - ?col3-icons-text-button? -->

<!-- start ?full-module-divider? -->
            <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="row">
              <tbody><tr>
                <td height="15" class="small-img dashed-border"></td>
              </tr>
              <tr>
                <td height="15" class="small-img"></td>
              </tr>
            </tbody></table>
            <!-- end - ?full-module-divider? -->

<!-- start ?full-title-2s? -->
            <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="row">
              <tbody><tr>
                <td class="module-td">

                  <!--title-->
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody><tr>
                      <td class="general-img-td h2"><span class="hlight2">»</span> Sed quis convallis ante, <span class="hlight2">id rhoncus</span></td>
                    </tr>
                  </tbody></table>

                </td>
              </tr>
            </tbody></table>
            <!-- end - ?full-title-2s? -->

<!-- start ?col2-img-color-title-bg? -->
            <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="row">
              <tbody><tr>
                <td class="module-td">

                  <!--row1 img+text-->
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody><tr>

                      <!--col1 img+text-->
                      <td valign="top" class="col2">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tbody><tr>
                            <td class="general-img-td"><img src="http://placehold.it/360x200/0d6053/fff" alt="img" width="270" height="150" class="img" hspace="0" vspace="0" border="0">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody><tr>
                                  <td class="img-title color h5">
                                    Man | 20% OFF by this week</td>
                                  </tr>
                                </tbody></table>
                              </td>
                          </tr>
                        </tbody></table>
                      </td>

                      <!--col2 img+text-->
                      <td valign="top" class="col2">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tbody><tr>
                            <td class="general-img-td"><img src="http://placehold.it/360x200/0d6053/fff" alt="img" width="270" height="150" class="img" hspace="0" vspace="0" border="0">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody><tr>
                                  <td class="img-title color h5">
                                    Women | 20% OFF by this week</td>
                                  </tr>
                              </tbody></table></td>
                          </tr>
                        </tbody></table>
                      </td>

                    </tr>
                  </tbody></table>

                </td>
              </tr>
            </tbody></table>
            <!-- end - ?col2-img-color-title-bg? -->

<!-- start ?col2-img-color-title-bg? -->
            <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="row">
              <tbody><tr>
                <td class="module-td">

                  <!--row1 img+text-->
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody><tr>

                      <!--col1 img+text-->
                      <td valign="top" class="col2">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tbody><tr>
                            <td class="general-img-td"><img src="http://placehold.it/360x200/0d6053/fff" alt="img" width="270" height="150" class="img" hspace="0" vspace="0" border="0">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody><tr>
                                  <td class="img-title color h5">
                                    Man | 20% OFF by this week</td>
                                  </tr>
                                </tbody></table>
                              </td>
                          </tr>
                        </tbody></table>
                      </td>

                      <!--col2 img+text-->
                      <td valign="top" class="col2">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tbody><tr>
                            <td class="general-img-td"><img src="http://placehold.it/360x200/0d6053/fff" alt="img" width="270" height="150" class="img" hspace="0" vspace="0" border="0">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody><tr>
                                  <td class="img-title color h5">
                                    Women | 20% OFF by this week</td>
                                  </tr>
                              </tbody></table></td>
                          </tr>
                        </tbody></table>
                      </td>

                    </tr>
                  </tbody></table>

                </td>
              </tr>
            </tbody></table>
            <!-- end - ?col2-img-color-title-bg? -->

<!-- start ?col2-img-color-title-bg? -->
            <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="row">
              <tbody><tr>
                <td class="module-td">

                  <!--row1 img+text-->
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody><tr>

                      <!--col1 img+text-->
                      <td valign="top" class="col2">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tbody><tr>
                            <td class="general-img-td"><img src="http://placehold.it/360x200/0d6053/fff" alt="img" width="270" height="150" class="img" hspace="0" vspace="0" border="0">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody><tr>
                                  <td class="img-title color h5">
                                    Man | 20% OFF by this week</td>
                                  </tr>
                                </tbody></table>
                              </td>
                          </tr>
                        </tbody></table>
                      </td>

                      <!--col2 img+text-->
                      <td valign="top" class="col2">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tbody><tr>
                            <td class="general-img-td"><img src="http://placehold.it/360x200/0d6053/fff" alt="img" width="270" height="150" class="img" hspace="0" vspace="0" border="0">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody><tr>
                                  <td class="img-title color h5">
                                    Women | 20% OFF by this week</td>
                                  </tr>
                              </tbody></table></td>
                          </tr>
                        </tbody></table>
                      </td>

                    </tr>
                  </tbody></table>

                </td>
              </tr>
            </tbody></table>
            <!-- end - ?col2-img-color-title-bg? -->

<!-- start ?full-module-divider? -->
            <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="row">
              <tbody><tr>
                <td height="15" class="small-img dashed-border"></td>
              </tr>
              <tr>
                <td height="15" class="small-img"></td>
              </tr>
            </tbody></table>
            <!-- end - ?full-module-divider? -->

<!-- start ?full-title-2s? -->
            <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="row">
              <tbody><tr>
                <td class="module-td">

                  <!--title-->
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody><tr>
                      <td class="general-img-td h2"><span class="hlight2">»</span> Sed quis convallis ante, <span class="hlight2">id rhoncus</span></td>
                    </tr>
                  </tbody></table>

                </td>
              </tr>
            </tbody></table>
            <!-- end - ?full-title-2s? -->

<!-- start ?col2-best-seller-hot-sale? -->
            <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="row">
              <tbody><tr>
                <td class="module-td">

                  <!--row1 img+text-->
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody><tr>

                      <!--col1 img+text-->
                      <td valign="top" class="col2">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tbody><tr>
                            <td class="general-img-td"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tbody><tr>
                                  <td class="wrap-border">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tbody><tr>
                                        <td class="general-img-td h4"><span class="hlight2"><strong>»</strong></span><strong> Best Seller</strong></td>
                                      </tr>
                                      <tr>
                                        <td class="general-img-td">
                                          <table border="0" align="left" cellpadding="0" cellspacing="0" class="img-rounded">
                                            <tbody><tr>
                                              <td class="in">
                                              <img src="http://placehold.it/64x64/0d6053/fff" alt="img" width="64" height="64" hspace="0" vspace="0" border="0"></td>
                                            </tr>
                                            </tbody></table>
                                          <div class="h5">Proin - Curabitur a sodales</div>
                                          <h5 class="content">Category Name</h5>
                                          <div class="h5">$109.99</div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="general-img-td">
                                          <table border="0" align="left" cellpadding="0" cellspacing="0" class="img-rounded">
                                            <tbody><tr>
                                              <td class="in">
                                              <img src="http://placehold.it/64x64/0d6053/fff" alt="img" width="64" height="64" hspace="0" vspace="0" border="0"></td>
                                            </tr>
                                            </tbody></table>
                                          <div class="h5">Proin - Curabitur a sodales</div>
                                          <h5 class="content">Category Name</h5>
                                          <div class="h5">$109.99</div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="general-img-td">
                                          <table border="0" align="left" cellpadding="0" cellspacing="0" class="img-rounded">
                                            <tbody><tr>
                                              <td class="in">
                                              <img src="http://placehold.it/64x64/0d6053/fff" alt="img" width="64" height="64" hspace="0" vspace="0" border="0"></td>
                                            </tr>
                                            </tbody></table>
                                          <div class="h5">Proin - Curabitur a sodales</div>
                                          <h5 class="content">Category Name</h5>
                                          <div class="h5">$109.99</div>
                                        </td>
                                      </tr>
                                    </tbody></table>
                                  </td>
                                  </tr>
                              </tbody></table>
                              </td>
                          </tr>
                        </tbody></table>
                      </td>

                      <!--col2 img+text-->
                      <td valign="top" class="col2">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tbody><tr>
                            <td class="general-img-td">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tbody><tr>
                                  <td class="wrap-border">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tbody><tr>
                                        <td class="general-img-td h4"><span class="hlight2"><strong>»</strong></span><strong> Hot Sales</strong></td>
                                      </tr>
                                      <tr>
                                        <td class="general-img-td">
                                          <table border="0" align="left" cellpadding="0" cellspacing="0" class="img-rounded">
                                            <tbody><tr>
                                              <td class="in">
                                              <img src="http://placehold.it/64x64/0d6053/fff" alt="img" width="64" height="64" hspace="0" vspace="0" border="0"></td>
                                            </tr>
                                            </tbody></table>
                                          <div class="h5">Proin - Curabitur a sodales</div>
                                          <h5 class="content">Category Name</h5>
                                          <div class="h5"><span class="old-price">$199.99</span> - $109.99</div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="general-img-td">
                                          <table border="0" align="left" cellpadding="0" cellspacing="0" class="img-rounded">
                                            <tbody><tr>
                                              <td class="in">
                                              <img src="http://placehold.it/64x64/0d6053/fff" alt="img" width="64" height="64" hspace="0" vspace="0" border="0"></td>
                                            </tr>
                                            </tbody></table>
                                          <div class="h5">Proin - Curabitur a sodales</div>
                                          <h5 class="content">Category Name</h5>
                                          <div class="h5"><span class="old-price">$199.99</span> - $109.99</div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="general-img-td">
                                          <table border="0" align="left" cellpadding="0" cellspacing="0" class="img-rounded">
                                            <tbody><tr>
                                              <td class="in">
                                              <img src="http://placehold.it/64x64/0d6053/fff" alt="img" width="64" height="64" hspace="0" vspace="0" border="0"></td>
                                            </tr>
                                            </tbody></table>
                                          <div class="h5">Proin - Curabitur a sodales</div>
                                          <h5 class="content">Category Name</h5>
                                          <div class="h5"><span class="old-price">$199.99</span> - $109.99</div>
                                        </td>
                                      </tr>
                                    </tbody></table>
                                  </td>
                                </tr>
                            </tbody></table></td>
                          </tr>
                        </tbody></table>
                      </td>

                    </tr>
                  </tbody></table>

                </td>
              </tr>
            </tbody></table>
            <!-- end - ?col2-best-seller-hot-sale? -->

<!-- start ?space15px? -->
            <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="row">
              <tbody><tr>
                <td height="15" class="small-img"></td>
              </tr>
            </tbody></table>
            <!-- end - ?space15px? -->

<!-- start ?color-banner-1s? -->
            <table width="100%" border="0" cellpadding="0" cellspacing="0" class="wrap color">
              <tbody><tr>
                <td>
                  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="row">
                    <tbody><tr>
                      <td class="module-td alone">

                        <!--row1 col-2-3 img + col-1-3 text-->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tbody><tr>

                            <!--col-2-3 img-->
                            <td width="380" valign="top" class="col-2-3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tbody><tr>
                                <td class="general-img-td banner-text">
                                  <h3 class="h3 thin">Cras placerat tortor viverra eros gravida.</h3>
                                  <div class="h5">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                                </td>
                              </tr>
                            </tbody></table></td>

                            <!--col-1-3 text-->
                            <td width="180" align="center" valign="middle" class="col-1-3">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody><tr>
                                  <td align="center" class="cols-content-td banner-btn">
                                    <table border="0" align="center" cellpadding="0" cellspacing="0" class="button">
                                      <tbody><tr>
                                        <td class="in white-border h5"><a href="#">Read More<img src="images/arrow.png" alt="arrow" width="12" height="18" class="img-inline"></a></td>
                                      </tr>
                                    </tbody></table>
                                  </td>
                                </tr>
                              </tbody></table>
                            </td>
                          </tr>
                        </tbody></table>

                      </td>
                    </tr>
                  </tbody></table>
                </td>
              </tr>
            </tbody></table>
            <!-- end - ?color-banner-1s? -->
</td>
        </tr>
      </tbody></table>
      <!-- end light module area -->

      <!-- start bottom1s -->
      <table width="100%" border="0" cellpadding="0" cellspacing="0" class="wrap gray">
        <tbody><tr>
          <td>
            <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="row">
              <tbody><tr>
                <td class="module-td alone">

                  <!--row1 img+text-->
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody><tr>

                      <!--col1 img+text-->
                      <td valign="top" class="col2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tbody><tr>
                          <td class="general-img-td content"><img src="images/bottom-logo.png" width="98" height="35" alt="logo">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit et tincidunt ligula. </p>
                            <a href="#"><img src="images/social-icon1.png" alt="social-icon1" width="32" height="32" class="img-inline social"></a><a href="#"><img src="images/social-icon2.png" alt="social-icon2" width="32" height="32" class="img-inline social"></a><a href="#"><img src="images/social-icon3.png" alt="social-icon3" width="32" height="32" class="img-inline social"></a><a href="#"><img src="images/social-icon4.png" alt="social-icon4" width="32" height="32" class="img-inline social"></a><a href="#"><img src="images/social-icon5.png" alt="social-icon5" width="32" height="32" class="img-inline social"></a><a href="#"><img src="images/social-icon6.png" alt="social-icon6" width="32" height="32" class="img-inline social"></a></td>
                        </tr>
                      </tbody></table></td>

                      <!--col2 img+text-->
                      <td valign="top" class="col2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tbody><tr>
                          <td class="general-img-td">
                          <h2 class="h2">Address</h2>
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody><tr>
                              <td width="1%"><img src="images/s-lable.png" alt="lable" width="17" height="14" class="img-inline"></td>
                              <td class="content">Your Street Name 123,</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td class="content">Your City Name, Country Name</td>
                            </tr>
                            <tr>
                              <td><img src="images/s-phone.png" alt="phone" width="20" height="14" class="img-inline"></td>
                              <td class="content">(999) 1234-5678</td>
                            </tr>
                            <tr>
                              <td><img src="images/s-website.png" alt="website" width="20" height="14" class="img-inline"></td>
                              <td class="content"><a href="#" class="white">www.YourWebSite.com</a></td>
                            </tr>
                          </tbody></table></td>
                        </tr>
                      </tbody></table></td>

                    </tr>
                  </tbody></table>

                </td>
              </tr>
            </tbody></table>
          </td>
        </tr>
      </tbody></table>
      <!-- end - bottom1s -->

      <!-- start footer -->
      <table width="100%" border="0" cellpadding="0" cellspacing="0" class="wrap dark">
        <tbody><tr>
          <td><table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="row footer">
            <tbody><tr>
              <td align="center" class="general-img-td content">

                <!--footer left-->
                <table border="0" align="left" cellpadding="0" cellspacing="0" class="footer-left">
                  <tbody><tr>
                    <td class="content">Copyright © 2006 - 2013 B &amp; M. </td>
                  </tr>
                </tbody></table>

                <!--footer right-->
                <table border="0" align="right" cellpadding="0" cellspacing="0" class="footer-right">
                  <tbody><tr>
                    <td class="content"><a href="#">Online Version</a> | <a href="#">Forward</a> | <a href="#">Unsubscribe</a></td>
                  </tr>
                </tbody></table>

              </td>
            </tr>
          </tbody></table></td>
        </tr>
      </tbody></table>
      <!-- end - footer -->

    </td>
  </tr>
</tbody></table>
</body>
</html>
';

/* Для отправки HTML-почты вы можете установить шапку Content-type. */
$headers= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";



if(mail($to, $subject, $message, $headers))
{	print_r('Mail testing No 1');}
else
{	print_r('Some error');}

exit;


$_BODY_SMARTY_TEMPLATE = $CONFIG['ModulesFolder']."module.test.tpl";


?>