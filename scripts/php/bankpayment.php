<?php 
require_once 'functions.php';
require_once 'helpers/helper.php';
require "phpmailer/PHPMailerAutoload.php";
    $mail = new PHPMailer;

// Getting Post value
$bankname = "FCMB"; 
$accountname = "Agrorite Limited"; 
$accountnumber = "6198280032";
$amountToPay = filter_var($_POST["amount"], FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_THOUSAND);
$invoice = $_POST["invoice"];
$invoiceNumber = 'BAT'.$invoice;
$farmId = $_POST["farmid"];
$userId = $_POST["userid"];
$farmUnit = $_POST["unit"];

/**
 * VALIDATION FOR EMAIL STARTS HERE
 */
if (empty($userId)) {
    return helper::Output_Error(null, "User Id is required");
}
if($userId === ''){
    return helper::Output_Error(null, "User Id field cannot be empty");
}
/**
 * VALIDATION FOR AMOUNT STARTS HERE
 */
if (empty($amountToPay)) {
    return helper::Output_Error(null, "Amount is required");
}
if($amountToPay === ''){
    return helper::Output_Error(null, "Amount field cannot be empty");
}
/**
 * VALIDATION FOR farm unit STARTS HERE
 */
if (empty($farmUnit)) {
    return helper::Output_Error(null, "Farm Unit is required");
}
if($farmUnit === ''){
    return helper::Output_Error(null, "Farm Unit field cannot be empty");
}
/**
 * VALIDATION FOR INVOICE NUMBER STARTS HERE
 */
if (empty($invoiceNumber)) {
    return helper::Output_Error(null, "Invoice number is required");
}
if($invoiceNumber === ''){
    return helper::Output_Error(null, "Invoice Number field cannot be empty");
}
if(substr($invoiceNumber, 0, 3) != 'BAT'){
    return helper::Output_Error(null, "Invalid Invoice number");
}
/**
 * VALIDATION FOR Farm Id STARTS HERE
 */
if (empty($farmId)) {
    return helper::Output_Error(null, "Farm Id is required");
}
if($farmId === ''){
    return helper::Output_Error(null, "Farm Id field cannot be empty");
}

$fetch = fetchUserId($userId);
// database error
if(array_key_exists('error',  $fetch)){
    return helper::Output_Error(null, "Opps there was an error performing this task please try again later");
}
if(count($fetch) === 0){
    return helper::Output_Error(null, "invalid user");
}
$userEmail = $fetch[0]->email;
$userFirstName = $fetch[0]->fname;
$fetchFarm = fetchFarmDetailsById($farmId);
if(count($fetchFarm) === 0){
    return helper::Output_Error(null, "Invalid Farm Selected");
}
$farmName = $fetchFarm[0]->title;
$date_created = date("d-m-Y");
$time_created = date("h:i:s A");
$submitFarmDetails = sponsorFarm($farmId, $userId, $amountToPay, $invoiceNumber, $date_created, $time_created, $farmUnit);

