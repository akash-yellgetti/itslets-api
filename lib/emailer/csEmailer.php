<?php
/**
 * SMTP Email using phpmailer
 */
class FEmailer {

    /**
     * Function to send email using PHPemailer class
     * @param type $toEmail
     * @param type $toName
     * @param type $subject
     * @param type $msg
     * @return boolean
     */
    public function fMail($toEmail, $toName = '', $subject, $msg) {
        return 1;
        $mail = new PHPMailer;
        /* SMTP Server */
        $mail->isSMTP();                                      // Set mailer to use SMTP
        //$mail->SMTPDebug = 4;
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup server
		$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted
        $mail->Port = 465;	
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = '';                            // SMTP username
        $mail->Password = '';                           // SMTP password
        /* Email Setting */
        if ($fromEmail != ""):
            $mail->From = $fromEmail;
        else:
            $mail->From = '';
        endif;
        $mail->FromName = '';
        if ($toName != ''):
            $mail->addAddress($toEmail, $toName);  // Add a recipient
        else:
            $mail->addAddress($toEmail);
        endif;
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $msg;
        if ($mail->send()):		
            return true;
        else:
            return false;
        endif;
    }

}

?>
