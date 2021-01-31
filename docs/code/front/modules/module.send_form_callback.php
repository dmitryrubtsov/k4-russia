<?php

/*
sleep(2);
echo ('{handler: function(){alert(this);this.find("input").val(123);}}');
exit;

 */



$errorsArray = array();

if(!isEmptyArr($_POST) && $_POST['task'] == 'callback')
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

    if(isBlank($_POST['secretcode']) || strtoupper($_POST['secretcode']) != strtoupper(getSecurityNumber()))
    {
        $errorsArray['secretcode'] = $language['errors'][__ERROR_INCORRECT_SECURITY_CODE];
    }

	if(isEmptyArr($errorsArray))
    {
        $Item = array();
        foreach($_POST as $name => $value)
        {
            $Item[$name] = trim(strip_tags($value));
        }

        $db->insert($_SQL_TABLE['site_callback'], array(
            //'keyword_id' => $db->lastInsertId(),
            'name' => $Item['name'],
            'email' => $Item['email'],
            'phone' => $Item['phone'],
            'date_sent' => new Zend_Db_Expr('NOW()'),
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
	        ->where('mt.mail_template_id IN (2,3)');
	    $mailTemplates = $db->fetchAll($mailTemplateQuery);

	    foreach($mailTemplates as $k => $val)
	    {
	    	$mailTemplate[$val['id']] = $val;
	    }

	    $formularDataArray = array(
	    	'name' => $_POST['name'],
	    	'email' => $_POST['email'],
            'phone' => $_POST['phone'],
	    );
	    $formularDataSearch = array();
	    $formularDataReplace = array();

	    foreach($formularDataArray as $key => $value)
	    {
	    	$formularDataSearch[] = '{$'.$key.'}';
	    	$formularDataReplace[] = $value;
	    }

	    $bodyAdmin = str_replace($formularDataSearch, $formularDataReplace, $mailTemplate[2]['body']);
        $bodyUser = str_replace($formularDataSearch, $formularDataReplace, $mailTemplate[3]['body']);


		//$mail = new Zend_Mail('UTF-8');
		$mail = new DFCms_Mail('utf-8');

		//$mail->setHeaderEncoding(Zend_Mime::ENCODING_BASE64);
		//$mail->setBodyText('Test');
		$mail->setBodyHtml($bodyAdmin)
			->setFrom($CONFIG['emailsFromEmail'], $CONFIG['emailsFromName'])
			->addTo($CONFIG['adminEmailFormCallback'], $CONFIG['adminEmailFormTo'])
			->setSubject($mailTemplate[2]['subject']);
        $mail->send();

        $mail = new DFCms_Mail('utf-8');
        $mail->setBodyHtml($bodyUser)
			->setFrom($CONFIG['emailsFromEmail'], $CONFIG['emailsFromName'])
			->addTo($Item['email'], $Item['name'])
			->setSubject($mailTemplate[3]['subject']);
        $mail->send();

		echo ('{handler: function(){
					alert("'.$language['front']['youCallbackSuccessfullySent'].'");
					$("html, body").animate({scrollTop:0}, 300);
					$(".req-field").each(function(){
						var field = $(this);
						field.val("");
						field.parent(".popup-site-right").parent(".popup-site-form").prev(".form-error").css("display","none");
					});
					$("#callback-form").fadeOut(100);
					$(".shadow").fadeOut(200);
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
					field.parent(".popup-site-right").parent(".popup-site-form").prev(".form-error").html(errors[name]).slideDown(200);
				}
				else
				{
					field.parent(".popup-site-right").parent(".popup-site-form").prev(".form-error").html(errors[name]).css("display","none");
				}

			});

		}}');

		exit;
	}
}


?>