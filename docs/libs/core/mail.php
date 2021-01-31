<?PHP

	function sendMailToUser($toEmail, $subject, $html, $text=null, $fromName="", $fromEmail="", $imageFiles=array(), $attachFiles=array())
	{
		global $CONFIG, $language;

		require_once __CFG_PATH_LIBS."mail/htmlMimeMail.php";
		require_once __CFG_PATH_LIBS."mail/mimePart.php";
		require_once __CFG_PATH_LIBS."mail/smtp.php";
		require_once __CFG_PATH_LIBS."mail/RFC822.php";

		$mail = new htmlMimeMail();

		$mail->setTextCharset($language['charset']);
		$mail->setHtmlCharset($language['charset']);
		$mail->setHeadCharset($language['charset']);
		$mail->setHtml($html, $text, './');

		foreach($imageFiles as $k => $value)
		{
			$args = array();
			array_push($args, ((is_file($value['file'])) ? file_get_contents($value['file']) : $value['file']));
			if(isset($value['name']))
			{
				array_push($args, mb_convert_encoding($value['name'], $language['charset']));
			}
			if(isset($value['c_type']))
			{
				array_push($args, $value['c_type']);
			}
			call_user_func_array(array($mail, 'addHtmlImage'), $args);
		}

		foreach($attachFiles as $k => $value)
		{
			$args = array();
			array_push($args, ((is_file($value['file'])) ? file_get_contents($value['file']) : $value['file']));
			if(isset($value['name']))
			{
				array_push($args, $value['name']);
			}
			if(isset($value['c_type']))
			{
				array_push($args, $value['c_type']);
			}
			if(isset($value['encoding']))
			{
				array_push($args, $value['encoding']);
			}
			call_user_func_array(array($mail, 'addAttachment'), $args);
		}

		if(trim($fromName) == '')$fromName = $CONFIG[supportName];
		if(trim($fromEmail) == '')$fromEmail = $CONFIG[supportEmail];
		$mail->setFrom("\"$fromName\" <$fromEmail>");
		$mail->setSubject($subject);

		if($CONFIG[BccSendMailToUser] == 'y' || $CONFIG[BccSendMailToCustSupport] == 'y' && $toEmail == $CONFIG[supportEmail])
		{
			$mail->setBcc($CONFIG[adminBccEmail]);
		}

		$mail->setHeader('Reply-To', "\"$fromName\" <$fromEmail>");
		$mail->setHeader('Sender', "\"$fromName\" <$fromEmail>");

		if(is_array($toEmail))
		{			$result = $mail->send($toEmail, $CONFIG['sendMailType']);
		}
		else
		{
			$result = $mail->send(array($toEmail), $CONFIG['sendMailType']);
		}

		return $result;
	}

function sendMailToUserFromAdminPanel($toEmail, $subject, $html, $text=null, $fromName="", $fromEmail="", $imageFiles=array(), $attachFiles=array())
{
  global $CONFIG, $language;

  require_once __CFG_PATH_LIBS_ADMIN."mail/htmlMimeMail.php";
  require_once __CFG_PATH_LIBS_ADMIN."mail/mimePart.php";
  require_once __CFG_PATH_LIBS_ADMIN."mail/smtp.php";
  require_once __CFG_PATH_LIBS_ADMIN."mail/RFC822.php";

  $mail = new htmlMimeMail();

  $mail->setTextCharset($language['charset']);
  $mail->setHtmlCharset($language['charset']);
  $mail->setHeadCharset($language['charset']);
  $mail->setHtml($html, $text, './');

  foreach($imageFiles as $k => $value)
  {
  	$args = array();
  	array_push($args, (is_file($value['file'])) ? file_get_contents($value['file']) : $value['file']);
  	if(isset($value['name']))
  	{
  		array_push($args, mb_convert_encoding($value['name'], $language['charset']));
  	}
  	if(isset($value['c_type']))
  	{
  		array_push($args, $value['c_type']);
  	}
  	call_user_func_array(array($mail, 'addHtmlImage'), $args);
  }

  foreach($attachFiles as $k => $value)
  {
  	$args = array();
  	array_push($args, ((is_file($value['file'])) ? file_get_contents($value['file']) : $value['file']));
  	if(isset($value['name']))
  	{
  		array_push($args, mb_convert_encoding($value['name'], $language['charset']));
  	}
  	if(isset($value['c_type']))
  	{
  		array_push($args, $value['c_type']);
  	}
  	if(isset($value['encoding']))
  	{
  		array_push($args, $value['encoding']);
  	}
  	call_user_func_array(array($mail, 'addAttachment'), $args);
  }

  if(trim($fromName) == '')$fromName = $CONFIG[supportName];
  if(trim($fromEmail) == '')$fromEmail = $CONFIG[supportEmail];
  $mail->setFrom("\"$fromName\" <$fromEmail>");
  $mail->setSubject($subject);
  if($CONFIG[BccSendMailToUser] == 'y' || $CONFIG[BccSendMailToCustSupport] == 'y' && $toEmail == $CONFIG[supportEmail])
  {
    $mail->setBcc($CONFIG[adminBccEmail]);
  }

  $mail->setHeader('Reply-To', "\"$fromName\" <$fromEmail>");
  $mail->setHeader('Sender', "\"$fromName\" <$fromEmail>");

  $result = $mail->send(array($toEmail));

  return $result;
}
?>