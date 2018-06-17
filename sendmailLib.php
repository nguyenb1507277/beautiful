<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once "PHPMailer/src/PHPMailer.php";
require_once "PHPMailer/src/SMTP.php";
require_once "PHPMailer/src/Exception.php";
function sendGMail($username,$password,$name,$addresses,
$replyTos,$subject,$content)
{
	$mail=new PHPMailer(true);
	$mail->IsSMTP();
	$mail->SMTPDebug=0;
	$mail->SMTPAuth=true;
	$mail->SMTPSecure="ssl";
	$mail->Host="smtp.gmail.com";
	$mail->Port="465";
	$mail->Username=$username;
	$mail->Password=$password;
	foreach($addresses as $address){
		$mail->AddAddress($address[0],$address[1]);
	}
	foreach($replyTos as $replyTo){
		$mail->AddReplyTo($replyTo[0],$replyTo[1]);
	}
	$mail->setFrom($username,$name);
	$mail->Subject=$subject;
	$mail->MsgHTML($content);
	$mail->CharSet='UTF-8';
	$mail->Send();
}
?>