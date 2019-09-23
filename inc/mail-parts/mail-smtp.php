<?php
/*
 *	Sending email form with SMTP server 
 * 
 */
?>
<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Include PHPMailer library
require 'vendor/autoload.php';

$mail = new PHPMailer(true);  
try {
    //Settings
    $mail->SMTPDebug = 0; 
    $mail->isSMTP();
    $smtpAuth           = carbon_get_theme_option('smtpauth');
    if( $smtpAuth ){
        $mail->SMTPAuth     = true;
    }
    else{
        $mail->SMTPAuth     = false;
    }
    $mail->SMTPSecure   = carbon_get_theme_option('secure');
    $mail->Port         = carbon_get_theme_option('port');
    $mail->Host         = carbon_get_theme_option('smtp_host');                   
    $mail->Username     = carbon_get_theme_option('smtp_name');               
    $mail->Password     = carbon_get_theme_option('smtp_passw'); 
    $mail->setLanguage(carbon_get_theme_option('lang'));
    //Recipients
    $mail->setFrom( $admin_email,  $sitename );
    $mail->addAddress(carbon_get_theme_option('second_mail'));    // Name is optional
    //$mail->addAddress('my.friend2@gmail.com');              //Еще получатель
    //$mail->addReplyTo('my.friend3@gmail.com', 'My Friend 3');
    //$mail->addCC('my.friend.cc@example.com');               //Копия
    //$mail->addBCC('my.friend.bcc@example.com');             //Скрытая копия
    //$mail->addAttachment('/path/to/file.zip');              //Прикрепить файл
    //$mail->addAttachment('/path/to/image.jpg', 'new.jpg');  //Прикрепить файл + задать имя
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $message = '<html>
            <head>
             <meta charset="UTF-8">
             <title>' . __('Feedback form') . '</title>
        </head>
            <body style="width:94%; height:auto;">
            <table style="width:100%; max-width:600px;height:auto;vertical-align: middle;border-color:#000;border:0px;border-style:solid;border-spacing:unset;padding:0;" summary="' . __("Application form") . '" rules="none" frame="border" cellpadding="0" cellspacing="0">
                <caption align="justify" style="height: 45px;">
                    <h2 style="margin: 5px;font-size: 1.5rem;">' . __('Letter') . '</h2>
                </caption>
                <thead align="justify" style="background-color:#ddd;border-color:#000;border:1px;border-style:solid;">
                    <tr style="height: 30px;">
                        <td align="center" style="width:100%;" colspan="4">
                            <h3 style="margin:5px;font-size: 1.1rem;">' . $subject . '</h3>
                        </td>
                    </tr>
                </thead>
                <tbody style="font-size: 1rem;">';
        if(isset($user_email)&&!empty($user_email)) {
                $message .= '<tr style="height:30px;width:auto;border-bottom: 1px solid black;">
                        <td style="border-right: 1px solid #ccc;padding-left:25px;">' . __("Email") . ':</td>
                        <td style="border-left: 1px solid #ccc;padding-left:25px;">
                            '. $user_email .'
                        </td>
                    </tr>';
        }
        if(isset($user_name)&&!empty($user_name)) {
                $message .= '<tr style="height:30px;width:auto;border-bottom: 1px solid black;">
                        <td style="border-right: 1px solid #ccc;padding-left:25px;">' . __('Sender name') . ':</td>
                        <td style="border-left: 1px solid #ccc;padding-left:25px;">'. $user_name .'</td>
                    </tr>';   
        }
        if(isset($user_company)&&!empty($user_company)) {
                $message .= '<tr style="height:30px;width:auto;border-bottom: 1px solid black;">
                        <td style="border-right: 1px solid #ccc;padding-left:25px;">' . __('Sender company') . ':</td>
                        <td style="border-left: 1px solid #ccc;padding-left:25px;">'. $user_company .'</td>
                    </tr>';   
        }
        if(isset($user_phone)&&!empty($user_phone)) {     
                $message .=   '<tr style="height:30px;width:auto;border-bottom: 1px solid black;">
                        <td style="border-right: 1px solid #ccc;padding-left:25px;">' . __('Phone number') . ':</td>
                        <td style="border-left: 1px solid #ccc;padding-left:25px;">
                            '. $user_phone .'
                        </td>
                    </tr>';
        }
        if(isset($user_message)&&!empty($user_message)) {
            $message .= '<tr style="height:30px;width:auto;border-bottom: 1px solid black;">
                        <td colspan="4" align="center">' . __('Message') . ':</td>
                    </tr>
                    <tr style="height:30px;width:auto;border-bottom: 1px solid black;">
                        <td colspan="4" align="center">
                            '. $user_message .'
                        </td>
                    </tr>';
        }
            $message .= '</tbody></table></body></html>';
    if( isset($user_email)&&!empty($user_email) && isset($user_name)&&!empty($user_name) && isset($user_phone)&&!empty($user_phone) ){
        $mail->Body = $message;
        $header.="Subject: =?windows-1251?Q?".str_replace("+","_",str_replace("%","=",urlencode('check')))."?=\r\n";
        $header.="MIME-Version: 1.0\r\n";
        $header.="Content-Type: text/plain; charset=windows-1251\r\n";
        $header.="Content-Transfer-Encoding: 8bit\r\n";
        $mail->AltBody = $header . __("Email: ") . $user_email . __('Sender name: ') . $user_name . __('Phone number: ') . $user_phone .  __('Sender company: ') . $user_company . __('Message: ') . $user_message;
    }
    $mail->send();
    echo __('Message has been sent');
} 
catch (Exception $e) {
    echo __('Message with SMTP could not be sent.');
    echo __('Mailer Error: ') . $mail->ErrorInfo; 
}