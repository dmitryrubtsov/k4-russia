<?php

/*
sleep(2);
echo ('{handler: function(){alert(this);this.find("input").val(123);}}');
exit;

 */



$errorsArray = array();

if(!isEmptyArr($_POST) && $_POST['task'] == 'contacts')
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

    if(isBlank($_POST['phone']))
    {
        $errorsArray['phone'] = $language["errors"][__ERROR_EMPTY_PHONE_FIELD];
    }
	elseif(!preg_match("/^".$CONFIG['phonePattern']."$/", $_POST['phone']) || strlen(preg_replace('[^\d]', '', $_POST['phone'])) < 5)
	{
		$errorsArray['phone'] = $language["errors"][__ERROR_INCORRECT_PHONE_FIELD];
	}

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

        $db->insert($_SQL_TABLE['site_form_contacts'], array(
            //'keyword_id' => $db->lastInsertId(),
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'message' => $_POST['message'],
            'date_create' => new Zend_Db_Expr('NOW()'),
            'status' => '1'
        ));

		$mailTemplateQuery = $db->select();
	    $mailTemplateQuery->from(array('mt' => $_SQL_TABLE['mail_template']),
	    	array(
	                'id' => 'mail_template_id',
	                'title' => 'title'.__FLANG,
	                'subject' => 'subject'.__FLANG,
	                'body' => 'body'.__FLANG
			)
	    )
	        ->where('mt.mail_template_id IN (4,5)');
	    $mailTemplates = $db->fetchAll($mailTemplateQuery);

	    foreach($mailTemplates as $k => $val)
	    {
	    	$mailTemplate[$val['id']] = $val;
	    }

	    $formularDataArray = array(
	    	'name' => $_POST['name'],
	    	'email' => $_POST['email'],
            'phone' => $_POST['phone'],
	    	'message' => $_POST['message'],
	    );
	    $formularDataSearch = array();
	    $formularDataReplace = array();

	    foreach($formularDataArray as $key => $value)
	    {
	    	$formularDataSearch[] = '{$'.$key.'}';
	    	$formularDataReplace[] = $value;
	    }

	    $bodyAdmin = str_replace($formularDataSearch, $formularDataReplace, $mailTemplate[4]['body']);
        $bodyUser = str_replace($formularDataSearch, $formularDataReplace, $mailTemplate[5]['body']);


		//$mail = new Zend_Mail('UTF-8');
		$mail = new DFCms_Mail('utf-8');

		//$mail->setHeaderEncoding(Zend_Mime::ENCODING_BASE64);
		//$mail->setBodyText('Test');
		$mail->setBodyHtml($bodyAdmin)
			->setFrom($CONFIG['emailsFromEmail'], $CONFIG['emailsFromName'])
			->addTo($CONFIG['adminEmailFormContacts'], $CONFIG['adminEmailFormTo'])
			->setSubject($mailTemplate[4]['subject']);
        $mail->send();

        $mail = new DFCms_Mail('utf-8');
        $mail->setBodyHtml($bodyUser)
			->setFrom($CONFIG['emailsFromEmail'], $CONFIG['emailsFromName'])
			->addTo($_POST['email'], $_POST['name'])
			->setSubject($mailTemplate[5]['subject']);
        $mail->send();

		echo ('{handler: function(){
					alert("'.$language['site']['youFeedbackSuccessfullySent'].'");
					$("html, body").animate({scrollTop:0}, 300);
					$(".req-field").each(function(){
						var field = $(this);
						field.val("");
						field.parent(".form-field").prev(".form-error").css("display","none");
					});
					$("#site-contacts-form").fadeOut(100);
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