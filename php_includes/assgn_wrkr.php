<?php
require_once('../PHPMailer/PHPMailerAutoload.php');
include 'db.php';
$assigned_worker = $_GET['wrkr'];
$id = $_GET['id'];
$sql = "UPDATE tbl_mock SET assigned_worker='$assigned_worker' WHERE id=$id";

if (mysql_query($sql)) {
    echo "Record updated successfully";
    mysql_query("UPDATE tbl_mock SET fk_status='1' WHERE id=$id");



$sql = "SELECT * FROM tbl_mock WHERE id=$id";
$result = mysql_query($sql);
$record = mysql_fetch_assoc($result);
$cust_mail = $record['c_email'];
$cust_name = $record['c_name'];




$mail = new PHPMailer;

///$mail->SMTPDebug = 2;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
$mail->Username = 'EmailId@example.com';                 // SMTP username
$mail->Password = 'password';                           // SMTP password

$mail->From = 'from@example.com';
$mail->FromName = 'Salaam Computers';
$mail->addAddress($cust_mail, $cust_name);     // Add a recipient
$mail->addReplyTo('info@example.com', 'Information');
//$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
//$mail->Send();

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}






} else {
    echo "Error updating record: ";
}
?>