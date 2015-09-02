<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Test Sms</title>
</head>

<body>
<?php echo date("Y-m-d H:i:s") ?>
<br />
<hr />
<form action="" method="post">
	<label for="sender">Number</label><input type="text" max="13" name="sender" /><br />
    <label for="text">Text</label><input type="text" max="160" name="text" /><br />
    <input type="submit" name="submit" />

</form>


<br />
<br />

<?php
if(isset($_POST['sender'])){
	require "system/library/functions.php";
	if(sendSms($_POST['sender'], $_POST['text']))
	echo "sent";
	else echo "not sent";
}
?>
</body>
</html>