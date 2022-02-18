<!-- $phpmailer = new PHPMailer();
    $phpmailer->isSMTP();
    $phpmailer->Host = 'smtp.mailtrap.io';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 2525;
    $phpmailer->Username = 'cc2a4d61526283';
    $phpmailer->Password = '594945275ea933'; -->

require('phpmailer/class.phpmailer.php');
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port     = 2525;  
$mail->Username = "cc2a4d61526283";
$mail->Password = "594945275ea933";
$mail->Host     = "smtp.mailtrap.io";
$mail->Mailer   = "smtp";
$mail->SetFrom($_POST["userEmail"], $_POST["userName"]);
$mail->AddReplyTo($_POST["userEmail"], $_POST["userName"]);
$mail->AddAddress("ijeomaonuajurx@gmail.com");	
$mail->Subject = $_POST["subject"];
$mail->WordWrap   = 80;
$mail->MsgHTML($_POST["content"]);

if(is_array($_FILES)) {
	$mail->AddAttachment($_FILES['attachmentFile']['tmp_name'],$_FILES['attachmentFile']['name']); 
}

$mail->IsHTML(true);
if(!$mail->Send()) {
	echo "Problem in Sending Mail.";
} else {
	echo "Contact Mail Sent.";
}