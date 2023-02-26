<?php

class ModMain {

    /**
     * function to send contact details
     * @return int
     */
    public function sendContact() {
        if ($_POST["TxtEmail"] != ""):
            $htmlBody = "<!DOCTYPE HTML>
                          <html>
                          <title></title>
                          <body style='font-size:14px;font-family:calibri,arial,verdana,sans-serif;color:#333;'>
                                <br/><br/>New message from:" . $_POST["TxtEmail"] . "
                                <br/><br/><strong>Message detail:</strong>
                                <br/>Name: " . $_POST["TxtName"] . "
                                <br/>Email: " . $_POST["TxtEmail"];
            if ($_POST["TxtMobile"] != ""):
                $htmlBody = $htmlBody . "<br/>Mobile: " . $_POST["TxtMobile"];
            endif;
            $htmlBody = $htmlBody . "<br/>Message: " . $_POST["TxtMessage"] . "
                              <br/><br/>Thanking You,
                              <br/><a href='http://www.letsin.com'>Lets</a> Team
                            </body>
                          </html>";
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= "From:" . $_POST["TxtEmail"] . " \r\n";
            $toEmailID = "info@letsin.com";
            $subject = 'New Enquiry';
            //mail($toEmailID, $subject, $htmlBody, $headers);
            return 1;
        else:
            return 0;
        endif;
    }    

}
