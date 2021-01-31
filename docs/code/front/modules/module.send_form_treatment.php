<?php

/*
sleep(2);
echo ('{handler: function(){alert(this);this.find("input").val(123);}}');
exit;
*/




$errorsArray = array();

if(!isEmptyArr($_POST) && $_POST['task'] == 'treatment')
{

	if(isBlank($_POST['gender']))
	{
		$errorsArray['gender'] = $language["errors"][__ERROR_EMPTY_GENDER_FIELD];
	}

	if($_POST['birthDay'] == 0 || $_POST['birthMonth'] == 0 || $_POST['birthYear'] == 0)
	{
		$errorsArray['birthdate'] = $language["errors"][__ERROR_EMPTY_BIRTHDATE_FIELD];
	}

	if(!preg_match("/^".$CONFIG['emailPattern']."$/", $_POST['email']))
	{
		$errorsArray['email'] = $language["errors"][__ERROR_INCORRECT_EMAIL_FIELD];
	}

	if(!preg_match("/^".$CONFIG['phonePattern']."$/", $_POST['phone']) || strlen(preg_replace('[^\d]', '', $_POST['phone'])) < 5)
	{
		$errorsArray['phone'] = $language["errors"][__ERROR_INCORRECT_PHONE_FIELD];
	}

	if(isEmptyArr($errorsArray))
	{
        $requestServiceArray = array();
        foreach($_POST as $name => $value)
		{
			$_POST[$name] = trim(strip_tags($value));

			if(!isBlank($value))
			{
				if(preg_match('/^n\-\d+$/s', $name))
	       		{
	        		preg_match('/^n\-(\d+)$/s', $name, $matches);
	        		$requestServiceArray[] = $matches[1];
	       		}
			}
		}

    	$requestServiceString = join(",", $requestServiceArray);

    	$requestServiceQuery = $db->select();
	    $requestServiceQuery->from(array('rssf' => $_SQL_TABLE['request_service_site_form']))
	        ->join(array('rs' => $_SQL_TABLE['request_service']), 'rs.request_service_id = rssf.request_service_id')
	        ->join(array('rsi' => $_SQL_TABLE['request_service_info']), 'rsi.request_service_id = rs.request_service_id',
	            array(
	                'requestServiceTitle' => 'title'.__FLANG
	            )
	        )
	        ->join(array('rsg' => $_SQL_TABLE['request_service_group']), 'rsg.request_service_group_id = rs.request_service_group_id')
	        ->join(array('rsgi' => $_SQL_TABLE['request_service_group_info']), 'rsgi.request_service_group_id = rs.request_service_group_id',
	            array(
	                'requestServiceGroupTitle' => 'title'.__FLANG
	            )
	        )
	        ->where('rssf.site_form_id = 1')
	        ->where('rs.active = 1')
	        ->where('rs.request_service_id IN ('.$requestServiceString.')')
	        ->order('rsg.position ASC')
	        ->order('rs.position ASC')
	        ->group('rs.request_service_id');
	    $requestService = $db->fetchAll($requestServiceQuery);

	    $requestServiceArray = array();
		foreach($requestService as $n => $val)
		{
			$requestServiceArray[$val['request_service_group_id']]['title'] = $val['requestServiceGroupTitle'];
			$requestServiceArray[$val['request_service_group_id']]['services'][$val['request_service_id']] = array(
						'title' => $val['requestServiceTitle'],
						'request_service_id' => $val['request_service_id'],
						'request_service_group_id' => $val['request_service_group_id']
			);
		}

		if($requestServiceArray)
    	{    		$requestServiceText = '<div>'.$language['site']['clientHasChosenFollowingServices'].'</div><br />';
    		$requestServiceTextUser = '<div>'.$language['site']['youHasChosenFollowingServices'].'</div><br />';
    		foreach($requestServiceArray as $key => $value)
			{
				$requestServiceText .= '<div>'.$value['title'].'</div><ul>';
				$requestServiceTextUser .= '<div>'.$value['title'].'</div><ul>';
				foreach($value['services'] as $k => $v)
				{
					$requestServiceText .= '<li>'.$v['title'].'</li>';
					$requestServiceTextUser .= '<li>'.$v['title'].'</li>';
				}
				$requestServiceText .= '</ul>';
				$requestServiceTextUser .= '</ul>';
			}
    	}
    	else
    	{
    		$requestServiceText = $language['site']['clientDidNotChooseAnyService'];
    		$requestServiceTextUser = $language['site']['youDidNotChooseAnyService'];
    	}


		$languageID = getFieldByEnother('language_id', $_SQL_TABLE['language'], 'code2', __LANG);

		$todbarr = array();
		$todbarr['site_form_type_id'] = 1;
		$todbarr['gender'] = $_POST['gender'] == 'm' ? 1 : 2;
		$todbarr['birth_date'] = $_POST['birthYear']."-".$_POST['birthMonth']."-".$_POST['birthDay'];
		$todbarr['sent_date'] = 'NOW()';
		$todbarr['language_id'] = $languageID;

		makeInsertList($strColumns, $strValues, $todbarr, array('sent_date'));
		insertItem($_SQL_TABLE['site_form'], $strColumns, $strValues);

		$siteFormID = mysql_insert_id();

		$todbarrInfo = array();
		$todbarrInfo['site_form_id'] = $siteFormID;
		$todbarrInfo['name'] = $_POST['name'];
		$todbarrInfo['address'] = $_POST['address'];
		$todbarrInfo['phone'] = $_POST['phone'];
		$todbarrInfo['fax'] = $_POST['fax'];
		$todbarrInfo['email'] = $_POST['email'];
		$todbarrInfo['arrival_date'] = $_POST['arrival'];

		makeInsertList($strColumns, $strValues, $todbarrInfo, array());
		insertItem($_SQL_TABLE['site_form_info'], $strColumns, $strValues);

		$todbarrForm = array();
		$todbarrForm['site_form_id'] = $siteFormID;
		$todbarrForm['diagnosis'] = $_POST['diagnosis'];
		$todbarrForm['diagnosis_put_date'] = $_POST['putYear']."-".$_POST['putMonth']."-1";
		$todbarrForm['diagnosis_description'] = $_POST['complaint'];
		$todbarrForm['diagnosis_pict'] = $_POST['pict'] == 'y' ? 1 : 0;

		makeInsertList($strColumns, $strValues, $todbarrForm, array());
		insertItem($_SQL_TABLE['site_form_treatment'], $strColumns, $strValues);


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
	        ->where('mt.mail_template_id IN (2,5)');
	    $mailTemplates = $db->fetchAll($mailTemplateQuery);

	    foreach($mailTemplates as $k => $val)
	    {	    	$mailTemplate[$val['id']] = $val;	    }

	    $formularDataArray = array(
	    	'name' => $_POST['name'],
	    	'gender' => $_POST['gender'] == 'm' ? $language['front']['genderMale'] : $language['front']['genderFemale'],
	    	'birthdate' => $_POST['birthDay']." ".$_POST['birthMonth']." ".$_POST['birthYear'],
	    	'address' => $_POST['address'],
	    	'phone' => $_POST['phone'],
	    	'fax' => $_POST['fax'],
	    	'email' => $_POST['email'],
	    	'diagnosis' => $_POST['diagnosis'],
	    	'putIn' => ($_POST['putMonth'] != 0 ? $_POST['putMonth'] : '').".".($_POST['putYear'] != 0 ? $_POST['putYear'] : ''),
	    	'complaint' => $_POST['complaint'],
	    	'pict' => $_POST['pict'] == 'y' ? $language['front']['have'] : $language['front']['no'],
	    	'arrival' => $_POST['arrival'],
	    	'requestService' => $requestServiceText,
	    	'requestServiceUser' => $requestServiceTextUser,
	    );
	    $formularDataSearch = array();
	    $formularDataReplace = array();

	    foreach($formularDataArray as $key => $value)
	    {
	    	$formularDataSearch[] = '{$'.$key.'}';
	    	$formularDataReplace[] = $value;
	    }

	    $bodyAdmin = str_replace($formularDataSearch, $formularDataReplace, $mailTemplate[2]['body']);
        $bodyUser = str_replace($formularDataSearch, $formularDataReplace, $mailTemplate[5]['body']);


		//$mail = new Zend_Mail('UTF-8');
		$mail = new DFCms_Mail('utf-8');

		//$mail->setHeaderEncoding(Zend_Mime::ENCODING_BASE64);
		//$mail->setBodyText('Test');
		$mail->setBodyHtml($bodyAdmin)
			->setFrom($CONFIG['emailsFromEmail'], $CONFIG['emailsFromName'])
			->addTo($CONFIG['adminEmailForm'], $CONFIG['adminEmailFormTo'])
			->setSubject($mailTemplate[2]['subject']);
        $mail->send();

        $mail2 = new DFCms_Mail('utf-8');
        $mail2->setBodyHtml($bodyUser)
			->setFrom($CONFIG['emailsFromEmail'], $CONFIG['emailsFromName'])
			->addTo($_POST['email'], $_POST['name'])
			->setSubject($mailTemplate[5]['subject']);
        $mail2->send();


		echo ('{handler: function(){					alert("'.$language['site']['treatmentRequestSuccessfullySent'].'");
					$("html, body").animate({scrollTop:0}, 300);
					$(".req-field").each(function(){
						var field = $(this);
						field.parent(".form-field").prev(".form-error").css("display","none");
					});
					$("form")[0].reset();
				}}'
		);
		exit;

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

			var dest = $(".form-error:visible:first").offset().top - 30;
			$("html, body").animate({scrollTop:dest}, 300);

			}}');

		exit;
	}
}


?>