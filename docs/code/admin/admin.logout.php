<?php

	$sID->unassign("isGlobalAdmin");
	$sID->unassign("admin");
	$sID->unassign("Editor");

	unset($ADMIN);

	go_to("index.php?mode=login");
	exit;

?>