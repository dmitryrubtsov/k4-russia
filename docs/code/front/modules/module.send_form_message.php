<?php

/*
sleep(2);
echo ('{handler: function(){alert(this);this.find("input").val(123);}}');
exit;

 */



$errorsArray = array();

if(!isEmptyArr($_POST) && $_POST['task'] == 'message')
{

	if(isBlank($_POST['name']))
	{
		$errorsArray['name'] = $language["errors"][__ERROR_EMPTY_NAME_FIELD];
	}

	if(isBlank($_POST['email']))
	{
		$errorsArray['email'] = $language["errors"][__ERROR_EMPTY_EMAIL_FIELD];
	}
	elseif(!preg_match("/^".$CONFIG['emailPattern']."$/", $_POST['email']))
	{
		$errorsArray['email'] = $language["errors"][__ERROR_INCORRECT_EMAIL_FIELD];
	}
    /*
	if(!preg_match("/^".$CONFIG['phonePattern']."$/", $_POST['phone']) || strlen(preg_replace('[^\d]', '', $_POST['phone'])) < 5)
	{
		$errorsArray['phone'] = $language["errors"][__ERROR_INCORRECT_PHONE_FIELD];
	}
	*/

	if(isBlank($_POST['message']))
	{
		$errorsArray['message'] = $language["errors"][__ERROR_EMPTY_MESSAGE_FIELD];
	}

	if(isEmptyArr($errorsArray))
	{
        foreach($_POST as $name => $value)
		{
			$_POST[$name] = trim(strip_tags($value));
		}

		$languageID = getFieldByEnother('language_id', $_SQL_TABLE['language'], 'code2', __LANG);

		$todbarr = array();
		$todbarr['name'] = $_POST['name'];
		$todbarr['email'] = $_POST['email'];
		$todbarr['message'] = $_POST['message'];
		$todbarr['language_id'] = $languageID;
		$todbarr['date_sent'] = 'NOW()';


		makeInsertList($strColumns, $strValues, $todbarr, array('date_sent'));
		insertItem($_SQL_TABLE['site_form_message'], $strColumns, $strValues);


		//$tr = new Zend_Mail_Transport_Sendmail();

		$mailTemplateQuery = $db->select();
	    $mailTemplateQuery->from(array('mt' => $_SQL_TABLE['mail_template']),
	    	array(
	                'id' => 'mail_template_id',
	                'title' => 'title'.__FLANG,
	                'subject' => 'subject'.__FLANG,
	                'body' => 'body'.__FLANG
			)
	    )
	        ->where('mt.mail_template_id IN (8,9)');
	    $mailTemplates = $db->fetchAll($mailTemplateQuery);

	    foreach($mailTemplates as $k => $val)
	    {	    	$mailTemplate[$val['id']] = $val;	    }

	    $formularDataArray = array(
	    	'name' => $_POST['name'],
	    	'email' => $_POST['email'],
	    	'message' => $_POST['message'],
	    );
	    $formularDataSearch = array();
	    $formularDataReplace = array();

	    foreach($formularDataArray as $key => $value)
	    {
	    	$formularDataSearch[] = '{$'.$key.'}';
	    	$formularDataReplace[] = $value;
	    }

	    $bodyAdmin = str_replace($formularDataSearch, $formularDataReplace, $mailTemplate[8]['body']);
        $bodyUser = str_replace($formularDataSearch, $formularDataReplace, $mailTemplate[9]['body']);


		//$mail = new Zend_Mail('UTF-8');
		$mail = new DFCms_Mail('utf-8');

		//$mail->setHeaderEncoding(Zend_Mime::ENCODING_BASE64);
		//$mail->setBodyText('Test');
		$mail->setBodyHtml($bodyAdmin)
			->setFrom($CONFIG['emailsFromEmail'], $CONFIG['emailsFromName'])
			->addTo($CONFIG['adminEmailForm'], $CONFIG['adminEmailFormTo'])
			->setSubject($mailTemplate[8]['subject']);
        $mail->send();

        $mail = new DFCms_Mail('utf-8');
        $mail->setBodyHtml($bodyUser)
			->setFrom($CONFIG['emailsFromEmail'], $CONFIG['emailsFromName'])
			->addTo($_POST['email'], $_POST['name'])
			->setSubject($mailTemplate[9]['subject']);
        $mail->send();

		echo ('{handler: function(){
					alert("'.$language['site']['youMessageSuccessfullySent'].'");
					$("html, body").animate({scrollTop:0}, 300);
					$(".req-field").each(function(){
						var field = $(this);
						field.val("");
						field.parent(".form-field").prev(".form-error").css("display","none");
					});
					$("#site-message-form").fadeOut(100);
					$("#site-overlay").fadeOut(200);
				}}'
		);
		exit;

		//echo ('{handler: function(){alert("Vasia");}}');
		//exit;

	}
	else
	{

		$JSONErrors = json_encode($errorsArray);
		echo ('{handler: function(formSubmitter){this.find(".req-field").each(function(){
				var field = $(this);
				var errors = '.$JSONErrors.';
				var name = field.attr("name");

				if(errors[name])
				{
					field.parent(".form-field").prev(".form-error").html(errors[name]).slideDown(200);
				}
				else
				{
					field.parent(".form-field").prev(".form-error").html(errors[name]).css("display","none");
				}

			});

		}}');

		exit;
	}
}


?>