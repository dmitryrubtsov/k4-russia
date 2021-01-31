<?php


$errorsArray = array();

if(!isEmptyArr($_POST) && $_POST['task'] == 'contract')
{

	if($_POST['birthDay'] == 0 || $_POST['birthMonth'] == 0 || $_POST['birthYear'] == 0)
	{
		$errorsArray['birthdate'] = $language["errors"][__ERROR_EMPTY_BIRTHDATE_FIELD];
	}
	if(isBlank($_POST['agree']))
	{
		$errorsArray['agree'] = $language["errors"][__ERROR_NOT_AGREE_WITH_CONTRACT];
	}
	/*
	if(isBlank($_POST['email']))
	{
		$errorsArray['email'] = $language["errors"][__ERROR_EMPTY_EMAIL_FIELD];
	}
	elseif(!preg_match("/^".$CONFIG['emailPattern']."$/", $_POST['email']))
	{
		$errorsArray['email'] = $language["errors"][__ERROR_INCORRECT_EMAIL_FIELD];
	}
	*/
    /*
	if(!preg_match("/^".$CONFIG['phonePattern']."$/", $_POST['phone']) || strlen(preg_replace('[^\d]', '', $_POST['phone'])) < 5)
	{
		$errorsArray['phone'] = $language["errors"][__ERROR_INCORRECT_PHONE_FIELD];
	}
	*/
    /*
	if(isBlank($_POST['message']))
	{
		$errorsArray['message'] = $language["errors"][__ERROR_EMPTY_MESSAGE_FIELD];
	}
	*/

	if(isEmptyArr($errorsArray))
	{
        foreach($_POST as $name => $value)
		{
			$_POST[$name] = trim(strip_tags($value));
		}

		$languageID = getFieldByEnother('language_id', $_SQL_TABLE['language'], 'code2', __LANG);
        /*
		$todbarr = array();
		$todbarr['name'] = $_POST['name'];
		$todbarr['email'] = $_POST['email'];
		$todbarr['message'] = $_POST['message'];
		$todbarr['language_id'] = $languageID;
		$todbarr['date_sent'] = 'NOW()';


		makeInsertList($strColumns, $strValues, $todbarr, array('date_sent'));
		insertItem($_SQL_TABLE['site_form_message'], $strColumns, $strValues);
         */

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
	        ->where('mt.mail_template_id IN (10)');
	    $mailTemplates = $db->fetchAll($mailTemplateQuery);

	    foreach($mailTemplates as $k => $val)
	    {	    	$mailTemplate[$val['id']] = $val;	    }

	    $formularDataArray = array(
	    	'name' => $_POST['name'],
	    	'lastname' => $_POST['lastname'],
	    	'birthdate' => $_POST['birthDay'].".".$_POST['birthMonth'].".".$_POST['birthYear'],
	    	'address' => $_POST['address'],
	    	'diagnosis' => $_POST['diagnosis'],
	    	'cost' => $_POST['cost'],
	    );
	    $formularDataSearch = array();
	    $formularDataReplace = array();

	    foreach($formularDataArray as $key => $value)
	    {
	    	$formularDataSearch[] = '{$'.$key.'}';
	    	$formularDataReplace[] = $value;
	    }

	    $bodyAdmin = str_replace($formularDataSearch, $formularDataReplace, $mailTemplate[10]['body']);

        /************************************************************/
        $articleQuery = $db->select();
	    $articleQuery->from(array('a' => $_SQL_TABLE['article']))
	        ->join(array('ai' => $_SQL_TABLE['article_info']), 'a.article_id = ai.article_id'
	        )
	        ->where('a.article_id IN (74,75)');
	    $article = $db->fetchAll($articleQuery);

	    $NeedArticles = array();
	    foreach($article as $n => $value)
	    {
	    	$NeedArticles[$value['article_id']] = $value;
	    }


		//$NeedArticles = getTableAsArrayByKeyField($_SQL_TABLE['article_info'], 'article_id', '', array("article_id IN ('75','74')"), '', 'article_id, body'.__FLANG);
		$tpl->assign('NeedArticles', $NeedArticles);

		$tpl->assign("POST", $_POST);

		$tpl->template_dir = __CFG_PATH_MAIL_TEMPLATE;
		$Body = $tpl->fetch("mail.contract_pdf.tpl");

		require_once __CFG_PATH_MPDF."mpdf.php";
		$mpdf = new mPDF();
		$mpdf->charset_in = 'utf-8';
		$stylesheet = file_get_contents('http://'.$_SERVER['SERVER_NAME'].'/style.css');
		$mpdf->WriteHTML($stylesheet,1);
		$mpdf->WriteHTML($Body, 2);

		// a random hash will be necessary to send mixed content
		$separator = md5(time());

		// carriage return type (we use a PHP end of line constant)
		$eol = PHP_EOL;



		// encode data (puts attachment in proper format)
		$mpdf->Output(__CFG_CORE_PATH.'lastContract.pdf', "F");

		$mail = new DFCms_Mail('utf-8');

		$mail->setBodyHtml($bodyAdmin)
			->setFrom($CONFIG['emailsFromEmail'], $CONFIG['emailsFromName'])
			->addTo($CONFIG['adminEmailForm'], $CONFIG['adminEmailFormTo'])
			->setSubject($mailTemplate[10]['subject']);

		$mail->createAttachment(file_get_contents(__CFG_CORE_PATH.'lastContract.pdf'),
                              'application/pdf',
                              Zend_Mime::DISPOSITION_ATTACHMENT,
                              Zend_Mime::ENCODING_BASE64,
                              $_POST['name'].'_'.$_POST['lastname'].'.pdf');

		$mail->send();

		echo ('{handler: function(){
					alert("'.$language['site']['contractSuccessfullySent'].'");
					$("html, body").animate({scrollTop:0}, 300);
					$(".req-field").each(function(){
						var field = $(this);
						field.parent(".form-field").prev(".form-error").css("display","none");
					});
					$("form")[0].reset();
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

			var dest = $(".form-error:visible:first").offset().top - 30;
			$("html, body").animate({scrollTop:dest}, 300);

		}}');

		exit;
	}
}


?>