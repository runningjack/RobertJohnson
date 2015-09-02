<form name="frm" id="frm" method="post" action=""  >
<label>To</label>
<input  type="text" id="toemail" name="toemail"/>
<label>Copy</label>
<input type="text" name="copy" id="copy" />
<label>Message</label>
<textarea id="msg" name="msg"></textarea>
<input type="submit" name="su" id="su" value="submit" />
</form>

<?php

        if(isset($_POST['msg'])  && isset($_POST["toemail"])){
            //$cemail     =   explode(",",$_POST['copy']);
            $email          =   $_POST['toemail'];
            $msg            =   $_POST['msg'];
            $to  = $email;
            print_r($to);
        
        // subject
        $subject = "Robert Johnson Holdings, Technical Support";
        
        // message
        $message = "
        <html>
        <head>
          <title>Birthday Reminders for August</title>
        </head>
        <body>
          <p>Here are the birthdays upcoming in August!</p>". $msg .
        "</body>
        </html>
        ";
        
        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
        // Additional headers
        $headers .= "To: " .$email . "\r\n";
        $headers .= 'From: support@robertjohnsonholdings.com' . "\r\n";
        //$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
        //$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
        
        // Mail it
        mail($to, $subject, $message, $headers);//{
        //    return true;
        //}else{
        //    return false;
        //}
               
        }
    
    
?>