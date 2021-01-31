<script language="javascript">

$(function() {ldelim}

	$("#{$Field.id}").pluploadQueue({ldelim}
		runtimes : 'html5,html4',
		url : 'index.php?mode=image_uploader',
		max_file_size : {$Field.maxFileSize},
		unique_names : {$Field.uniqueNames},
		filters : [
			{ldelim}title : "Image files", extensions : "jpg,gif,png"{rdelim}
		]
	{rdelim});{rdelim});

</script>
<div id="{$Field.id}">You browser doesn't have HTML 4 support.</div>