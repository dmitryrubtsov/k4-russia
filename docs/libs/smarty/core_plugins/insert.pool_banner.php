<?php
/*
 * Smarty plugin
 */

function smarty_insert_pool_banner($params, &$smarty)
{
	global $affiliateID, $refer;
	if (!isset($affiliateID))
		$affiliateID=0;
		
	$visitorIP = getVisitorIP();
	$visitorBlocked = isVisitorBlocked($visitorIP);
	$ppc_user_id = getVisitorID("PPC_USER_ID");
	$mlmEnabled = getOption("mlmEnabled");
	
	$bannerID = getPoolBanner();
	if ($bannerID==0)
		return "";
		
	$banner = getBanner($bannerID);
	
	// per showing
	if (getOption("poolBannerCharge")==0){
		//dprint("here");
		$logType = "pool";
   		$bid = getOption("poolBannerBid");
   		$memberID = $banner["memberID"];
   		$affcost = 0;
   		$uniqueData = md5($bannerID);
   			
		if ($memberID!=0 && $affiliateID==0){
			//dprint("test uq");
		    if ($isUnique=isClickUnique($bannerID, $affiliateID,$visitorIP,$logType)) {
		    	//dprint("is UQ");
		 		$member = getMember($memberID);
		 		if ($member["account"]["isFree"]==0) {
			    	changeAccountBalance("member",$memberID, -$bid,$logType,1);
			    	
			    	// refer account
					if ($refer!=0 && $percent = getOption("affiliatePercent")){
						$affcost = abs($bid * $percent / 100);
						if ($mlmEnabled)
							$affcost = mlm_charge($affiliateID, $affcost,"click");
						changeAccountBalance("affiliate", $refer, $affcost, "click", 0);
			  		}
			  	}
		  	}
			addClickStats($isUnique, $bannerID, $affiliateID, $bid, $affcost, $logType,0);
		}
	}
	// per click
	else{
		// do nothing => see rd.php
	
	}
	// $params["oName"]
	
	
	
	$href = "index.php?mode=rd&bannerID=$bannerID&pool=1";
	$path = $banner["path"];
	$target = getOption("openLinkInNewWindow")==0?"_self":"_blank";

	$img_params = array("file"=>$path, "link"=>$href, "target"=>$target);

	require_once $smarty->_get_plugin_filepath('function','html_image');
	return smarty_function_html_image($img_params, $smarty);
	
//	$str = "<a href=\"$href\" target=\"$target\"><img src=\"$path\" border=\"0\"></a>";

//	return $str;
}
/* vim: set expandtab: */
?>