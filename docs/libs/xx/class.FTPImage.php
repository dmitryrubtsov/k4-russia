<?php

	require_once __CFG_PATH_LIBS.__CFG_PATH_CORE_CLASSES."class.FTPFile.php";

	class FTPImage extends FTPFile
	{
		protected function resizeImage($Source, $XSize, $YSize, $Destination)
		{
			$imInfo = getimagesize($Source);
			$ImType = str_replace('image/', '', $imInfo['mime']);
			eval('$im = imagecreatefrom'.$ImType.'($Source);');

			$imm = imagecreatetruecolor($XSize, $YSize);
			imagecopyresampled($imm, $im, 0, 0, 0, 0, $XSize, $YSize, $imInfo[0], $imInfo[1]);
			//imagecopyresized($imm, $im, 0, 0, 0, 0, $XSize, $YSize, $imInfo[0], $imInfo[1]);
			eval('image'.$ImType.'($imm, $Destination);');
			ImageDestroy($im);
			ImageDestroy($imm);
			return $Destination;
		}

	}


?>