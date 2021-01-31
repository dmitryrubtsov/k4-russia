<?php

/*
sleep(2);
echo ('{handler: function(){alert(this);this.find("input").val(555);}}');
exit;
*/



$errorsArray = array();

if(!isEmptyArr($_POST) && $_POST['task'] == 'medical-examination')
{

	if(isBlank($_POST['gender']))
	{
		$errorsArray['gender'] = $language["errors"][__ERROR_EMPTY_GENDER_FIELD];
	}

	if($_POST['birthDay'] == 0 || $_POST['birthMonth'] == 0 || $_POST['birthYear'] == 0)
	{
		$errorsArray['birthdate'] = $language["errors"][__ERROR_EMPTY_BIRTHDATE_FIELD];
	}

	if(isBlank($_POST['city']))
	{
		$errorsArray['selcity'] = $language["errors"][__ERROR_EMPTY_SELECT_CITY_EXAMINATION];
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
		$extraTextArray = array();
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
	       		if(preg_match('/^extra\-\d+$/s', $name))
	       		{
	        		preg_match('/^extra\-(\d+)$/s', $name, $matches);
	        		if(in_array($matches[1], $requestServiceArray))
	        		{
						$extraTextArray[$matches[1]] = $value;
	        		}
	       		}
			}
		}

    	$requestServiceString = join(",", $requestServiceArray);

    	// Find request services
		if($requestServiceString)
    	{
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
		        ->join(array('rst' => $_SQL_TABLE['request_service_type']), 'rst.request_service_type_id = rsg.request_service_type_id')
		        ->join(array('rsti' => $_SQL_TABLE['request_service_type_info']), 'rsti.request_service_type_id = rsg.request_service_type_id',
		            array(
		                'requestServiceTypeTitle' => 'title'.__FLANG
		            )
		        )
		        ->where('rssf.site_form_id = 2')
		        ->where('rs.active = 1')
		        ->where('rs.request_service_id IN ('.$requestServiceString.')')
		        ->order('rsg.position ASC')
		        ->order('rs.position ASC')
		        ->group('rs.request_service_id');
		    $requestService = $db->fetchAll($requestServiceQuery);

		    $requestServiceArray = array();
			foreach($requestService as $n => $val)
			{
				$requestServiceArray[$val['request_service_type_id']]['title'] = $val['requestServiceTypeTitle'];
			    $requestServiceArray[$val['request_service_type_id']]['types'][$val['request_service_group_id']]['title'] = $val['requestServiceGroupTitle'];
			    $requestServiceArray[$val['request_service_type_id']]['types'][$val['request_service_group_id']]['services'][$val['request_service_id']] = array(
							'title' => $val['requestServiceTitle']
				);
				if($extraTextArray[$val['request_service_id']])
				{
					$requestServiceArray[$val['request_service_type_id']]['types'][$val['request_service_group_id']]['services'][$val['request_service_id']]['extra'] = $extraTextArray[$val['request_service_id']];
				}

			}
    	}

    	if($requestServiceArray)
    	{
    		$requestServiceText = '<div>'.$language['site']['clientHasChosenFollowingServices'].'</div><br />';
    		$requestServiceTextUser = '<div>'.$language['site']['youHasChosenFollowingServices'].'</div><br />';
    		foreach($requestServiceArray as $k => $v)
    		{
    			if($v['types'])
    			{
    				$requestServiceText .= '<div>'.$v['title'].'</div><ul>';
    				$requestServiceTextUser .= '<div>'.$v['title'].'</div><ul>';
	    			foreach($v['types'] as $t => $type)
					{
						$requestServiceText .= '<li>'.$type['title'].'</li><ul>';
						$requestServiceTextUser .= '<li>'.$type['title'].'</li><ul>';
						foreach($type['services'] as $n => $service)
						{
							$requestServiceText .= '<li>'.$service['title'];
							$requestServiceTextUser .= '<li>'.$service['title'];
							if($service['extra'])
							{
								$requestServiceText .= '<br /><span>'.$service['extra'].'</span></li>';
								$requestServiceTextUser .= '<br /><span>'.$service['extra'].'</span></li>';
							}
							else
							{
								$requestServiceText .= '</li>';
								$requestServiceTextUser .= '</li>';
							}
						}
						$requestServiceText .= '</ul>';
						$requestServiceTextUser .= '</ul>';
					}
					$requestServiceText .= '</ul>';
					$requestServiceTextUser .= '</ul>';
    			}
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
		$todbarrForm['extra_info'] = $_POST['addition'];
		$todbarrForm['city_id'] = $_POST['city'];

		makeInsertList($strColumns, $strValues, $todbarrForm, array());
		insertItem($_SQL_TABLE['site_form_medical_examination'], $strColumns, $strValues);

        // Get need mail template
		$mailTemplateQuery = $db->select();
	    $mailTemplateQuery->from(array('mt' => $_SQL_TABLE['mail_template']),
	    	array(
	                'id' => 'mail_template_id',
	                'title' => 'title'.__FLANG,
	                'subject' => 'subject'.__FLANG,
	                'body' => 'body'.__FLANG
			)
	    )
	        ->where('mt.mail_template_id IN (3,6)');
	    $mailTemplates = $db->fetchAll($mailTemplateQuery);

	    foreach($mailTemplates as $k => $val)
	    {
	    	$mailTemplate[$val['id']] = $val;
	    }

	    $formularDataArray = array(
	    	'name' => $_POST['name'],
	    	'gender' => $_POST['gender'] == 'm' ? $language['front']['genderMale'] : $language['front']['genderFemale'],
	    	'birthdate' => $_POST['birthDay'].".".$_POST['birthMonth'].".".$_POST['birthYear'],
	    	'address' => $_POST['address'],
	    	'phone' => $_POST['phone'],
	    	'fax' => $_POST['fax'],
	    	'email' => $_POST['email'],
	    	'addition' => $_POST['addition'],
	    	'arrival' => $_POST['arrival'],
	    	'city' => getFieldByEnother('title'.__FLANG, $_SQL_TABLE['city_info'], 'city_id', $_POST['city']),
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

	    $bodyAdmin = str_replace($formularDataSearch, $formularDataReplace, $mailTemplate[3]['body']);
        $bodyUser = str_replace($formularDataSearch, $formularDataReplace, $mailTemplate[6]['body']);


	    $mail = new DFCms_Mail('utf-8');

		//$mail->setHeaderEncoding(Zend_Mime::ENCODING_BASE64);
		//$mail->setBodyText('Test');
		$mail->setBodyHtml($bodyAdmin)
			->setFrom($CONFIG['emailsFromEmail'], $CONFIG['emailsFromName'])
			->addTo($CONFIG['adminEmailForm'], $CONFIG['adminEmailFormTo'])
			->setSubject($mailTemplate[3]['subject']);
        $mail->send();


        $mail2 = new DFCms_Mail('utf-8');
        $mail2->setBodyHtml($bodyUser)
			->setFrom($CONFIG['emailsFromEmail'], $CONFIG['emailsFromName'])
			->addTo($_POST['email'], $_POST['name'])
			->setSubject($mailTemplate[6]['subject']);
        $mail2->send();

		echo ('{handler: function(){
					alert("'.$language['site']['medicalExaminationRequestSuccessfullySent'].'");
					$("html, body").animate({scrollTop:0}, 300);
					$(".req-field").each(function(){
						var field = $(this);
						field.parent(".form-field").prev(".form-error").css("display","none");
					});
					$("form")[0].reset();
				}}'
		);
		exit;

		//echo ('{handler: function(){alert("'.$language['site']['medicalExaminationRequestSuccessfullySent'].'");}}');
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

			var dest = $(".form-error:visible:first").offset().top - 30;
			$("html, body").animate({scrollTop:dest}, 300);

			}}');

		exit;
	}
}


?>