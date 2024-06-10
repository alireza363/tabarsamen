<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class model_contactus extends model
{
    function __construct()
    {
        parent::__construct();
    }

    function SendEmail($data, $file)
    {
        include "../public/PHPMailer/src/Exception.php";
        include "../public/PHPMailer/src/PHPMailer.php";
        include "../public/PHPMailer/src/SMTP.php";


        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'SMTP HOST';
            $mail->SMTPAuth = true;
            $mail->Username = 'SMTP USER';
            $mail->Password = 'SMTP PASS';
//            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->port = 25;

            //Recipients
            $mail->setFrom('tabarsamen.inv@gamil.com');
            $mail->addAddress('tabarsamen.inv@gamil.com');     //Add a recipient
            $mail->CharSet = "UTF-8";
            $mail->Subject = $data['subject'];
            $mail->ContentType = "text/html";
//            $mail->addReplyTo('info@example.com', 'Information');
//            $mail->addCC('cc@example.com');
//            $mail->addBCC('bcc@example.com');
            $mail->msgHTML($data['matn']);

            //Attachments
            $mail->AddAttachment($file);

//            $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
//            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->send();
            echo 'ایمیل شما با موفقیت ارسال شد';
        } catch (Exception $e) {
            echo "خطا: ایمیل ارسال نشد: {$mail->ErrorInfo}";
        }

    }
}

?>