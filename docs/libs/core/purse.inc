<?php

	function createUserDeposit($requestInfo = array(), $statusID)
	{		global $_SQL_TABLE, $CONFIG, $dbSet, $ADMIN;

		$todbarr = array();
		$todbarr['user_id'] = $requestInfo['user_id'];
		$todbarr['user_purse_type_id'] = $requestInfo['user_purse_type_id'];
		$todbarr['amount'] = $requestInfo['amount'];
		$todbarr['user_purse_status_id'] = 2;
		$todbarr['status_date'] = 'NOW()';

		makeInsertList($strColumns, $strValues, $todbarr, array('status_date'));
		if(insertItem($_SQL_TABLE['user_purse'], $strColumns, $strValues))
		{
			if(changeUserRequestStatus($requestInfo['user_request_id'], $statusID))
			{				$adminID = $ADMIN['user']['user_id'];

				if(addUserRequestStatusHistory($requestInfo, $adminID, $statusID))
				{					return true;				}			}		}	}

	function createRequestPut($requestInfo = array())
	{
		global $_SQL_TABLE, $CONFIG, $dbSet, $ADMIN;

		$requestId = createUserRequest($requestInfo);

		if($requestId)
		{
			$todbarrReqExpand = array();
			$todbarrReqExpand['user_request_id'] = $requestId;
			$todbarrReqExpand['user_purse_type_id'] = $requestInfo['user_purse_type_id'];

			makeInsertList($strColumns, $strValues, $todbarrReqExpand, array());
			insertItem($_SQL_TABLE['user_request_expand_put'], $strColumns, $strValues);

			createUserPurse($requestInfo, 3, $requestId);

			$userLeaders = userLeaderPercentageTree($requestInfo['user_id']);

			foreach($userLeaders as $n => $leader)
			{				$purseInfo = array();
				$purseInfo['user_id'] = $leader['user_id'];
				$purseInfo['user_purse_type_id'] = 3;
				$purseInfo['amount'] = $requestInfo['amount'] * $leader['percentage'] / 100;
				$purseInfo['user_purse_status_id'] = 3;
				$purseInfo['status_date'] = 'NOW()';

				createUserPurse($purseInfo, 3, $requestId);			}
			return true;
		}
	}

	function createRequestOutput($requestInfo = array())
	{
		global $_SQL_TABLE, $CONFIG, $dbSet, $ADMIN;

		$requestId = createUserRequest($requestInfo);

		if($requestId)
		{
			$todbarrReqExpand = array();
			$todbarrReqExpand['user_request_id'] = $requestId;
			$todbarrReqExpand['user_purse_id'] = $requestInfo['user_purse_id'];
			$todbarrReqExpand['transaction_info_name'] = $requestInfo['transaction_info_name'];
			$todbarrReqExpand['transaction_info_account'] = $requestInfo['transaction_info_account'];
			$todbarrReqExpand['transaction_info_bank_code'] = $requestInfo['transaction_info_bank_code'];
			$todbarrReqExpand['transaction_info_bank'] = $requestInfo['transaction_info_bank'];
			$todbarrReqExpand['transaction_info_iban'] = $requestInfo['transaction_info_iban'];
			$todbarrReqExpand['transaction_info_bic'] = $requestInfo['transaction_info_bic'];

			makeInsertList($strColumns, $strValues, $todbarrReqExpand, array());
			insertItem($_SQL_TABLE['user_request_expand_output'], $strColumns, $strValues);

			changeUserPurseAmount($requestInfo);

			return true;
		}
	}

	function createUserRequest($requestInfo = array())
	{
		global $_SQL_TABLE, $CONFIG, $dbSet, $ADMIN;

		$todbarrReq = array();
		$todbarrReq['user_request_type_id'] = $requestInfo['user_request_type_id'];
		$todbarrReq['user_request_status_id'] = $requestInfo['user_request_status_id'];
		$todbarrReq['user_id'] = $requestInfo['user_id'];
		$todbarrReq['amount'] = $requestInfo['amount'];
		$todbarrReq['notes'] = $requestInfo['notes'];
		$todbarrReq['date_create'] = 'NOW()';
		$todbarrReq['date_update'] = 'NOW()';

		makeInsertList($strColumns, $strValues, $todbarrReq, array('date_create', 'date_update'));
		insertItem($_SQL_TABLE['user_request'], $strColumns, $strValues);
		$requestId = mysql_insert_id();
		return $requestId;
	}

	function createUserPurse($purseInfo = array(), $purseStatus = '0', $requestId = '0')
	{		global $_SQL_TABLE, $CONFIG, $dbSet, $ADMIN;

		$todbarrPurse = array();
		$todbarrPurse['user_id'] = $purseInfo['user_id'];
		$todbarrPurse['user_purse_type_id'] = $purseInfo['user_purse_type_id'];
		$todbarrPurse['amount'] = $purseInfo['amount'];
		$todbarrPurse['amount_start'] = $purseInfo['amount'];
		$todbarrPurse['user_purse_status_id'] = $purseStatus;
		$todbarrPurse['user_request_id'] = $requestId;
		$todbarrPurse['date_create'] = 'NOW()';
		if($purseInfo['user_purse_type_id'] != 3)
		{			$todbarrPurse['date_check'] = 'DATE_ADD(NOW(), INTERVAL 1 DAY)';		}

		makeInsertList($strColumns, $strValues, $todbarrPurse, array('status_date','date_create','date_check'));
		insertItem($_SQL_TABLE['user_purse'], $strColumns, $strValues);	}

	function changeUserPurseAmount($purseInfo = array())
	{		global $_SQL_TABLE, $dbSet;

		$todbarrPurse = array();
		$todbarrPurse['amount'] = $purseInfo['new_amount'];
		makeUpdateList($strSetPurse, $todbarrPurse, array());
		updateItem($_SQL_TABLE['user_purse'], $strSetPurse, 'user_purse_id', $purseInfo['user_purse_id']);
		return true;	}

	function updateUserPurse($purseInfo = array())
	{
		global $_SQL_TABLE, $dbSet;

		$todbarrPurse = array();
		$todbarrPurse['amount'] = $purseInfo['amount'];
		$todbarrPurse['amount_profit'] = $purseInfo['amount_profit'];
		if($purseInfo['user_purse_status_id'])
		{			$todbarrPurse['user_purse_status_id'] = $purseInfo['user_purse_status_id'];		}
		$todbarrPurse['date_check'] = 'DATE_ADD(NOW(), INTERVAL 1 DAY)';
		makeUpdateList($strSetPurse, $todbarrPurse, array('date_check'));
		updateItem($_SQL_TABLE['user_purse'], $strSetPurse, 'user_purse_id', $purseInfo['user_purse_id']);
		return true;
	}

	function changeUserPurseStatus($purseId, $statusId = 0, $typeId = 3)
	{
		global $_SQL_TABLE, $dbSet;

		$todbarrPurse = array();
		$todbarrPurse['user_purse_status_id'] = $statusId;
		if($typeId != 3)
		{			$todbarrPurse['date_start'] = 'NOW()';		}
		makeUpdateList($strSetPurse, $todbarrPurse, array('date_start'));
		updateItem($_SQL_TABLE['user_purse'], $strSetPurse, 'user_purse_id', $purseId);
		return true;
	}

	function changeUserRequestStatus($requestId, $requestStatusID)
	{		global $_SQL_TABLE, $dbSet;

		$todbarrStatus = array();
		$todbarrStatus['user_request_status_id'] = $requestStatusID;
		$todbarrStatus['date_update'] = 'NOW()';
		makeUpdateList($strSetStatus, $todbarrStatus, array('date_update'));
		updateItem($_SQL_TABLE['user_request'], $strSetStatus, 'user_request_id', $requestId);
		return true;	}

	function addUserRequestStatusHistory($requestInfo = array(), $adminID, $statusID)
	{
		global $_SQL_TABLE, $dbSet;

		$todbarrHistory = array();
		$todbarrHistory['user_request_id'] = $requestInfo['user_request_id'];
		$todbarrHistory['user_request_status_id'] = intval($statusID);
		$todbarrHistory['date'] = 'NOW()';
		$todbarrHistory['admin_user_id'] = $adminID;

		makeInsertList($strColumns, $strValues, $todbarrHistory, array('date'));
		return insertItem($_SQL_TABLE['user_request_status_history'], $strColumns, $strValues);
	}


	function createNewTransaction($transactionInfo = array(), $userInfo = array())
	{
		global $_SQL_TABLE, $dbSet, $tpl, $MailSubject, $language;

		$todbarrTransact = array();
		$todbarrTransact['user_request_id'] = $transactionInfo['put_request_id'];
		$todbarrTransact['amount'] = floatval($transactionInfo['amount']);
		$todbarrTransact['money_amount'] = floatval($transactionInfo['money_amount']);
		$todbarrTransact['date_create'] = 'NOW()';
		$todbarrTransact['date_update'] = 'NOW()';
		$todbarrTransact['user_request_transaction_status_id'] = 2;
		$todbarrTransactAdjacent['adjacent_user_request_transaction_id'] = 0;

		makeInsertList($strColumns, $strValues, $todbarrTransact, array('date_create', 'date_update'));
		insertItem($_SQL_TABLE['user_request_transaction'], $strColumns, $strValues);
		$transactId = mysql_insert_id();

		$todbarrTransactAdjacent = array();
		$todbarrTransactAdjacent['user_request_id'] = $transactionInfo['output_request_id'];
		$todbarrTransactAdjacent['amount'] = floatval($transactionInfo['amount']);
		$todbarrTransactAdjacent['money_amount'] = floatval($transactionInfo['money_amount']);
		$todbarrTransactAdjacent['date_create'] = 'NOW()';
		$todbarrTransactAdjacent['date_update'] = 'NOW()';
		$todbarrTransactAdjacent['user_request_transaction_status_id'] = 1;
		$todbarrTransactAdjacent['adjacent_user_request_transaction_id'] = $transactId;

		makeInsertList($strColumns, $strValues, $todbarrTransactAdjacent, array('date_create', 'date_update'));
		insertItem($_SQL_TABLE['user_request_transaction'], $strColumns, $strValues);
		$transactIdAdjacent = mysql_insert_id();

		$todbarrTransactUpdate = array();
		$todbarrTransactUpdate['adjacent_user_request_transaction_id'] = $transactIdAdjacent;
		makeUpdateList($strSetStatus, $todbarrTransactUpdate, array());
		updateItem($_SQL_TABLE['user_request_transaction'], $strSetStatus, 'user_request_transaction_id', $transactId);

		// request output amount
		$requestOutputAmount = getFieldByEnother('amount', $_SQL_TABLE['user_request'], 'user_request_id', $transactionInfo['output_request_id']);

		// transaction for this output request total sum amount
		$query = "	SELECT 	SUM(urt.amount) AS user_request_transaction_total_sum
					FROM ".$_SQL_TABLE['user_request_transaction']." urt
	 				WHERE urt.user_request_id = '".$transactionInfo['output_request_id']."'
				";
		$dbSet->open($query);
		$TransactionOutputInfo = $dbSet->fetchArray();
		$transactionOutputAmount = $TransactionOutputInfo['user_request_transaction_total_sum'];

		if($transactionOutputAmount)
		{			$todbarrRequestStatusUpdate = array();
			if($transactionOutputAmount == $requestOutputAmount)
			{				$todbarrRequestStatusUpdate['user_request_status_id'] = 4;			}
			else
			{				$todbarrRequestStatusUpdate['user_request_status_id'] = 7;			}
			$todbarrRequestStatusUpdate['date_update'] = 'NOW()';
			makeUpdateList($strSetStatus, $todbarrRequestStatusUpdate, array('date_update'));
			updateItem($_SQL_TABLE['user_request'], $strSetStatus, 'user_request_id', $transactionInfo['output_request_id']);		}

		// request put amount
		$requestPutAmount = getFieldByEnother('amount', $_SQL_TABLE['user_request'], 'user_request_id', $transactionInfo['put_request_id']);

		// transaction for this output request total sum amount
		$query = "	SELECT 	SUM(urt.amount) AS user_request_transaction_total_sum
					FROM ".$_SQL_TABLE['user_request_transaction']." urt
	 				WHERE urt.user_request_id = '".$transactionInfo['put_request_id']."'
				";
		$dbSet->open($query);
		$TransactionPutInfo = $dbSet->fetchArray();
		$transactionPutAmount = $TransactionPutInfo['user_request_transaction_total_sum'];
		if($transactionPutAmount)
		{
			$todbarrRequestStatusUpdate = array();
			if($transactionPutAmount == $requestPutAmount)
			{
				$todbarrRequestStatusUpdate['user_request_status_id'] = 4;
			}
			else
			{
				$todbarrRequestStatusUpdate['user_request_status_id'] = 7;
			}
			$todbarrRequestStatusUpdate['date_update'] = 'NOW()';
			makeUpdateList($strSetStatus, $todbarrRequestStatusUpdate, array('date_update'));
			updateItem($_SQL_TABLE['user_request'], $strSetStatus, 'user_request_id', $transactionInfo['put_request_id']);
		}

		if(is_array($userInfo) && $userInfo['user_email'])
		{			$tpl->assign("userInfo", $userInfo);

			$todbarrPayStatus = array();
			$todbarrPayStatus['user_request_transaction_id'] = $transactId;
			$todbarrPayStatus['user_id'] = $userInfo['user_id'];
			$todbarrPayStatus['type'] = 1;

			makeInsertList($strColumns, $strValues, $todbarrPayStatus, array());
			insertItem($_SQL_TABLE['user_request_transaction_user_status'], $strColumns, $strValues);

			$articleArray = array_kv(getTableAsArray($_SQL_TABLE['article_info'], '', array("article_id IN ('8','20')"), '', 'body_'.$userInfo['user_language'].', article_id'), 'body_'.$userInfo['user_language'], 'article_id');
        	$mailContent = array();
        	$mailContent['footer'] = $articleArray[8];
        	$mailContent['body'] = $articleArray[20];
        	$tpl->assign("mailContent", $mailContent);

        	require_once __CFG_PATH_LIBS.__CFG_PATH_CORE.'mail.php';
        	$tpl->template_dir = __CFG_PATH_MAIL_TEMPLATE_ADMIN;
        	$MailSubject = $MailSubject['admin']['newPaymentOnSite'];
            $MailBody = $tpl->fetch("mail.send_payment_to_user.tpl");
            $tpl->assign("MailBody", $MailBody);

			sendMailToUser($userInfo['user_email'], $MailSubject, $MailBody, null, $CONFIG['SiteDomain'], $CONFIG['adminEmailForUserMailing']);		}

		return true;	}

	function changeTransactionStatus($TransactionInfo = array(), $statusId = 0, $adjacentStatusId = 0, $userInfo = array())
	{
		global $_SQL_TABLE, $dbSet, $tpl, $MailSubject, $language;

		$todbarrTransactionStatusUpdate = array();
		$todbarrTransactionStatusUpdate['user_request_transaction_status_id'] = $statusId;
		$todbarrTransactionStatusUpdate['date_update'] = 'NOW()';
		makeUpdateList($strSetStatus, $todbarrTransactionStatusUpdate, array('date_update'));
		updateItem($_SQL_TABLE['user_request_transaction'], $strSetStatus, 'user_request_transaction_id', $TransactionInfo['user_request_transaction_id']);

		$todbarrTransactionStatusUpdateAdjacent = array();
		$todbarrTransactionStatusUpdateAdjacent['user_request_transaction_status_id'] = $adjacentStatusId;
		$todbarrTransactionStatusUpdateAdjacent['date_update'] = 'NOW()';
		makeUpdateList($strSetStatus, $todbarrTransactionStatusUpdateAdjacent, array('date_update'));
		updateItem($_SQL_TABLE['user_request_transaction'], $strSetStatus, 'user_request_transaction_id', $TransactionInfo['adjacent_user_request_transaction_id']);

		if(is_array($userInfo) && $userInfo['user_email'] && $adjacentStatusId == 3)
		{
			$tpl->assign("userInfo", $userInfo);

			$todbarrPayStatus = array();
			$todbarrPayStatus['user_request_transaction_id'] = $TransactionInfo['adjacent_user_request_transaction_id'];
			$todbarrPayStatus['user_id'] = $userInfo['user_id'];
			$todbarrPayStatus['type'] = 2;


			makeInsertList($strColumns, $strValues, $todbarrPayStatus, array());
			insertItem($_SQL_TABLE['user_request_transaction_user_status'], $strColumns, $strValues);

			$articleArray = array_kv(getTableAsArray($_SQL_TABLE['article_info'], '', array("article_id IN ('8','21')"), '', 'body_'.$userInfo['user_language'].', article_id'), 'body_'.$userInfo['user_language'], 'article_id');
        	$mailContent = array();
        	$mailContent['footer'] = $articleArray[8];
        	$mailContent['body'] = $articleArray[21];
        	$tpl->assign("mailContent", $mailContent);

        	require_once __CFG_PATH_LIBS.__CFG_PATH_CORE.'mail.php';
        	$tpl->template_dir = __CFG_PATH_MAIL_TEMPLATE_ADMIN;
        	$MailSubject = $MailSubject['admin']['newPaymentOnSite'];
            $MailBody = $tpl->fetch("mail.send_payment_to_user.tpl");
            $tpl->assign("MailBody", $MailBody);

            $type = 'get';
            $tpl->assign("type", $type);


			sendMailToUser($userInfo['user_email'], $MailSubject, $MailBody, null, $CONFIG['SiteDomain'], $CONFIG['adminEmailForUserMailing']);
		}

		return true;
	}

	function closeTransactionSuccessful($TransactionInfo = array())
	{
		global $_SQL_TABLE, $dbSet;

		if(changeTransactionStatus($TransactionInfo, 6, 6))
		{			$query = "	SELECT 	ur.user_request_id, ur.amount AS request_amount,
        						SUM(urtrall.amount) AS total_transaction_sum
						FROM ".$_SQL_TABLE['user_request']." ur
						LEFT JOIN ".$_SQL_TABLE['user_request_transaction']." urtrall ON urtrall.user_request_id = ur.user_request_id
		 				WHERE ur.user_request_id = '".$TransactionInfo['user_request_id']."'
		 				AND urtrall.user_request_transaction_status_id = 6
					";
			$dbSet->open($query);
			$RequestInfo = $dbSet->fetchArray();

			if($RequestInfo['request_amount'] == $RequestInfo['total_transaction_sum'])
			{				// 6 - status id of closed request
				changeUserRequestStatus($RequestInfo['user_request_id'], 6);			}

			$query = "	SELECT 	ur.user_request_id, ur.amount AS request_amount,
        						SUM(urtrall.amount) AS total_transaction_sum
						FROM ".$_SQL_TABLE['user_request']." ur
						LEFT JOIN ".$_SQL_TABLE['user_request_transaction']." urtrall ON urtrall.user_request_id = ur.user_request_id
		 				WHERE ur.user_request_id = '".$TransactionInfo['adjacent_user_request_id']."'
		 				AND urtrall.user_request_transaction_status_id = 6
					";
			$dbSet->open($query);
			$AdjacentRequestInfo = $dbSet->fetchArray();

			if($AdjacentRequestInfo['request_amount'] == $AdjacentRequestInfo['total_transaction_sum'])
			{
				// 6 - status id of closed request
				changeUserRequestStatus($AdjacentRequestInfo['user_request_id'], 6);

				/*
				$query = "	SELECT 	up.user_purse_id, up.date_create,
			     					DATE_ADD(up.date_create, INTERVAL upt.hold_days DAY) AS change_date, NOW() AS now_date,
			     					upt.hold_days
							FROM ".$_SQL_TABLE['user_purse']." up
							LEFT JOIN ".$_SQL_TABLE['user_purse_type']." upt ON upt.user_purse_type_id = up.user_purse_type_id
			 				WHERE up.user_request_id = '".$AdjacentRequestInfo['user_request_id']."'
			 				AND up.user_purse_status_id = 3
						";
				$dbSet->open($query);
				$UserPursesForRequest = $dbSet->fetchRowsAll();
				*/

				$query = "	SELECT 	up.user_purse_id, up.user_purse_type_id
							FROM ".$_SQL_TABLE['user_purse']." up
							LEFT JOIN ".$_SQL_TABLE['user_purse_type']." upt ON upt.user_purse_type_id = up.user_purse_type_id
			 				WHERE up.user_request_id = '".$AdjacentRequestInfo['user_request_id']."'
			 				AND up.user_purse_status_id = 3
						";
				$dbSet->open($query);
				$UserPursesForRequest = $dbSet->fetchRowsAll();

				if(is_array($UserPursesForRequest) && count($UserPursesForRequest))
				{					foreach($UserPursesForRequest as $n => $purse)
					{
						if($purse['user_purse_type_id'] == 3)
						{							changeUserPurseStatus($purse['user_purse_id'], 1);						}
						else
						{							changeUserPurseStatus($purse['user_purse_id'], 2, $purse['user_purse_type_id']);						}					}				}
			}		}

		return true;
	}

	function changeTransactionStatusOnCancelByAdmin($TransactionInfo = array())
	{
		global $_SQL_TABLE, $dbSet;

		$todbarrTransactionStatusUpdate = array();
		$todbarrTransactionStatusUpdate['user_request_transaction_status_id'] = 7;
		$todbarrRequestStatusUpdate['date_update'] = 'NOW()';
		makeUpdateList($strSetStatus, $todbarrTransactionStatusUpdate, array('date_update'));
		updateItem($_SQL_TABLE['user_request_transaction'], $strSetStatus, 'user_request_transaction_id', $TransactionInfo['user_request_transaction_id']);

		$todbarrTransactionStatusUpdateAdjacent = array();
		$todbarrTransactionStatusUpdateAdjacent['user_request_transaction_status_id'] = 7;
		$todbarrTransactionStatusUpdateAdjacent['date_update'] = 'NOW()';
		makeUpdateList($strSetStatus, $todbarrTransactionStatusUpdateAdjacent, array('date_update'));
		updateItem($_SQL_TABLE['user_request_transaction'], $strSetStatus, 'user_request_transaction_id', $TransactionInfo['adjacent_user_request_transaction_id']);

		return true;
	}


?>