if($submitFarmDetails === TRUE){
    //send mail with invoice
    $loop = '<tr style="border-collapse:collapse;"> 
			  <td style="padding:5px 10px 5px 0;Margin:0;" width="80%" align="left"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:24px;color:#333333;">'.$farmName.' ('.$farmUnit.')</p></td> 
			  <td style="padding:5px 0;Margin:0;" width="20%" align="left"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:24px;color:#333333;">N'.$amountToPay.'</p></td> 
			 </tr> ';

    $text = '
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html style="width:100%;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0;">
			 <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
			   
			  <meta content="width=device-width, initial-scale=1" name="viewport"> 
			  <meta name="x-apple-disable-message-reformatting"> 
			  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
			  <meta content="telephone=no" name="format-detection"> 
			  <title>agrorite invoice</title> 
			  <!--[if (mso 16)]>
				<style type="text/css">
				a {text-decoration: none;}
				</style>
				<![endif]--> 
			  <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--> 
			  <!--[if !mso]><!-- --> 
			  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i" rel="stylesheet"> 
			  <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,700,700i" rel="stylesheet"> 
			  <!--<![endif]--> 
			  <style type="text/css">
			@media only screen and (max-width:600px) {p, ul li, ol li, a { font-size:16px!important; line-height:150%!important } h1 { font-size:32px!important; text-align:center; line-height:120%!important } h2 { font-size:26px!important; text-align:center; line-height:120%!important } h3 { font-size:20px!important; text-align:center; line-height:120%!important } h1 a { font-size:32px!important } h2 a { font-size:26px!important } h3 a { font-size:20px!important } .es-menu td a { font-size:16px!important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:16px!important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:16px!important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:12px!important } *[class="gmail-fix"] { display:none!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-button-border { display:inline-block!important } a.es-button { font-size:16px!important; display:inline-block!important; border-width:15px 30px 15px 30px!important } .es-btn-fw { border-width:10px 0px!important; text-align:center!important } .es-adaptive table, .es-btn-fw, .es-btn-fw-brdr, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .es-adapt-td { display:block!important; width:100%!important } .adapt-img { width:100%!important; height:auto!important } .es-m-p0 { padding:0px!important } .es-m-p0r { padding-right:0px!important } .es-m-p0l { padding-left:0px!important } .es-m-p0t { padding-top:0px!important } .es-m-p0b { padding-bottom:0!important } .es-m-p20b { padding-bottom:20px!important } .es-mobile-hidden, .es-hidden { display:none!important } .es-desk-hidden { display:table-row!important; width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } .es-desk-menu-hidden { display:table-cell!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } table.es-social { display:inline-block!important } table.es-social td { display:inline-block!important } }
			#outlook a {
				padding:0;
			}
			.ExternalClass {
				width:100%;
			}
			.ExternalClass,
			.ExternalClass p,
			.ExternalClass span,
			.ExternalClass font,
			.ExternalClass td,
			.ExternalClass div {
				line-height:100%;
			}
			.es-button {
				mso-style-priority:100!important;
				text-decoration:none!important;
			}
			a[x-apple-data-detectors] {
				color:inherit!important;
				text-decoration:none!important;
				font-size:inherit!important;
				font-family:inherit!important;
				font-weight:inherit!important;
				line-height:inherit!important;
			}
			.es-desk-hidden {
				display:none;
				float:left;
				overflow:hidden;
				width:0;
				max-height:0;
				line-height:0;
				mso-hide:all;
			}
			td .es-button-border:hover .es-button-1556897444926 {
				background:#999999!important;
				border-color:#999999!important;
			}
			td .es-button-border-1556897444961:hover {
				background:#999999!important;
			}
			</style> 
			 </head> 
			 <body style="width:100%;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0;"> 
			  <div class="es-wrapper-color" style="background-color:#EEEEEE;"> 
			   <!--[if gte mso 9]>
						<v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
							<v:fill type="tile" color="#eeeeee"></v:fill>
						</v:background>
					<![endif]--> 
			   <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;"> 
				 <tr style="border-collapse:collapse;"> 
				  <td valign="top" style="padding:0;Margin:0;"> 
				   <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;"> 
					 <tr style="border-collapse:collapse;"> 
					 </tr> 
					 <tr style="border-collapse:collapse;"> 
					  <td align="center" style="padding:0;Margin:0;"> 
					   <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" width="600" cellspacing="0" cellpadding="0" align="center"> 
						 <tr style="border-collapse:collapse;"> 
						  <td align="left" style="Margin:0;padding-left:10px;padding-right:10px;padding-top:15px;padding-bottom:15px;"> 
						   <!--[if mso]><table width="580" cellpadding="0" cellspacing="0"><tr><td width="282" valign="top"><![endif]--> 
						   <table class="es-left" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;"> 
							 <tr style="border-collapse:collapse;"> 
							  <td width="282" align="left" style="padding:0;Margin:0;"> 
							   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
								 <tr style="border-collapse:collapse;"> 
								  <td align="center" style="padding:0;Margin:0;"> <img class="adapt-img" src="https://hfarq.stripocdn.email/content/guids/CABINET_578946dbe5bd8f58ed2716082b68d24f/images/33381556898452888.png" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" width="282"></td> 
								 </tr> 
							   </table> </td> 
							 </tr> 
							 <tr style="border-collapse:collapse;"> 
							  <td width="282" align="left" style="padding:0;Margin:0;"> 
							   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
								 <tr style="border-collapse:collapse;"> 
								  <td align="right" style="padding:0;Margin:0;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:9px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:14px;color:#333333;"><strong>+234-803-5429-041</strong></p> </td> 
								 </tr> 
							   </table> </td> 
							 </tr> 
						   </table> 
						   <!--[if mso]></td><td width="20"></td><td width="278" valign="top"><![endif]--> 
						   <table class="es-right" cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right;"> 
							 <tr style="border-collapse:collapse;"> 
							  <td width="278" align="left" style="padding:0;Margin:0;"> 
							   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
								 <tr style="border-collapse:collapse;"> 
								  <td align="center" style="padding:0;Margin:0;display:none;"></td> 
								 </tr> 
							   </table> </td> 
							 </tr> 
						   </table> 
						   <!--[if mso]></td></tr></table><![endif]--> </td> 
						 </tr> 
					   </table> </td> 
					 </tr> 
				   </table> 
				   <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;"> 
					 <tr style="border-collapse:collapse;"> 
					 </tr> 
					 <tr style="border-collapse:collapse;"> 
					  <td align="center" style="padding:0;Margin:0;"> 
					   <table class="es-header-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#044767;" width="600" cellspacing="0" cellpadding="0" bgcolor="#044767" align="center"> 
						 <tr style="border-collapse:collapse;"> 
						  <td align="left" style="Margin:0;padding-top:35px;padding-bottom:35px;padding-left:35px;padding-right:35px;"> 
						   <!--[if mso]><table width="530" cellpadding="0" cellspacing="0"><tr><td width="340" valign="top"><![endif]--> 
						   <table class="es-left" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;"> 
							 <tr style="border-collapse:collapse;"> 
							  <td class="es-m-p0r es-m-p20b" width="340" valign="top" align="center" style="padding:0;Margin:0;"> 
							   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
								 <tr style="border-collapse:collapse;"> 
								  <td class="es-m-txt-c" align="left" style="padding:0;Margin:0;"> <h1 style="Margin:0;line-height:38px;mso-line-height-rule:exactly;font-family:roboto, \'helvetica neue\', helvetica, arial, sans-serif;font-size:38px;font-style:normal;font-weight:bold;color:#0CD70C;">Agrorite</h1> </td> 
								 </tr> 
							   </table> </td> 
							 </tr> 
						   </table> 
						   <!--[if mso]></td><td width="20"></td><td width="170" valign="top"><![endif]--> 
						   <table cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
							 <tr class="es-hidden" style="border-collapse:collapse;"> 
							  <td class="es-m-p20b" width="170" align="left" style="padding:0;Margin:0;"> 
							   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
								 <tr style="border-collapse:collapse;"> 
								  <td align="center" style="padding:0;Margin:0;padding-bottom:5px;"> 
								   <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
									 <tr style="border-collapse:collapse;"> 
									  <td style="padding:0;Margin:0px;border-bottom:1px solid #044767;background:rgba(0, 0, 0, 0) none repeat scroll 0% 0%;height:1px;width:100%;margin:0px;"></td> 
									 </tr> 
								   </table> </td> 
								 </tr> 
								 <tr style="border-collapse:collapse;"> 
								  <td style="padding:0;Margin:0;"> 
								   <table cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
									 <tr style="border-collapse:collapse;"> 
									  <td align="left" style="padding:0;Margin:0;"> 
									   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
										 <tr style="border-collapse:collapse;"> 
										  <td align="right" style="padding:0;Margin:0;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:21px;color:#FFFFFF;"><a target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:18px;text-decoration:none;color:#FFFFFF;line-height:22px;" href="https://agrorite.com/">Shop</a></p> </td> 
										 </tr> 
									   </table> </td> 
									  <td valign="top" align="left" style="padding:0;Margin:0;padding-left:10px;"> <a href="https://agrorite.com/" target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:14px;text-decoration:none;color:#FFFFFF;"><img src="https://hfarq.stripocdn.email/content/guids/CABINET_75694a6fc3c4633b3ee8e3c750851c02/images/77981522050090360.png" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" width="27"></a> </td> 
									 </tr> 
								   </table> </td> 
								 </tr> 
							   </table> </td> 
							 </tr> 
						   </table> 
						   <!--[if mso]></td></tr></table><![endif]--> </td> 
						 </tr> 
					   </table> </td> 
					 </tr> 
				   </table> 
				   <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;"> 
					 <tr style="border-collapse:collapse;"> 
					  <td align="center" style="padding:0;Margin:0;"> 
					   <table class="es-content-body" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;"> 
						 <tr style="border-collapse:collapse;"> 
						  <td align="left" style="padding:0;Margin:0;padding-left:35px;padding-right:35px;padding-top:40px;"> 
						   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
							 <tr style="border-collapse:collapse;"> 
							  <td width="530" valign="top" align="center" style="padding:0;Margin:0;"> 
							   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
								 <tr style="border-collapse:collapse;"> 
								  <td align="center" style="Margin:0;padding-top:25px;padding-bottom:25px;padding-left:35px;padding-right:35px;"> <a target="_blank" href="https://agrorite.com/" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:16px;text-decoration:none;color:#ED8E20;"> <img src="https://hfarq.stripocdn.email/content/guids/CABINET_75694a6fc3c4633b3ee8e3c750851c02/images/67611522142640957.png" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" width="120"> </a> </td> 
								 </tr> 
								 <tr style="border-collapse:collapse;"> 
								  <td align="center" style="padding:0;Margin:0;padding-bottom:10px;"> <h2 style="Margin:0;line-height:36px;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:30px;font-style:normal;font-weight:bold;color:#333333;">Thank You For Your Order!</h2> </td> 
								 </tr> 
								 <tr style="border-collapse:collapse;"> 
								  <td align="left" style="padding:0;Margin:0;padding-top:15px;padding-bottom:20px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:24px;color:#777777;">As a valued customer, we appreciate the business relationship you have with us. Your invoice number is #'.$invoiceNumber.'</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:24px;color:#777777;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:24px;color:#777777;">Please see a list of things that are contained in the invoice</p></td> 
								 </tr> 
							   </table> </td> 
							 </tr> 
						   </table> </td> 
						 </tr> 
					   </table> </td> 
					 </tr> 
				   </table> 
				   <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;"> 
					 <tr style="border-collapse:collapse;"> 
					  <td align="center" style="padding:0;Margin:0;"> 
					   <table class="es-content-body" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;"> 
						 <tr style="border-collapse:collapse;"> 
						  <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:35px;padding-right:35px;"> 
						   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
							 <tr style="border-collapse:collapse;"> 
							  <td width="530" valign="top" align="center" style="padding:0;Margin:0;"> 
							   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
								 <tr style="border-collapse:collapse;"> 
								  <td bgcolor="#eeeeee" align="left" style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px;"> 
								   <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:500px;" class="cke_show_border" cellspacing="1" cellpadding="1" border="0" align="left"> 
									 <tr style="border-collapse:collapse;"> 
									  <td width="80%" style="padding:0;Margin:0;"> <h4 style="Margin:0;line-height:120%;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;">Order Confirmation #</h4> </td> 
									  <td width="20%" style="padding:0;Margin:0;"> <h4 style="Margin:0;line-height:120%;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;">'.$invoiceNumber.'</h4> </td> 
									 </tr> 
								   </table> </td> 
								 </tr> 
							   </table> </td> 
							 </tr> 
						   </table> </td> 
						 </tr> 
						 <tr style="border-collapse:collapse;"> 
						  <td align="left" style="padding:0;Margin:0;padding-left:35px;padding-right:35px;"> 
						   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
							 <tr style="border-collapse:collapse;"> 
							  <td width="530" valign="top" align="center" style="padding:0;Margin:0;"> 
							   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
								 <tr style="border-collapse:collapse;"> 
								  <td align="left" style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px;"> 
								   <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:500px;" class="cke_show_border" cellspacing="1" cellpadding="1" border="0" align="left">
									 
									'.$loop.'
									
								   </table> </td> 
								 </tr> 
							   </table> </td> 
							 </tr> 
						   </table> </td> 
						 </tr> 
						 <tr style="border-collapse:collapse;"> 
						  <td align="left" style="padding:0;Margin:0;padding-top:10px;padding-left:35px;padding-right:35px;"> 
						   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
							 <tr style="border-collapse:collapse;"> 
							  <td width="530" valign="top" align="center" style="padding:0;Margin:0;"> 
							   <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-top:3px solid #EEEEEE;border-bottom:3px solid #EEEEEE;" width="100%" cellspacing="0" cellpadding="0"> 
								 <tr style="border-collapse:collapse;"> 
								  <td align="left" style="Margin:0;padding-left:10px;padding-right:10px;padding-top:15px;padding-bottom:15px;"> 
								   <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:500px;" class="cke_show_border" cellspacing="1" cellpadding="1" border="0" align="left"> 
									 <tr style="border-collapse:collapse;"> 
									  <td width="80%" style="padding:0;Margin:0;"><h4 style="Margin:0;line-height:120%;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;">TOTAL</h4></td> 
									  <td width="20%" style="padding:0;Margin:0;"><h4 style="Margin:0;line-height:120%;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;">N'.$amountToPay.'</h4></td> 
									 </tr> 
								   </table> </td> 
								 </tr> 
							   </table> </td> 
							 </tr> 
						   </table> </td> 
						 </tr> 
						 <tr style="border-collapse:collapse;"> 
						  <td align="left" style="Margin:0;padding-left:35px;padding-right:35px;padding-top:40px;padding-bottom:40px;"> 
						   <!--[if mso]><table width="530" cellpadding="0" cellspacing="0"><tr><td width="255" valign="top"><![endif]--> 
						   <table class="es-left" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;"> 
							 <tr style="border-collapse:collapse;"> 
							  <td class="es-m-p20b" width="255" align="left" style="padding:0;Margin:0;"> 
							   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
								 <tr style="border-collapse:collapse;"> 
								  <td align="left" style="padding:0;Margin:0;padding-bottom:15px;"> <h4 style="Margin:0;line-height:120%;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;">How to pay</h4> </td> 
								 </tr> 
								 <tr style="border-collapse:collapse;"> 
								  <td align="left" style="padding:0;Margin:0;padding-bottom:10px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:24px;color:#333333;">Bank Payment</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:24px;color:#333333;">You can&nbsp;make payment directly to our Nigerian bank account</p> </td> 
								 </tr> 
							   </table> </td> 
							 </tr> 
						   </table> 
						   <!--[if mso]></td><td width="20"></td><td width="255" valign="top"><![endif]--> 
						   <table class="es-right" cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right;"> 
							 <tr style="border-collapse:collapse;"> 
							  <td width="255" align="left" style="padding:0;Margin:0;"> 
							   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
								 <tr style="border-collapse:collapse;"> 
								  <td align="left" style="padding:0;Margin:0;padding-bottom:15px;"> <h4 style="Margin:0;line-height:120%;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;">Bank</h4> </td> 
								 </tr> 
								 <tr style="border-collapse:collapse;"> 
								  <td align="left" style="padding:0;Margin:0;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:24px;color:#333333;">'.$accountname.'</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:24px;color:#333333;">'.$accountnumber.'</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:24px;color:#333333;">'.$bankname.'</p> </td> 
								 </tr> 
							   </table> </td> 
							 </tr> 
						   </table> 
						   <!--[if mso]></td></tr></table><![endif]--> </td> 
						 </tr> 
						 <tr style="border-collapse:collapse;"> 
						  <td align="left" style="padding:0;Margin:0;padding-top:15px;padding-bottom:20px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:24px;color:#000000;"><strong>NB</strong></p><p style="Margin:5px;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:24px;color:#777777;">Once you have made payment, send the details of your payment such as depositor\'s name, slip number or transfer reference number, date of payment, the amount paid and the invoice number the payment is intended for <em><u><strong>billing@agrorite.com</strong></u></em></p> </td> 
						 </tr> 
					   </table> </td> 
					 </tr> 
				   </table> 
				   <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;"> 
					 <tr style="border-collapse:collapse;"> 
					  <td align="center" style="padding:0;Margin:0;"> 
					   <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#0CD70C;" width="600" cellspacing="0" cellpadding="0" bgcolor="#0cd70c" align="center"> 
						 <tr style="border-collapse:collapse;"> 
						  <td align="left" style="Margin:0;padding-top:35px;padding-bottom:35px;padding-left:35px;padding-right:35px;"> 
						   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
							 <tr style="border-collapse:collapse;"> 
							  <td width="530" valign="top" align="center" style="padding:0;Margin:0;"> 
							   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
								 <tr style="border-collapse:collapse;"> 
								  <td align="center" style="padding:0;Margin:0;padding-top:25px;"> <h2 style="Margin:0;line-height:29px;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:24px;font-style:normal;font-weight:bold;color:#FFFFFF;">Buy our farm produce at affordable prices</h2> </td> 
								 </tr> 
								 <tr style="border-collapse:collapse;"> 
								  <td align="center" style="Margin:0;padding-left:10px;padding-right:10px;padding-bottom:15px;padding-top:30px;"> <span class="es-button-border es-button-border-1556897444961" style="border-style:solid;border-color:transparent;background:#666666;border-width:0px;display:inline-block;border-radius:5px;width:auto;"> <a href="https://agrorite.com/dashboard/open-farm" class="es-button es-button-1556897444926" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:18px;color:#FFFFFF;border-style:solid;border-color:#666666;border-width:15px 30px 15px 30px;display:inline-block;background:#666666;border-radius:5px;font-weight:normal;font-style:normal;line-height:22px;width:auto;text-align:center;">Purchase</a> </span> </td> 
								 </tr> 
							   </table> </td> 
							 </tr> 
						   </table> </td> 
						 </tr> 
					   </table> </td> 
					 </tr> 
				   </table> 
				   <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;"> 
					 <tr style="border-collapse:collapse;"> 
					  <td align="center" style="padding:0;Margin:0;"> 
					   <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" width="600" cellspacing="0" cellpadding="0" align="center"> 
						 <tr style="border-collapse:collapse;"> 
						  <td align="left" style="Margin:0;padding-left:20px;padding-right:20px;padding-top:30px;padding-bottom:30px;"> 
						   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
							 <tr style="border-collapse:collapse;"> 
							  <td width="560" valign="top" align="center" style="padding:0;Margin:0;"> 
							   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
								 <tr style="border-collapse:collapse;"> 
								  <td class="es-infoblock" align="center" style="padding:0;Margin:0;line-height:14px;font-size:12px;color:#CCCCCC;"> <a target="_blank" href="http://viewstripo.email/?utm_source=templates&utm_medium=email&utm_campaign=accessory&utm_content=trigger_newsletter3" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:12px;text-decoration:none;color:#CCCCCC;"> <img src="https://hfarq.stripocdn.email/content/guids/CABINET_578946dbe5bd8f58ed2716082b68d24f/images/65781556896755574.png" alt width="125" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;"> </a> </td> 
								 </tr> 
							   </table> </td> 
							 </tr> 
						   </table> </td> 
						 </tr> 
					   </table> </td> 
					 </tr> 
				   </table> </td> 
				 </tr> 
			   </table> 
			  </div>  
			 </body>
			</html>';


			try {
				$mail->isSMTP();                                            // Send using SMTP
				$mail->Host       = 'agrorite.com';                    // Set the SMTP server to send through
				$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
				$mail->SMTPSecure = 'tls';
				$mail->Username   = 'hello@agrorite.com';                     // SMTP username
				$mail->Password   = 'j.TuY;T3ewdM';                               // SMTP password
				// $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
				$mail->Port       = 587;                                    // TCP port to connect to
			
				//Recipients
				$mail->setFrom('hello@agrorite.com', 'Agrorite');   // Add a recipient
				$mail->addAddress($userEmail, $userFirstName);               // Name is optional
				$mail->addReplyTo('hello@agrorite.com', 'Customer Experience');
			
				// Content
				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Subject = 'Agrorite Investment Invoice '.$invoiceNumber;
				$mail->Body    = $text;
			
				$mail->send();
				return helper::Output_Success(["success"=>"Please check your email for your invoice"]);
			} catch (Exception $e) {
				// echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
				return helper::Output_Error(null, "Oops there was an error processing your request please try again");
			}
}else{
    return helper::Output_Error(null, "Oops there was an error please try again");
}


?>