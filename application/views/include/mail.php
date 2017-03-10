<?php 
    require_once("class.phpmailer.php");
    $mail = new PHPMailer(); // defaults to using php "Sendmail" (or Qmail, depending on availability)
    $mail -> IsSMTP(); 
    $mail -> Host = 'mail.autovista.in';
    $mail -> Port = '587';
    $mail -> SMTPAuth ='true';
    $mail -> Username ='info@autovista.in';
    $mail -> Password = 'autovista1@3$';
    $mail -> From = 'info@autovista.in';
    $mail -> FromName ='Autovista Admin';
    
    $to = 'jamil@autovista.in'; 
    //$t1 = 'sagar@autovista.in';
    //$toFeedback = 'sunnyraj@autovista.in';  
    $usermsg = '<html><body>
                <table border="0" cellpadding="0" cellspacing="0" width="500" align="center">
				<tr><td><img src="http://www.autovista.in/img/logo.png" border="0" alt="Excell Autovista Pvt. Ltd." /></td></tr>
				<tr><td><p>Dear  '.$fname.' </p>
                <tr><td height="10"></td></tr>
               <tr><td> <div><strong> New Account Created</strong>!  &nbsp;<br>
               <tr><td>Username:</td><td>'.$email.'</td></tr>
                <tr><td>Password:</td><td>'.$password.'</td></tr>
                <div>&nbsp;</div></td></tr>
                <tr></tr>
               <tr><td> <div>Thanks and regards,</div></td></tr>
                <div>&nbsp;</div>
               <tr><td> <p>Team Autovista </p>
                </td></tr>
                </table></body></html>';
?>