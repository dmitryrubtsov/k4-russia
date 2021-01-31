<?php

$errorsArray = array();

if(!isEmptyArr($_POST) && $_POST['task'] == 'forgot')
{
	if(isBlank($_POST['email']) || $_POST['email'] == $language['contacts']['email'].'*')
	{
		$errorsArray['email'] = $language["errors"][__ERROR_EMPTY_EMAIL_FIELD];
	}
	elseif(!preg_match("/^".$CONFIG['emailPattern']."$/", $_POST['email']))
	{
		$errorsArray['email'] = $language["errors"][__ERROR_INCORRECT_EMAIL];
	}
	else
	{

		$query = "	SELECT u.user_id, u.user_status_id, ui.name, ui.lastname, ua.email
					FROM ".$_SQL_TABLE['user']." u
	 				INNER JOIN ".$_SQL_TABLE['user_auth']." ua ON ua.user_id = u.user_id
	 				INNER JOIN ".$_SQL_TABLE['user_info']." ui ON ui.user_id = u.user_id
	 				WHERE ua.email = '".$_POST['email']."'
				";
		$dbSet->open($query);
		$User = $dbSet->fetchArray();

		if(!$User['user_id'])
		{
			$errorsArray['email'] = $language["errors"][__ERROR_EMAIL_NOT_FOUND];
		}
		elseif($User['user_status_id'] == 2)
		{
			$errorsArray['email'] = $language["errors"][__ERROR_EMAIL_BLOCKED_BY_ADMIN];
		}

	}

	if(isBlank($_POST['secretcode']) || $_POST['secretcode'] == $language['contacts']['enterSecretCode'].'*' || strtoupper($_POST['secretcode']) != strtoupper(getSecurityNumber()))
	{
		$errorsArray['secretcode'] = $language["errors"][__ERROR_INCORRECT_SECURITY_CODE];
	}

	if(isEmptyArr($errorsArray))
	{
        if($User['user_id'])
        {
        	$User['password'] = generate_password(10);
        	$pct->assign("User", $User);

	        $todbarrAuth = array();
			$todbarrAuth['password'] = md5($User['password']);
			makeUpdateList($strSetAuth, $todbarrAuth, array(), array());
			updateItem($_SQL_TABLE['user_auth'], $strSetAuth, 'user_id', $User['user_id']);
        }

		// mail footer
        $mailFooter = getFieldByEnother('body'.__FLANG, $_SQL_TABLE['article_info'], 'article_id', '8');
		$pct->assign("mailFooter", $mailFooter);

        // mail body
        $mailBodyUser = getFieldByEnother('body'.__FLANG, $_SQL_TABLE['article_info'], 'article_id', '14');
		$pct->assign("mailBodyUser", $mailBodyUser);


		$tpl->template_dir = __CFG_PATH_MAIL_TEMPLATE_ADMIN;
		$Body = $tpl->fetch("mail.forgot_password.tpl");
		$Subject = str_replace(' ', '_', $MailSubject['form']['newPasswordSend']);

		//$tpl->assign("POST", $_POST);

		require_once __CFG_PATH_LIBS . __CFG_PATH_CORE."mail.php";

		sendMailToUser($_POST['email'], $Subject, $Body, null, $CONFIG['SiteDomain'], $CONFIG['adminEmailForUserMailing']);

		echo ('{handler: function(){alert("'.$language['site']['newPasswordSuccessfullSent'].'");this.find(":input").each(function(){
				var input = $(this);
				input.val(input.attr("title"));
				input.prev(".form-error").slideUp(200);
			});$(".shadow").hide();$(".popup").fadeOut(200);
			$(window).attr("location","'.$BaseURL.'");}}');
		exit;
	}
	else
	{
		$JSONErrors = json_encode($errorsArray);
		echo ('{handler: function(formSubmitter){this.find(":input").each(function(){
				var field = $(this);
				var errors = '.$JSONErrors.';
				var name = field.attr("name");
				if(errors[name])
				{
					field.prev(".form-error").html(errors[name]).slideDown(200);
				}
				else
				{
					field.prev(".form-error").html(errors[name]).slideUp(200);
				}


			});}}');

		exit;
	}
}


?>