<?php
/*
 *	Default file for sending email forms 
 * 
 */
?>
<?php 
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
    mail($admin_email,$subject,$message,$headers);
}