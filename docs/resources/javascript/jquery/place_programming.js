
	$(document).ready(function()
	{
		var mainBlock = $('#main');

		$('.main-img-bg').click(function(e) {

			if(mainBlock.attr('rel') == 1)
			{
				mainBlock.attr("rel", 2);
				//alert(e.pageX + ':' + e.pageY);

				$.ajax({
					type: "POST",
					url: mainBlock.data('url'),
					success:function(result){
						//load = 1;
						//alert('Test 2');
						var placeId = result;
						mainBlock.append('<div class="each-place" id="' + result + '"><ul id="navi"><li id="left"></li><li id="top"></li><li id="right"></li><li id="bottom"></li></ul></div>');
						var needPlace = $('#' + result);
						needPlace.css({
							left: e.pageX - 5,
							top: e.pageY - 5,
						});
						$('#main #left').click(function() {
							needPlace.css('left', parseInt(needPlace.css('left')) - 1);
						});
						$('#main #top').click(function() {
							needPlace.css('top', parseInt(needPlace.css('top')) - 1);
						});
						$('#main #right').click(function() {
							needPlace.css('left', parseInt(needPlace.css('left')) + 1);
						});
						$('#main #bottom').click(function() {
							needPlace.css('top', parseInt(needPlace.css('top')) + 1);
						});
						mainBlock.data('currPlace', result);

						/*needPlace.dblclick(function() {
							$('#add-place-form').fadeIn();
						});*/
			  		},
					data: {
						act: "place_to_base",
						hall_id: mainBlock.data('hall'),
					}
				});

				$(this).click(function(i) {
					$('#' + mainBlock.data('currPlace')).css({
						left: i.pageX - 5,
						top: i.pageY - 5,
					});
				});




				$(document).keyup(function (e) {
					if (e.which == 37 || e.which == 38 || e.which == 39 || e.which == 40)
					{

						var currPlaceId = mainBlock.data('currPlace');
						var currPlace = $('#' + currPlaceId);
						var xCoord = parseInt(currPlace.css('left'));
						var yCoord = parseInt(currPlace.css('top'));

						if(e.which == 37)
						{
							currPlace.css('left', xCoord - 1);
						}
						if(e.which == 38)
						{
							currPlace.css('top', yCoord - 1);
						}
						if(e.which == 39)
						{
							currPlace.css('left', xCoord + 1);
						}
						if(e.which == 40)
						{
							currPlace.css('top', yCoord + 1);
						}
					}
					if(e.which == 13)
					{
						$('#add-place-form').fadeIn();
					}
				});

				$('#add-coords').click(function(e) {

					$('.empty-field').each(function() {
						$(this).fadeOut();
					});

					var currPlaceId = mainBlock.data('currPlace');
					var currPlace = $('#' + currPlaceId);
					var sendFlag = false;

					var valSector = $('#add-form select[name=hall_sector_id]').val();
					var valRow = $('#add-form input[name=row]').val();
					var valPlace = $('#add-form input[name=place]').val();

					if(valSector == '')
					{
						$('#empty-sector').fadeIn();
						sendFlag = true;
					}
					if(valRow == '')
					{
						$('#empty-row').fadeIn();
						sendFlag = true;
					}
					if(valPlace == '')
					{
						$('#empty-place').fadeIn();
						sendFlag = true;
					}

					if(!sendFlag)
					{
						$.ajax({
							type: "POST",
							url: mainBlock.data('url'),
							success:function(result){

								$('#add-place-form').fadeOut();
								window.location.reload();

					  		},
							data: {
								act: "add_coords",
								id: currPlaceId,
								hall_sector_id: valSector,
								row: valRow,
								place: valPlace,
								pagex: currPlace.css('left'),
								pagey: currPlace.css('top'),
							}
						});
					}
				});

				$('.popup__close').click(function() {
				    $('#add-place-form').css('display', 'none');
				    var currPlaceId = mainBlock.data('currPlace');
					$('#' + currPlaceId).remove();
				    mainBlock.attr("rel", 1);
				});

			}
		});


        $('.all-place').each(function() {
        	var place = $(this);
        	place.click(function() {
        		var placeId = place.attr('id');

        		$.ajax({
					type: "POST",
					url: mainBlock.data('url'),
					success:function(result){
						placeInfo = result.split(',');
						$('#edit-form select[name=hall_sector_id]').val(placeInfo[0]);
						$('#edit-form input[name=row]').val(placeInfo[1]);
						$('#edit-form input[name=place]').val(placeInfo[2]);
						$('#edit-form input[name=hall_place_id]').val(placeInfo[3]);
						$('#edit-place-form').fadeIn();

			  		},
					data: {
						act: "edit_place",
						place_id: placeId,
					}
				});
        	});
        });

        $('#edit-close').click(function() {
		    $('#edit-place-form').css('display', 'none');
		});

        /*
		$('.popup__overlay').click(function() {
			$('#edit-place-form').css('display', 'none');
			$('#add-place-form').css('display', 'none');
		});
        */

		// Click Edit Button
		$('#edit-coords').click(function(e) {

			$('.empty-field').each(function() {
				$(this).fadeOut();
			});

			var sendFlag = false;
			var valRow = $('#edit-form input[name=row]').val();
			var valPlace = $('#edit-form input[name=place]').val();

			if(valRow == '')
			{
				$('#empty-row-edit').fadeIn();
				sendFlag = true;
			}
			if(valPlace == '')
			{
				$('#empty-place-edit').fadeIn();
				sendFlag = true;
			}

			if(!sendFlag)
			{
				$.ajax({
					type: "POST",
					url: mainBlock.data('url'),
					success:function(result){
						$('#edit-place-form').fadeOut();
			  		},
					data: {
						act: "edit_coords",
						id: $('#edit-form input[name=hall_place_id]').val(),
						hall_sector_id: $('#edit-form select[name=hall_sector_id]').val(),
						row: valRow,
						place: valPlace,
					}
				});
			}
		});


		// Click Delete Button
		$('#delete-coords').click(function(e) {

			$.ajax({
				type: "POST",
				url: mainBlock.data('url'),
				success:function(result){
					$('#edit-place-form').fadeOut();
					window.location.reload();
		  		},
				data: {
					act: "delete_place",
					place_id: $('#edit-form input[name=hall_place_id]').val(),
				}
			});
		});

		$('#left').css('border','1px solid blue');

	});


function OnlyNum(e)
{
	var keynum;
	var keychar;
	var numcheck;
	var return2;
	if(window.event) // IE
	{
		keynum = e.keyCode;
	}
	else if(e.which) // Netscape/Firefox/Opera
	{
		keynum = e.which;
	}
	keychar = String.fromCharCode(keynum);
	if (keynum < 45 || keynum > 57)
	{ // разрешаем только ввод цифр
		return2 = false;
		if (keynum == 8) return2 = true; // разрешаем нажатие клавиши backspace
	}
	else return2 = true;
	return return2;
}





