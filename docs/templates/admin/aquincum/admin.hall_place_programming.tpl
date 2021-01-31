<html>
	<head>
		<link href="{$HOST}{$Config.cssPath}place_programming.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/jquery.fancybox-1.3.4.pack.js"></script>
        <script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/jquery.easing-1.3.pack.js"></script>
        <script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/jquery.mousewheel-3.0.4.pack.js"></script>
        <script type="text/javascript" src="{$HOST}{$Config.JSPath}jquery/place_programming.js"></script>
		<title>{$lang.admin.userRequestOutputCreate}</title>
	</head>
<body>
<div id="main" rel="1" data-url="http://{$Config.SiteDomain}/{$language}/place-programming{$Config.webPageFileType}" data-hall="{$HallInfo.hall_id}" data-curr-place="">
	<div class="main-img-bg">
		<img src="http://{$Config.SiteDomain}/{$HallInfo.orig_path}" width="{$HallInfo.orig_width}" height="{$HallInfo.orig_height}" />
	</div>
	<div class="popup__overlay" id="add-place-form">
	    <div class="popup">
	        <a href="#" class="popup__close">X</a>
	        <h2>{$lang.admin.recordNewLocationOnMap}</h2>
	        <p>{$lang.admin.recordNewLocationOnMapInstruction}</p>
	        <form method="post" action="" name="add-new-place" id="add-form">
				<input type="hidden" name="task" value="add" />
		        <div class="popup-form__row">
		            <label for="popup-form_login">{$lang.admin.selectHallSector}</label>
		            <select name="hall_sector_id">
							<option value="">{$lang.admin.selectHallSector}</option>
						{foreach from=$HallSectorSelect item=curr key=key name="sectors"}
							<option value="{$curr.hall_sector_id}" {if $smarty.post.hall_sector_id eq $curr.hall_sector_id} selected{/if}>{$curr.title}</option>
						{/foreach}
					</select>
		        </div>
		        <div class="empty-field" id="empty-sector">{$lang.admin.youMustSelectHallSector}</div>
		        <div class="popup-form__row">
		            <label for="popup-form_password">{$lang.admin.enterHallRow}</label>
		            <input type="text" name="row" size="5" maxlength="3" {if $smarty.post.row} value="{$smarty.post.row}"{/if} onkeypress="return OnlyNum(event)" />
		        </div>
		        <div class="empty-field" id="empty-row">{$lang.admin.youMustEnterHallRow}</div>
		        <div class="popup-form__row">
		            <label for="popup-form_password">{$lang.admin.enterHallPlace}</label>
		            <input type="text" name="place" size="5" maxlength="3" {if $smarty.post.place} value="{$smarty.post.place}"{/if} onkeypress="return OnlyNum(event)" />
		        </div>
		        <div class="empty-field" id="empty-place">{$lang.admin.youMustEnterHallPlace}</div>
		        <br />
		        <center>
					<a class="buttonS bGreen" id="add-coords" >
						{$lang.admin.buttonWriteHallPlace}
					</a>
				</center>
			</form>
	    </div>
	</div>
	<div class="popup__overlay" id="edit-place-form">
	    <div class="popup">
	        <a href="#" class="popup__close" id="edit-close">X</a>
	        <h2>{$lang.admin.editLocationOnMap}</h2>
	        <p>{$lang.admin.editLocationOnMapInstruction}</p>
	        <form method="post" action="" id="edit-form">
				<input type="hidden" name="hall_place_id" value="" />
		        <div class="popup-form__row">
		            <label for="popup-form_login">{$lang.admin.selectHallSector}</label>
		            <select name="hall_sector_id">
						{foreach from=$HallSectorSelect item=curr key=key name="sectors"}
							<option value="{$curr.hall_sector_id}" {if $smarty.post.hall_sector_id eq $curr.hall_sector_id} selected{/if}>{$curr.title}</option>
						{/foreach}
					</select>
		        </div>
		        <div class="popup-form__row">
		            <label for="popup-form_password">{$lang.admin.enterHallRow}</label>
		            <input type="text" name="row" size="5" maxlength="3" {if $smarty.post.row} value="{$smarty.post.row}"{/if} onkeypress="return OnlyNum(event)" />
		        </div>
		        <div class="empty-field" id="empty-row-edit">{$lang.admin.youMustEnterHallRow}</div>
		        <div class="popup-form__row">
		            <label for="popup-form_password">{$lang.admin.enterHallPlace}</label>
		            <input type="text" name="place" size="5" maxlength="3" {if $smarty.post.place} value="{$smarty.post.place}"{/if} onkeypress="return OnlyNum(event)" />
		        </div>
		        <div class="empty-field" id="empty-place-edit">{$lang.admin.youMustEnterHallPlace}</div>
		        <br />
		        <center>
					<a class="buttonS bBlue" id="edit-coords" >
						{$lang.admin.buttonEditHallPlace}
					</a>
					&nbsp;&nbsp;&nbsp;
					<a class="buttonS bRed" id="delete-coords" >
						{$lang.admin.buttonDeleteHallPlace}
					</a>
				</center>
			</form>
	    </div>
	</div>
	{foreach from=$PlacesArray item=curr key=key name="allplaces"}
		{if $curr.pagex neq 0 || $curr.pagey neq 0}
			<div class="all-place" id="{$curr.hall_place_coordinate_id}" style="left:{$curr.pagex}; top:{$curr.pagey}"></div>
		{/if}
	{/foreach}
</div>


</body>
</html>