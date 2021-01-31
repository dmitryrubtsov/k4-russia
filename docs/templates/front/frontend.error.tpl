<!DOCTYPE>
<html>
<head>
  	<meta charset="utf-8" />
	<link href="{$HOST}{$Config.cssPath}style.css" rel="stylesheet" type="text/css" />
  	<title>{$lang.front.pageNotFoundTitle}</title>


</head>

<body>

	<div id="wrapper-main">
		<div id="wrapper-area">
			<header>
				<div id="header-logo">
					<div id="header-logo-area">
						<a href="{$BaseURL}" />
							<img src="{$HOST}{$Config.MainImagesFolder}tpl/header_logo.jpg" />
						</a>
					</div>
				</div>
				<div id="header-contacts">
					<div id="header-contacts-area">
						<span class="c-name">{$lang.contacts.skype}:</span><span class="c-value">{$Config.contactSkype}</span><br />
						<span class="c-name">{$lang.contacts.phone}:</span><span class="c-value">{$Config.contactPhone}</span><br />
						<span class="c-name">{$lang.contacts.fax}:</span><span class="c-value">{$Config.contactFax}</span><br />
						<span class="c-name">{$lang.contacts.mobile}:</span><span class="c-value">{$Config.contactMobile}</span><br />
						<span class="c-name">{$lang.contacts.email}:</span><span class="c-value">{$Config.contactEmail}</span><br />
					</div>
				</div>
				<div id="header-quote">
					<div id="header-quote-area">{$ArticleArray[2]|unescape}</div>
				</div>
				<div class="clear"></div>

				<div id="color-line-top">
					<div class="col-line" style="background:#dc2e42;"></div>
					<div class="col-line" style="background:#68cad4;"></div>
					<div class="col-line" style="background:#0a773c;"></div>
					<div class="col-line" style="background:#66666b;"></div>
					<div class="col-line" style="background:#a7cf40;"></div>
					<div class="col-line" style="background:#5752a3;"></div>
				</div>
			</header>

			<div id="error404">
				{$MainContent|unescape}
			</div>
		</div>
	</div>
	<footer>
		<div id="footer-area">
			<div id="color-line-bottom">
				<div class="col-line" style="background:#dc2e42;"></div>
				<div class="col-line" style="background:#68cad4;"></div>
				<div class="col-line" style="background:#0a773c;"></div>
				<div class="col-line" style="background:#66666b;"></div>
				<div class="col-line" style="background:#a7cf40;"></div>
				<div class="col-line" style="background:#5752a3;"></div>
			</div>

			<div id="footer-slogan">
				<div id="footer-slogan-area">{$Config.siteSlogan}</div>
			</div>
			<div id="footer-copy">
				<div id="footer-copy-area">{$ArticleArray[3]|unescape}</div>
			</div>
			<div id="footer-logo">
				<div id="footer-logo-area">
					<a href="{$BaseURL}" />
						<img src="{$HOST}{$Config.MainImagesFolder}tpl/footer_logo.png" />
					</a>
				</div>
			</div>
		</div>
	</footer>

</body>
</html>
