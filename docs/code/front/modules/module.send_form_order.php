<?php

/*
sleep(2);
echo ('{handler: function(){alert(this);this.find("input").val(123);}}');
exit;
*/

$errorsArray = array();

if(!isEmptyArr($_POST) && $_POST['task'] == 'order')
{

	/*
    if(isBlank($_POST['gender']))
	{
		$errorsArray['gender'] = $language["errors"][__ERROR_EMPTY_GENDER_FIELD];
	}
*/
	if(!preg_match("/^".$CONFIG['emailPattern']."$/", $_POST['email']))
	{
		$errorsArray['email'] = $language["errors"][__ERROR_INCORRECT_EMAIL_FIELD];
	}

	if(!preg_match("/^".$CONFIG['phonePattern']."$/", $_POST['phone']) || strlen(preg_replace('[^\d]', '', $_POST['phone'])) < 5)
	{
		$errorsArray['phone'] = $language["errors"][__ERROR_INCORRECT_PHONE_FIELD];
	}

    if(isBlank($_POST['secretcode']) || strtoupper($_POST['secretcode']) != strtoupper(getSecurityNumber()))
    {
        $errorsArray['secretcode'] = $language['errors'][__ERROR_INCORRECT_SECURITY_CODE];
    }

	if(isEmptyArr($errorsArray))
	{
        $successLink = $BaseURL."order-final".$CONFIG['webPageFileType'];

        $Item = array();
        foreach($_POST as $name => $value)
        {
            $Item[$name] = trim(strip_tags($value));
        }
        $CART = $sID->fetch('cart');
        $tpl->assign("Cart", $CART);

        if(is_array($CART['items']) && $CART['total_count'] > 0)
        {
            $db->insert($_SQL_TABLE['order'], array(
                'name' => $Item['name'],
                'email' => $Item['email'],
                'phone' => $Item['phone'],
                'comment' => $Item['comment'],
                'order_delivery_id' => $Item['delivery'],
                'order_date' => new Zend_Db_Expr('NOW()'),
                'total_count' => $CART['total_count'],
                'total_price' => $CART['total_price'],
                'order_status_id' => '1'
            ));

            $orderID = $db->lastInsertId();

            $orderNumber = 2014000 + $orderID;
            $sID->assign("orderNumber", $orderNumber);

            foreach($CART['items'] as $key => $value)
            {
                //$keyPart = explode('-', $key);

                $db->insert($_SQL_TABLE['order_product'], array(
                    'order_id' => $orderID,
                    'product_id' => $value['product_id'],
                    'count' => $value['quantity'],
                    'price' => $value['price']
                ));
            }
        }

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

        $template_dir = $tpl->template_dir;
        $tpl->template_dir = __CFG_PATH_MAIL_TEMPLATE;
        $orderTable = $tpl->fetch("mail.order_table.tpl");

        $formularDataArray = array(
            'name' => $Item['name'],
            'email' => $Item['email'],
            'phone' => $Item['phone'],
            'comment' => $Item['comment'],
            'total_count' => $CART['total_count'],
            'total_price' => $CART['total_price']." ".$CONFIG['currencySymbol'],
            'orderTable' => $orderTable
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


		$mail->setBodyHtml($bodyAdmin)
			->setFrom($CONFIG['emailsFromEmail'], $CONFIG['emailsFromName'])
			->addTo($CONFIG['adminEmailFormOrder'], $CONFIG['adminEmailFormTo'])
			->setSubject($mailTemplate[4]['subject']);
        $mail->send();

        $mail2 = new DFCms_Mail('utf-8');
        $mail2->setBodyHtml($bodyUser)
			->setFrom($CONFIG['emailsFromEmail'], $CONFIG['emailsFromName'])
			->addTo($Item['email'], $Item['name'])
			->setSubject($mailTemplate[5]['subject']);
        $mail2->send();

        unset($CART);
        $sID->assign("cart", $CART);

		echo ('{handler: function(formSubmitter){
					document.location.replace("'.$successLink.'");
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
					field.parent(".order-form-row").prev(".form-error").html(errors[name]).slideDown(200);
				}
				else
				{
					field.parent(".order-form-row").prev(".form-error").html(errors[name]).css("display","none");
				}

			});

			var dest = $(".form-error:visible:first").offset().top - 60;
			$("html, body").animate({scrollTop:dest}, 300);

			}}');

		exit;
	}
}


?>