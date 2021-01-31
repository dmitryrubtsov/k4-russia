
	$(document).ready(function(){

	});

	function checkItems(checkvalue)
	{
		var itemsList = $('input[name^="item"]');

		itemsList.each(function() {
			this.checked = checkvalue;
		});
	}

	function itemCheck(id)
	{
		document.getElementById(id).checked='true';
	}
